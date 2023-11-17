<?php

namespace Fintech\Core\Enums\Transaction;

enum OrderStatusConfig: string
{
    case Purchased = 'purchase';
    case Accepted = 'accept';
    case Rejected = 'reject';
    case Cancelled = 'cancel';
}
