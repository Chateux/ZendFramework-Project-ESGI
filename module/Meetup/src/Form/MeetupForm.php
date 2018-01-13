<?php
declare(strict_types=1);

namespace Meetup\Form;

use Zend\Filter\StringTrim;
use Zend\Form\Element;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Submit;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use Meetup\Validator;

class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('meetup');
        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ]
        ]);
        $this->add([
            'type' => Element\Textarea::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
                'rows' => 5,
                'cols' => 40
            ]
        ]);
        $this->add([
            'type' => Element\Date::class,
            'name' => 'startdate',
            'options' => [
                'label' => 'Date start of the meetup'
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ]
        ]);
        $this->add([
            'type' => Element\Date::class,
            'name' => 'enddate',
            'options' => [
                'label' => 'Date end of the meetup'
            ],
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ]
        ]);

        $this->add([
            'type' => Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600,
                ],
            ],
        ]);
        $this->add([
            'type' => Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary'
            ],
        ]);


    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        [
                            'name' => StringLength::class,
                            'name' => StringTrim::class
                        ],
                        'required' => true,
                        'options' => [
                            'min' => 5,
                            'max' => 30,
                        ],
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        [
                            'name' => StringLength::class,
                            'name' => StringTrim::class
                        ],
                        'required' => true,
                        'options' => [
                            'min' => 5,
                            'max' => 300,
                        ],
                    ],
                ],
            ],
            'enddate' => [
                'validators' => [
                    [
                        'name' => Validator\DateValidator::class,
                        'required' => true
                    ],
                ],
            ],
            'startdate' => [
                'validators' => [
                    [
                        'name' => Validator\DateValidator::class,
                        'required' => true
                    ],
                ],
            ],
            [
                'csrf' => [
                    'type' => Csrf::class,
                    'name' => 'csrf',
                ],
            ],
        ];
    }
}