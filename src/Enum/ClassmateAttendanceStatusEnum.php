<?php

namespace App\Enum;


class ClassmateAttendanceStatusEnum extends BaseEnum
{
    const ATTENDING_NOT_PAID = 'attending_not_paid';
    const ATTENDING_PAID = 'attending_paid';
    const NOT_ATTENDING = 'not_attending';
    const PAID = 'paid';

    public static $DISPLAY_NAMES = array(
        'attending_not_paid' => 'Attending - Not Paid',
        'attending_paid' => 'Attending - Paid',
        'not_attending' => 'Not Attending',
        'paid' => 'Paid'
    );
}
