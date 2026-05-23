<?php

namespace App\Enums;

class UserRole
{
    // System Admin Role
    public const SYSTEM_ADMIN = 'system_admin';

    // Applicant Role
    public const APPLICANT = 'applicant';

    //Asesor Role
    public const ASSESSOR = 'assessor';

    // Staff RPL Role
    public const STAFF_RPL = 'staff_rpl';

    // Comittee Role
    public const COMMITTEE = 'committee';


    // Roles manageable from admin panel.
    public const MANAGEABLE_ROLES = [
        self::ASSESSOR,
        self::STAFF_RPL,
        self::COMMITTEE,
    ];
}