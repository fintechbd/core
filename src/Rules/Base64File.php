<?php

namespace Fintech\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MimeTypeNotAllowed;

class Base64File implements ValidationRule
{
    private array $allowedMimeTypes;

    public function __construct(...$allowedMimes)
    {
        $this->allowedMimeTypes = $allowedMimes ?? [];
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $matches = [];

        preg_match('/^data:([a-z0-9]+\/[a-z0-9\+]+);base64,/i', $value, $matches);

        if (empty($matches)) {
            $fail('The :attribute is not a valid Base64 file content.');
        }

        if (!empty($this->allowedMimeTypes)) {
            try {
                \Fintech\Core\Supports\Base64File::load($value, ...$this->allowedMimeTypes);

            } catch (InvalidBase64Data $e) {
                $fail('The :attribute is not a valid Base64 file content.');

            } catch (MimeTypeNotAllowed $e) {
                $fail('The :attribute field must be a file of type: '.implode(',', $this->allowedMimeTypes).'.');
            }
        }
    }
}
