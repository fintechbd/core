<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum ResponseStatusCode: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Emerald500, description: 'Okay', label: '200')]
    case Ok = '200';

    #[Enumeration(color: Color::Green500, description: 'Created', label: '201')]
    case Created = '201';

    #[Enumeration(color: Color::Cyan500, description: 'Accepted', label: '202')]
    case Accepted = '202';

    #[Enumeration(color: Color::Amber500, description: 'Redirect Found', label: '302')]
    case Found = '302';

    #[Enumeration(color: Color::Orange500, description: 'Invalid Request', label: '400')]
    case BadRequest = '400';

    #[Enumeration(color: Color::Stone500, description: 'Unauthenticated', label: '401')]
    case Unauthenticated = '401';

    #[Enumeration(color: Color::Gray500, description: 'Access Forbidden', label: '403')]
    case Forbidden = '403';

    #[Enumeration(color: Color::Yellow500, description: 'Item Not Found', label: '404')]
    case NotFound = '404';

    #[Enumeration(color: Color::Slate500, description: 'Request Method Not Allowed', label: '405')]
    case MethodNotAllowed = '405';

    #[Enumeration(color: Color::Lime500, description: 'Validation Error', label: '422')]
    case UnprocessableEntity = '422';

    #[Enumeration(color: Color::Teal500, description: 'Too Many Requests', label: '429')]
    case TooManyRequests = '429';

    #[Enumeration(color: Color::Red500, description: 'Internal Server Error', label: '500')]
    case InternalServerError = '500';

    #[Enumeration(color: Color::Purple500, description: 'Service Unavailable', label: '503')]
    case ServiceUnavailable = '503';
}
