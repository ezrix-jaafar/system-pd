<?php

namespace App\Enums;

enum ProjectStatusEnum : string {
    case NEW = 'new';
    case ACTIVE = 'active';
    case ON_HOLD = 'on hold';
    case ENDED = 'ended';
    case RENEW_ACTIVE = 'renew active';
    case RENEW_ON_HOLD = 'renew on hold';
    case RENEW_ENDED = 'renew ended';
}



