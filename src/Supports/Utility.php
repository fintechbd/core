<?php

namespace Fintech\Core\Supports;

use Exception;

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
     * @throws Exception
     */
    public static function parseXml(string $content, bool $preserveNS = false): array
    {
        $xmlArray = [];

        //        try {

        $xmlObject = new \DOMDocument();
        $xmlObject->preserveWhiteSpace = false;
        $xmlObject->formatOutput = true;
        $xmlObject->loadXML($content);

        $node = $xmlObject->firstChild;

        self::domToArray($node, $node->tagName, $xmlArray, $node->prefix, $preserveNS);

        return $xmlArray;

        //        } catch (Exception $exception) {
        //
        //            throw $exception;
        //        }
        //        } finally {
        //
        //            return $xmlArray;
        //        }
        //        return $xmlArray;
    }

    /**
     * Iterator for the parseXML function
     *
     * @param \DOMNode|\DOMElement|null $node
     * @param $nodeName
     * @param $constructArray
     * @param string $namespacePrefix
     * @param bool $preserveNS
     * @return void
     */
    private static function domToArray($node, $nodeName, &$constructArray, string $namespacePrefix = '', bool $preserveNS = false): void
    {
        $nodeName = ($preserveNS) ? $nodeName : str_replace("{$namespacePrefix}:", '', $nodeName);

        //leaf text element
        if ($node->nodeType == XML_TEXT_NODE) {
            $constructArray[$nodeName] = self::typeCast($node->textContent, gettype($node->textContent));
            return;
        }

        //element with only one text element
        if ($node->childNodes->length == 1 && $node->firstChild->nodeType == XML_TEXT_NODE) {
            $constructArray[$nodeName] = self::typeCast($node->firstChild->textContent, gettype($node->firstChild->textContent));
            return;
        }

        //branch element
        if ($node->hasChildNodes()) {
            foreach ($node->childNodes as $child) {
                if (isset($child->nodeName) && $child->nodeName == 'xs:schema') {
                    continue;
                }
                self::domToArray($child, $child->nodeName, $constructArray[$nodeName], $child->prefix, $preserveNS);
            }
            return;
        }

        $constructArray[$nodeName] = self::typeCast($node->nodeValue, gettype($node->nodeValue));
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
                    return in_array($value, ['true', 'TRUE', '1', 'Y']);
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
