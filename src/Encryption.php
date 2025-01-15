<?php

namespace Alsaloul\Encryption;

use Illuminate\Validation\ValidationException;

/**
 * Simple encryption and decryption for numbers.
 */
class Encryption
{
    // Static key mapping for encryption
    private static $key = [
        "1 2 3 4 5 6 7 8 9 0",
        "q w e r t y u i o p",
        "{ } | a s d f g h j",
        "k l ; z x c v b n m",
        "< > ~ ! @ # $ % ^ &",
        "* ( ) _ + = - Q W E",
        "R T Y U I O P A S D",
        "F G H J K L Z X C V",
        "B N M",
    ];

    // Character mapping for digits
    private static $vars = [
        "1" => "1q{k<*RFB",
        "2" => "2w}l>(TGN",
        "3" => "3e|;~)YHM",
        "4" => "4raz!_UJ",
        "5" => "5tsx@+IK",
        "6" => "6ydc#=OL",
        "7" => "7ufv$-PZ",
        "8" => "8igb%QAX",
        "9" => "9ohn^WSC",
        "0" => "0pjm&EDV",
    ];

    /**
     * Generate a random string of a specified length.
     */
    private static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Encrypt a numeric string.
     */
    public static function encryptNumbers(int $value): string
    {
        $string = '';
        foreach (str_split($value) as $digit) {
            $characters = self::$vars[$digit];
            $charactersLength = strlen($characters);
            $string .= $characters[rand(0, $charactersLength - 1)];
        }

        return self::generateRandomString(7) . $string . self::generateRandomString(4);
    }

    /**
     * Decrypt an encrypted string.
     */
    public static function decryptNumbers(string $value): string
    {
        try {
            $value = substr($value, 7, -4); // Remove random padding
            $string = '';

            foreach (str_split($value) as $char) {
                foreach (self::$vars as $digit => $letters) {
                    if (strpos($letters, $char) !== false) {
                        $string .= $digit;
                        break;
                    }
                }
            }

            return $string;
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['decrypt' => $exception->getMessage()]);
        }
    }
}
