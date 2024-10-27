<?php

namespace Fintech\Core\Supports;

use Exception;
use Illuminate\Support\Facades\Log;

class Utility
{
    private static array $xmlArray = [];

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
     * @param bool $preserveNS
     * @return array
     */
    public static function parseXml(string $content, bool $preserveNS = false): array
    {
        self::$xmlArray = [];

        try {
            $xmlObject = new \DOMDocument();
            $xmlObject->preserveWhiteSpace = false;
            $xmlObject->formatOutput = true;
            $xmlObject->loadXML($content);

            $node = $xmlObject->firstElementChild;

            self::domToArray($node, $node->tagName, self::$xmlArray, $node->prefix, $preserveNS);

        } catch (Exception $exception) {

            Log::info("XML Parse Exception: {$exception->getMessage()}");

        } finally {

            return self::$xmlArray;
        }
    }

    /**
     * Iterator for the parseXML function
     *
     * @param \DOMNode|\DOMElement|null $node
     * @param $tagName
     * @param $constructArray
     * @param string $namespacePrefix
     * @param bool $preserveNS
     * @return void
     */
    private static function domToArray($node, $tagName, &$constructArray, string $namespacePrefix = '', bool $preserveNS = false): void
    {
        $tagName = ($preserveNS) ? $tagName : str_replace("{$namespacePrefix}:", '', $tagName);

        if ($node->childNodes->length > 1) {
            foreach ($node->childNodes as $childNode) {
                if (isset($childNode->tagName) && $childNode->tagName != 'xs:schema') {
                    self::domToArray($childNode, $childNode->tagName, $constructArray[$tagName], $childNode->prefix, $preserveNS);
                }
            }
        } else {
            dump([$node->nodeType, $node]);

            $constructArray[$tagName] = self::typeCast($node->nodeValue, gettype($node->nodeValue));
        }
    }

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
     * validate given content is a valid JSON
     * @param mixed $content
     * @return bool
     */
    public static function isJson(mixed $content = null): bool
    {
        if (is_string($content)) {

            $dump = json_decode($content);

            return (json_last_error() == JSON_ERROR_NONE);
        }

        return false;
    }
}
