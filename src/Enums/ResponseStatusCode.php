<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum ResponseStatusCode: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Emerald500, description: 'OK')]
    case Ok = '200';

    #[Enumeration(color: Color::Green500, description: 'Created')]
    case Created = '201';

    #[Enumeration(color: Color::Cyan500, description: 'Accepted')]
    case Accepted = '202';

    #[Enumeration(color: Color::Amber500, description: 'Redirect Found')]
    case Found = '302';

    #[Enumeration(color: Color::Orange500, description: 'Invalid Request')]
    case BadRequest = '400';

    #[Enumeration(color: Color::Yellow500, description: 'Item Not Found')]
    case NotFound = '404';

    #[Enumeration(color: Color::Slate500, description: 'Request Method Not Allowed')]
    case MethodNotAllowed = '405';

    #[Enumeration(color: Color::Lime500, description: 'Validation Error')]
    case UnprocessableEntity = '422';

    #[Enumeration(color: Color::Teal500, description: 'Too Many Requests')]
    case TooManyRequests = '429';

    #[Enumeration(color: Color::Red500, description: 'Internal Server Error')]
    case InternalServerError = '500';

    #[Enumeration(color: Color::Purple500, description: 'Service Unavailable')]
    case ServiceUnavailable = '503';
}
