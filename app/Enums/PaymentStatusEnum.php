<?php

namespace App\Enums;

enum PaymentStatusEnum : string {
    case UNPAID = 'unpaid';
    case PARTIAL = 'partial';
    case PAID = 'paid';
}
