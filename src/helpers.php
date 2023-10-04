<?php

if (!function_exists('permission_format')) {
    function permission_format(string $name, string $origin = 'auth'): string
    {
        $name = strtolower($name);

        $name = str_replace([$origin . '.', '-', '.'], ['', ' ', ' '], $name);

        return ucwords($name);

    }
}

if (!function_exists('action_link')) {

    function action_link($url, $label, $method = 'get')
    {
        return [
            'url' => $url,
            'label' => $label,
            'method' => $method,
        ];
    }
}
