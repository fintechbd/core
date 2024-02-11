<?php

namespace Fintech\Core\Supports;

use Illuminate\Encryption\Encrypter;

class Encryption
{
    public Encrypter $factory;

    private function __construct()
    {
        $this->factory = new Encrypter(self::key(), config('app.cipher'));
    }

    /**
     * @param $plain
     * @return string
     */
    public static function encrypt($plain): string
    {
        $plain = is_string($plain) ? $plain : json_encode($plain);

        return (new self)->factory->encryptString($plain);

    }

    /**
     * @param $cipher
     * @return array|null
     */
    public static function decrypt($cipher): ?array
    {
        $cipher = is_string($cipher) ? $cipher : json_encode($cipher);

        return json_decode((new self)->factory->decryptString($cipher), true);
    }

    public static function key(): bool|string
    {
        return base64_decode(
            str_replace(
                'base64:', '',
                config('fintech.core.encryption_key')
            )
        );
    }
}
