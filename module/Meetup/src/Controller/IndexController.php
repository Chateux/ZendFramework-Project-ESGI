<?php
declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Organisator;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Meetup\Repository\OrganisatorRepository;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;
    /**
     * @var OrganisatorRepository
     */
    private $organisatorRepository;
    /**
     * @var MeetupForm
     */
    private $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, OrganisatorRepository $organisatorRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->organisatorRepository = $organisatorRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {

        return new ViewModel([
            'meetups' => $this->meetupRepository->findAll()
        ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;
        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $title = $form->getData()['title'];
                $description = $form->getData()['description'];
                $startdate = new \DateTime($form->getData()['startdate']);
                $enddate = new \DateTime($form->getData()['enddate']);
                if ($enddate > $startdate) {
                    $meetup = $this->meetupRepository->createMeetup(
                        $title,
                        $description,
                        $startdate,
                        $enddate
                    );
                    $this->meetupRepository->add($meetup);
                    return $this->redirect()->toRoute('meetup');
                } else {
                    $this->flashMessenger()->addMessage('The end date is less than the start date.');
                    return $this->redirect()->toRoute('meetup');
                }
            }
        }
        $form->prepare();
        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function ViewAction()
    {
        $id = $this->params('id');
        $meetup = $this->meetupRepository->getByEntity($id);
        if (!isset($meetup[0])) {
            $this->flashMessenger()->addMessage('This meetup does not exist.');
            return $this->redirect()->toRoute('meetup');
        }

        return new ViewModel([
            'meetup' => $meetup[0],
            'organisator' => $meetup[1]
        ]);
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $id = $this->params('id');
        $meetup = $this->meetupRepository->get($id);
        if (!isset($meetup)) {
            $this->flashMessenger()->addMessage('This meetup does not exist.');
            return $this->redirect()->toRoute('meetup');
        }
        $form = $this->meetupForm;
        $data = [
            'title' => $meetup->getTitle(),
            'description' => $meetup->getDescription(),
            'startdate' => $meetup->getStartDate(),
            'enddate' => $meetup->getEndDate()
        ];
        $form->setData($data);
        if ($request->isPost()) {

            $form->setData($request->getPost());
            if ($form->isValid()) {

                $title = $form->getData()['title'];
                $description = $form->getData()['description'];
                $startdate = new \DateTime($form->getData()['startdate']);
                $enddate = new \DateTime($form->getData()['enddate']);
                if ($enddate > $startdate) {
                    $meetup->setTitle($title);
                    $meetup->setDescription($description);
                    $meetup->setStartDate($startdate);
                    $meetup->setEndDate($enddate);
                    $this->meetupRepository->edit($meetup);

                    return $this->redirect()->toRoute('meetup');
                } else {
                    $this->flashMessenger()->addMessage('The end date is less than the start date.');
                    return $this->redirect()->toRoute('meetup');
                }
            }
        }
        $form->prepare();
        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $meetup = $this->meetupRepository->get($id);
        if (!isset($meetup)) {
            $this->flashMessenger()->addMessage('This meetup does not exist.');
            return $this->redirect()->toRoute('meetup');
        }
        $this->meetupRepository->delete($meetup);
        return $this->redirect()->toRoute('meetup');
    }
}