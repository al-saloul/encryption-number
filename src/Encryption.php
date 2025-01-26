<?php

namespace Alsaloul\Encryption;

use Illuminate\Validation\ValidationException;
use Psr\Log\LoggerInterface;
use InvalidArgumentException;

/**
 * Enhanced encryption and decryption for numbers.
 */
class Encryption
{
    // Configurable padding lengths
    private static $prefixLength = 7;
    private static $suffixLength = 4;

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor to inject Logger.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Generate a cryptographically secure random string of a specified length.
     *
     * @param int $length
     * @return string
     * @throws \Exception
     */
    private static function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Use random_int for cryptographic security
        for ($i = 0; $i < $length; $i++) {
            $index = random_int(0, $charactersLength - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    /**
     * Encrypt a numeric string.
     *
     * @param int|string $value
     * @return string
     * @throws InvalidArgumentException
     */
    public static function encryptNumbers($value): string
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException('The value to encrypt must be numeric.');
        }

        $string = '';
        foreach (str_split((string) $value) as $digit) {
            if (!isset(self::$vars[$digit])) {
                throw new InvalidArgumentException("Invalid digit encountered during encryption: {$digit}");
            }
            $characters = self::$vars[$digit];
            $charactersLength = strlen($characters);
            // Use random_int for cryptographic security
            $randomIndex = random_int(0, $charactersLength - 1);
            $string .= $characters[$randomIndex];
        }

        $encrypted = self::generateRandomString(self::$prefixLength) . $string . self::generateRandomString(self::$suffixLength);

        // Optionally, log the encryption
        // $this->logger->info("Encrypted value: {$encrypted}");

        return $encrypted;
    }

    /**
     * Decrypt an encrypted string.
     *
     * @param string $value
     * @return string
     * @throws ValidationException
     */
    public static function decryptNumbers(string $value): string
    {
        try {
            if (strlen($value) < (self::$prefixLength + self::$suffixLength)) {
                throw new InvalidArgumentException('The encrypted value is too short to contain valid data.');
            }

            $value = substr($value, self::$prefixLength, -self::$suffixLength); // Remove random padding
            $string = '';

            foreach (str_split($value) as $char) {
                $found = false;
                foreach (self::$vars as $digit => $letters) {
                    if (strpos($letters, $char) !== false) {
                        $string .= $digit;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    throw new InvalidArgumentException("Invalid character encountered during decryption: {$char}");
                }
            }

            // Optionally, log the decryption
            // $this->logger->info("Decrypted value: {$string}");

            return $string;
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['decrypt' => $exception->getMessage()]);
        }
    }

    /**
     * Set custom padding lengths.
     *
     * @param int $prefixLength
     * @param int $suffixLength
     * @return void
     * @throws InvalidArgumentException
     */
    public static function setPaddingLengths(int $prefixLength, int $suffixLength): void
    {
        if ($prefixLength < 0 || $suffixLength < 0) {
            throw new InvalidArgumentException('Padding lengths must be non-negative integers.');
        }
        self::$prefixLength = $prefixLength;
        self::$suffixLength = $suffixLength;
    }

    /**
     * Set custom variable mappings.
     *
     * @param array $vars
     * @return void
     * @throws InvalidArgumentException
     */
    public static function setVars(array $vars): void
    {
        foreach ($vars as $digit => $characters) {
            if (!is_string($digit) || !is_string($characters)) {
                throw new InvalidArgumentException('Variable mappings must be an associative array of strings.');
            }
            if (!ctype_digit($digit) || strlen($digit) !== 1) {
                throw new InvalidArgumentException("Invalid digit key: {$digit}. Keys must be single digits.");
            }
            self::$vars[$digit] = $characters;
        }
    }

    /**
     * Check if a string is a valid encrypted number.
     *
     * @param string $value
     * @return bool
     */
    public static function isEncrypted(string $value): bool
    {
        if (strlen($value) < (self::$prefixLength + self::$suffixLength)) {
            return false;
        }

        $core = substr($value, self::$prefixLength, -self::$suffixLength);
        foreach (str_split($core) as $char) {
            $found = false;
            foreach (self::$vars as $letters) {
                if (strpos($letters, $char) !== false) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                return false;
            }
        }

        return true;
    }
}
