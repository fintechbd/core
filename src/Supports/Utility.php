<?php

namespace Fintech\Core\Supports;

use Illuminate\Support\Facades\Config;

class Utility
{
    private static array $xmlArray = [];

    /**
     * Convert a value to given data type from string
     *
     * @param mixed $value
     * @param string $type
     * @return mixed|null
     */
    public static function typeCast(mixed $value, string $type = 'string'): mixed
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

    /**
     * Parse and convert a valid xml string into array
     *
     * @param string $content
     * @return array
     */
    public static function parseXml(string $content): array
    {
        self::$xmlArray = [];

        try {
            $xmlObject = new \DOMDocument();

            $xmlObject->loadXML($content);
            /**
             * @var \DOMNode|null $DOMNode
             */
            $DOMNode = $xmlObject->firstChild;

            self::convertToArray($DOMNode, $DOMNode->tagName, self::$xmlArray, $DOMNode->prefix);

        } catch (\Exception $exception) {

            \Illuminate\Support\Facades\Log::info("XML Parse Exception:" . json_encode($exception->getMessage()));

        } finally {

            return self::$xmlArray;
        }
    }

    /**
     * Iterator for the parseXML function
     *
     * @param $DOMNode
     * @param $tagName
     * @param $constructArray
     * @param string $namespacePrefix
     * @return void
     */
    private static function convertToArray($DOMNode, $tagName, &$constructArray, string $namespacePrefix = ''): void
    {
        $tagName = str_replace("{$namespacePrefix}:", '', $tagName);

        if ($DOMNode->childNodes->length > 1) {

            foreach ($DOMNode->childNodes as $childNode) {

                if (isset($childNode->tagName) && $childNode->tagName != 'xs:schema') {
                    self::convertToArray($childNode, $childNode->tagName, $constructArray[$tagName], $childNode->prefix);
                }
            }

        } else {
            $constructArray[$tagName] = self::typeCast($DOMNode->textContent, gettype($DOMNode->textContent));
        }
    }
}
