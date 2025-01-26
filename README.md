**Laravel Number Encryption Package**

License: MIT

---

**Overview**

The **Laravel Number Encryption Package** provides robust encryption and decryption functionality for numeric values within Laravel applications. Building upon simple number-to-string mappings, this package offers enhanced security features, configurability, and comprehensive error handling to ensure reliable and secure operations.

---

**Features**

- **Encrypt Numbers**: Transform numeric values into non-readable, encrypted strings.
- **Decrypt Numbers**: Revert encrypted strings back to their original numeric form.
- **Cryptographically Secure Randomness**: Utilizes `random_int()` for secure random string generation.
- **Configurable Padding Lengths**: Customize the length of prefix and suffix padding added during encryption.
- **Input Validation**: Ensures that only valid numeric inputs are processed.
- **Customizable Mappings**: Modify digit-to-character mappings to suit specific requirements.
- **Enhanced Error Handling**: Provides descriptive exceptions for easier debugging and reliability.
- **Logging Capability**: Integrate with Laravel's logging system to monitor encryption and decryption processes.
- **Utility Methods**: Includes methods to verify if a string is encrypted and to customize encryption settings.

---

**Installation**

1. **Install via Composer**

   Run the following command in your terminal to install the package:

   ```
   composer require al-saloul/encryption
   ```

---

**Usage**


1. **Using the Encryption Class**

   **Using Helper Functions**

   For quick and straightforward usage, helper functions are available globally throughout your Laravel project after installing the package.

   ```php

    // Encrypt a number using the helper function
    $encrypted = encrypt_numbers(12345);
    // Output: "UQ9rovS*(Yr5inVd"

    // Check if the encrypted string is indeed encrypted
    $isEncrypted = is_encrypted($encrypted);
    // Output: true

    // Decrypt the encrypted string using the helper function
    $decrypted = decrypt_numbers($encrypted);
    // Output: 12345

    // Output results
    echo "Encrypted: " . $encrypted . PHP_EOL;
    echo "Is Encrypted: " . ($isEncrypted ? 'Yes' : 'No') . PHP_EOL;
    echo "Decrypted: " . $decrypted . PHP_EOL;
   ```

   *Note: Ensure that the helper functions are properly registered and autoloaded in your Laravel application.*


   **Using Encryption Class**

   Leverage the `Encryption` class to encrypt and decrypt numeric values seamlessly.

   ```php
   use Alsaloul\Encryption\Encryption;
   use Illuminate\Validation\ValidationException;

   try {
       $number = 1234567890;

       // Encrypt the number
       $encrypted = Encryption::encryptNumbers($number);
       echo "Encrypted: " . $encrypted . PHP_EOL;

       // Decrypt the encrypted string
       $decrypted = Encryption::decryptNumbers($encrypted);
       echo "Decrypted: " . $decrypted . PHP_EOL;

       // Check if a string is encrypted
       $isEncrypted = Encryption::isEncrypted($encrypted);
       echo "Is Encrypted: " . ($isEncrypted ? 'Yes' : 'No') . PHP_EOL;

   } catch (ValidationException $e) {
       // Handle decryption errors
       echo "Decryption failed: " . $e->getMessage() . PHP_EOL;
   } catch (\Exception $e) {
       // Handle other exceptions
       echo "An error occurred: " . $e->getMessage() . PHP_EOL;
   }
   ```

2. **Configuring Padding Lengths**

   Customize the prefix and suffix padding lengths to enhance security or meet specific requirements.

   ```php
   use Alsaloul\Encryption\Encryption;

   // Set custom padding lengths
   Encryption::setPaddingLengths(10, 5);

   // Now, encryption will use a prefix of 10 characters and a suffix of 5 characters
   $encrypted = Encryption::encryptNumbers(12345);
   ```

3. **Customizing Variable Mappings**

   Modify the digit-to-character mappings to define your own encryption patterns.

   ```php
   use Alsaloul\Encryption\Encryption;

   // Define custom mappings
   $customMappings = [
       "1" => "A1B2C3",
       "2" => "D4E5F6",
       "3" => "G7H8I9",
       "4" => "J0K1L2",
       "5" => "M3N4O5",
       "6" => "P6Q7R8",
       "7" => "S9T0U1",
       "8" => "V2W3X4",
       "9" => "Y5Z6A7",
       "0" => "B8C9D0",
   ];

   // Apply custom mappings
   Encryption::setVars($customMappings);

   // Encrypt and decrypt using custom mappings
   $encrypted = Encryption::encryptNumbers(67890);
   $decrypted = Encryption::decryptNumbers($encrypted);
   ```

4. **Integrating Logging**

   To enable logging of encryption and decryption processes, inject a `LoggerInterface` instance into the `Encryption` class.

   ```php
   use Alsaloul\Encryption\Encryption;
   use Monolog\Logger;
   use Monolog\Handler\StreamHandler;

   // Set up logger (using Monolog as an example)
   $logger = new Logger('encryption_logger');
   $logger->pushHandler(new StreamHandler(storage_path('logs/encryption.log'), Logger::INFO));

   // Instantiate the Encryption class with the logger
   $encryption = new Encryption($logger);

   try {
       $number = 9876543210;

       // Encrypt the number
       $encrypted = $encryption->encryptNumbers($number);
       echo "Encrypted: " . $encrypted . PHP_EOL;

       // Decrypt the encrypted string
       $decrypted = $encryption->decryptNumbers($encrypted);
       echo "Decrypted: " . $decrypted . PHP_EOL;

   } catch (\Exception $e) {
       // Handle exceptions
       echo "An error occurred: " . $e->getMessage() . PHP_EOL;
   }
   ```

   *Note: Logging is optional and can be enabled as needed. Ensure that logging sensitive information complies with your application's security policies.*

---

**Methods**

*Encryption Class Methods*

- **encryptNumbers(int|string $value): string**

  Encrypts the input numeric value and returns an encrypted string.

  ```php
  $encrypted = Encryption::encryptNumbers(12345);
  ```

- **decryptNumbers(string $value): string**

  Decrypts the encrypted string and returns the original numeric value.

  ```php
  $decrypted = Encryption::decryptNumbers($encrypted);
  ```

- **setPaddingLengths(int $prefixLength, int $suffixLength): void**

  Sets custom lengths for prefix and suffix padding used during encryption.

  ```php
  Encryption::setPaddingLengths(10, 5);
  ```

- **setVars(array $vars): void**

  Customizes the digit-to-character mappings for encryption.

  ```php
  Encryption::setVars($customMappings);
  ```

- **isEncrypted(string $value): bool**

  Checks if a given string follows the encryption format.

  ```php
  $isEncrypted = Encryption::isEncrypted($encryptedString);
  ```

---

**Usage Example**

Here’s a comprehensive example demonstrating various features of the package:

```php
use Alsaloul\Encryption\Encryption;
use Illuminate\Validation\ValidationException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Set up logger
$logger = new Logger('encryption_logger');
$logger->pushHandler(new StreamHandler(storage_path('logs/encryption.log'), Logger::INFO));

// Instantiate the Encryption class with the logger
$encryption = new Encryption($logger);

try {
    $number = 1234567890;

    // Encrypt the number
    $encrypted = $encryption->encryptNumbers($number);
    echo "Encrypted: " . $encrypted . PHP_EOL;

    // Decrypt the encrypted string
    $decrypted = $encryption->decryptNumbers($encrypted);
    echo "Decrypted: " . $decrypted . PHP_EOL;

    // Check if a string is encrypted
    $isEncrypted = Encryption::isEncrypted($encrypted);
    echo "Is Encrypted: " . ($isEncrypted ? 'Yes' : 'No') . PHP_EOL;

    // Set custom padding lengths
    Encryption::setPaddingLengths(10, 5);

    // Encrypt with new padding
    $encryptedWithCustomPadding = Encryption::encryptNumbers($number);
    echo "Encrypted with Custom Padding: " . $encryptedWithCustomPadding . PHP_EOL;

    // Set custom variable mappings
    $customMappings = [
        "1" => "A1B2C3",
        "2" => "D4E5F6",
        "3" => "G7H8I9",
        "4" => "J0K1L2",
        "5" => "M3N4O5",
        "6" => "P6Q7R8",
        "7" => "S9T0U1",
        "8" => "V2W3X4",
        "9" => "Y5Z6A7",
        "0" => "B8C9D0",
    ];
    Encryption::setVars($customMappings);

    // Encrypt and decrypt with custom mappings
    $customEncrypted = Encryption::encryptNumbers(67890);
    echo "Custom Encrypted: " . $customEncrypted . PHP_EOL;

    $customDecrypted = Encryption::decryptNumbers($customEncrypted);
    echo "Custom Decrypted: " . $customDecrypted . PHP_EOL;

} catch (ValidationException $e) {
    // Handle decryption errors
    echo "Decryption failed: " . $e->getMessage() . PHP_EOL;
} catch (\Exception $e) {
    // Handle other exceptions
    echo "An error occurred: " . $e->getMessage() . PHP_EOL;
}
```

---

**License**

This package is open-sourced software licensed under the MIT License.

---

**Contributing**

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes with clear messages.
4. Push to your fork and submit a pull request.

---

**Security Considerations**

While this package enhances the security of numeric data through obfuscation, it is **not** intended for encrypting highly sensitive information. For cryptographically secure encryption requirements, consider using established libraries such as OpenSSL or Sodium.

---

**Support**

If you encounter any issues or have questions, please open an issue on the GitHub repository: https://github.com/al-saloul/encryption/issues

---

**Changelog**

Please see the CHANGELOG.md for more information on what has changed recently.

