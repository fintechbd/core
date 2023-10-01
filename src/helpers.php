<?php

function permission_format(string $name, string $origin = 'auth'): string
{
    $name = strtolower($name);

    $name = str_replace([$origin.'.', '-', '.'], ['', ' ', ' '], $name);

    return ucwords($name);

}
