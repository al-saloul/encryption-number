<?php

use Alsaloul\Encryption\Encryption;

if (! function_exists('encrypt_numbers')) {
    /**
     * Encrypt a given number.
     *
     * @param string $value
     * @return string
     */
    function encrypt_numbers(string $value)
    {
        return Encryption::encryptNumbers($value);
    }
}

if (! function_exists('decrypt_numbers')) {
    /**
     * Decrypt a given encrypted string.
     *
     * @param string $value
     * @return string
     */
    function decrypt_numbers(string $value)
    {
        return Encryption::decryptNumbers($value);
    }
}

if (! function_exists('is_encrypted')) {
    /**
     * Check if a given string is encrypted.
     *
     * @param string $encryptedString
     * @return bool
     */
    function is_encrypted(string $encryptedString)
    {
        return Encryption::isEncrypted($encryptedString);
    }
}