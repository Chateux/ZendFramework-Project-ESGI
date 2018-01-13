<?php

namespace Meetup\Validator;

use Zend\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{
    const DATE_ERROR_LESS = "DATE_ERROR_LESS";

    protected $messageTemplates = [
        self::DATE_ERROR_LESS => 'The end date is less than the start date.'
    ];

    public function isValid($value, $context = null)
    {
        if (is_array($context)) {
            $startdate = $context['startdate'];
            $enddate = $context['enddate'];
            if ($startdate > $enddate) {
                $this->error(self::DATE_ERROR_LESS);
                return false;
            }
        }
        return true;
    }
}