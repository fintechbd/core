<?php

namespace Fintech\Core\Enums;

use Fintech\Core\Attributes\Enumeration;
use Fintech\Core\Traits\EnumHasSerialization;

enum RequestMethod: string implements \JsonSerializable
{
    use EnumHasSerialization;

    #[Enumeration(color: Color::Sky500, label:'GET')]
    case GET = 'GET';
    #[Enumeration(color: Color::Green500, label:'POST')]
    case POST = 'POST';
    #[Enumeration(color: Color::Emerald500, label:'PUT')]
    case PUT = 'PUT';
    #[Enumeration(color: Color::Teal500, label:'PATCH')]
    case PATCH = 'PATCH';
    #[Enumeration(color: Color::Red500, label:'DELETE')]
    case DELETE = 'DELETE';
    #[Enumeration(color: Color::Gray500, label:'HEAD')]
    case HEAD = 'HEAD';
    #[Enumeration(color: Color::Neutral500, label:'OPTION')]
    case OPTION = 'OPTION';
}
