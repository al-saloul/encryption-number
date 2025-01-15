
# Laravel Number Encryption Package

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

## Overview
This package provides simple encryption and decryption functionality for numeric values. The encryption process involves mapping numbers to random strings, while decryption maps them back to the original numeric values.

## Features
- Encrypt Numbers: Encrypt numeric values into a non-readable string.
- Decrypt Numbers: Decrypt the encrypted string back to the original numeric value.
- Customizable: Easily customize the encryption logic with your own key or patterns.

## Installation

### 1. **Install via Composer**

To install the package, run the following command in your terminal:

```bash
composer require al-saloul/encryption
```

## Usage

### **1. Using the Encryption Class**

You can use the `Encryption` class directly for encrypting and decrypting numbers.

```php
use Alsaloul\Encryption\Encryption;

$id = 12345;

// Encrypt the number
$encrypted = Encryption::encryptNumbers($id);

// Decrypt the encrypted string
$decrypted = Encryption::decryptNumbers($encrypted);

// Output results
echo "Original: $id\n";
echo "Encrypted: $encrypted\n";
echo "Decrypted: $decrypted\n";
```

---

### **2. Using Helper Functions**

For quick and straightforward usage, helper functions are available.

```php
// Encrypt a number using the helper function
$encrypted = encrypt_number(12345);

// Decrypt the encrypted string using the helper function
$decrypted = decrypt_number($encrypted);

// Output results
echo "Encrypted: $encrypted\n";
echo "Decrypted: $decrypted\n";
```

These helper functions are globally available throughout your Laravel project after installing the package.

---
## Methods

- `encryptNumbers(int $value)`: Encrypts the input value and returns an encrypted string.
- `decryptNumbers(string $value)`: Decrypts the encrypted string and returns the original number.

## License

This package is open-sourced software licensed under the [MIT License](LICENSE).