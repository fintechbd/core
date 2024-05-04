<?php

namespace Fintech\Core\Supports;

use Illuminate\Http\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MimeTypeNotAllowed;

class Base64File
{
    private ?string $content;
    private ?File $file;

    /**
     * @throws InvalidBase64Data|MimeTypeNotAllowed
     */
    public function __construct(string $content, array|string ...$allowedMimeTypes)
    {
        $this->content = $content;

        $this->parseContent($allowedMimeTypes);
    }

    /**
     * @param array $allowedMimeTypes
     * @return void
     * @throws InvalidBase64Data
     * @throws MimeTypeNotAllowed
     */
    private function parseContent(array $allowedMimeTypes): void
    {
        if (!str_contains($this->content, ';base64,')) {
            throw InvalidBase64Data::create();
        }
        [$ext, $base64data] = explode(";base64,", $this->content);

        // strict mode filters for non-base64 alphabet characters
        $binaryData = base64_decode($base64data, true);

        if (false === $binaryData) {
            throw InvalidBase64Data::create();
        }

        // decoding and then re-encoding should not change the data
        if (base64_encode($binaryData) !== $base64data) {
            throw InvalidBase64Data::create();
        }

        // temporarily store the decoded data on the filesystem to be able to pass it to the fileAdder
        $tmpFile = tempnam(sys_get_temp_dir(), 'media-library');
        file_put_contents($tmpFile, $binaryData);

        $this->guardAgainstInvalidMimeType($tmpFile, $allowedMimeTypes);

        $this->file = new File($tmpFile);
    }

    /**
     * @throws MimeTypeNotAllowed
     */
    private function guardAgainstInvalidMimeType(string $file, ...$allowedMimeTypes): void
    {
        $allowedMimeTypes = Arr::flatten($allowedMimeTypes);

        if (empty($allowedMimeTypes)) {
            return;
        }

        $validation = Validator::make(
            ['file' => new File($file)],
            ['file' => 'mimetypes:' . implode(',', $allowedMimeTypes)]
        );

        if ($validation->fails()) {
            throw MimeTypeNotAllowed::create($file, $allowedMimeTypes);
        }
    }

    /**
     * @throws InvalidBase64Data|MimeTypeNotAllowed
     */
    public static function load(string $base64data, array|string ...$allowedMimeTypes): static
    {
        return new static($base64data, $allowedMimeTypes);
    }

    public function save(string $filename, string $path = '/'): string
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (strlen($ext) < 1) {
            $ext = $this->getFile()->extension();
            $filename = "{$filename}.{$ext}";
        }

        return Storage::disk(config('filesystems.default', 'public'))
            ->putFileAs(trim("tmp/{$path}", '/'), $this->getFile(), $filename);
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
