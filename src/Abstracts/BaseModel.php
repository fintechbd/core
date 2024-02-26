<?php

namespace Fintech\Core\Abstracts;

class_alias(determine_base_model(), 'Fintech\Core\VirtualModel');

class BaseModel extends \Fintech\Core\VirtualModel
{
    protected $collection;
}
