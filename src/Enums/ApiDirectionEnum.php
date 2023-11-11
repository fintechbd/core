<?php

namespace Fintech\Core\Enums;

enum ApiDirectionEnum: string
{
    case InBound = 'inbound';
    case OutBound = 'outbound';
}
