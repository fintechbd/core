<?php

namespace Fintech\Core\Supports;

class Utility
{
    /**
     * Convert a value to given data type from string
     *
     * @param mixed $value
     * @param string $type
     * @return mixed
     */
    public static function typeCast($value, string $type = 'string')
    {
        if ($value == null) {
            return null;
        }
        switch ($type) {
            case 'boolean':
            case 'bool' :
                if (is_string($value)) {
                    return $value == 'true';
                }

                return (bool)$value;

            case 'float' :
            case 'double' :
                return (float)$value;

            case 'integer' :
                return (int)$value;

            case 'json' :
            case 'array' :
                return json_decode($value, true);

            case 'string' :
            default:
                return (string)$value;
        }
    }

    /**
     * Convert All Datatype to string equivalent value
     *
     * @param string $type
     * @param mixed|null $value
     * @return false|string
     */
    public static function stringify(string $type, mixed $value = null): bool|string
    {
        if ($value === null) {
            return '';
        }

        switch ($type) {
            case 'boolean':
            case 'bool':
                return (in_array($value, ['false', '0', 0, false], true)) ? 'false' : 'true';

            case 'json':
            case 'array':
                return (is_string($value)) ? $value : json_encode($value);

            case 'integer':
                return (is_numeric($value)) ? (string)filter_var($value, FILTER_SANITIZE_NUMBER_INT) : '';

            case 'float':
            case 'double':
                return (is_numeric($value)) ? (string)filter_var(
                    $value,
                    FILTER_SANITIZE_NUMBER_FLOAT,
                    FILTER_FLAG_ALLOW_FRACTION
                ) : '';

            default:
                return (string)$value;
        }
    }

}
