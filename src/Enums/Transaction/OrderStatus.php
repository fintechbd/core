<?php

namespace Fintech\Core\Enums\Transaction;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Enums\Color;
use Fintech\Core\Traits\EnumHasSerialization;

enum OrderStatus: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Orange500, label: 'Transaction Pending')]
    case PaymentPending = 'payment_pending';

    #[Enumeration(color: Color::Yellow500)]
    case Pending = 'pending';
    #[Enumeration(color: Color::Purple500)]
    case Processing = 'processing';
    #[Enumeration(color: Color::Blue500)]
    case Accepted = 'accepted';
    #[Enumeration(color: Color::Red500)]
    case Rejected = 'rejected';

    #[Enumeration(color: Color::Red500)]
    case Failed = 'failed';
    #[Enumeration(color: Color::Orange500)]
    case FailedAndRefunded = 'failed_and_refunded';
    #[Enumeration(color: Color::Green500)]
    case Refunded = 'refunded';
    #[Enumeration(color: Color::Emerald500)]
    case RefundReceived = 'refund_received';
    #[Enumeration(color: Color::Green500, label: 'Completed')]
    case Successful = 'successful';
    #[Enumeration(color: Color::Green500, label: 'Completed')]
    case Success = 'success';
    #[Enumeration(color: Color::Slate500)]
    case Cancelled = 'cancelled';
    #[Enumeration(color: Color::Orange500, label: 'Reviewing')]
    case AdminVerification = 'admin_verification';
    #[Enumeration(color: Color::Teal500)]
    case Received = 'received';
}
