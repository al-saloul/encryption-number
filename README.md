
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

You can use the Encryption class directly for encrypting and decrypting numbers.


### Example usage:

```php
use Alsaloul\Encryption\Encryption;

$encrypted = Encryption::encryptNumbers($id);

$decrypted = Encryption::decryptNumbers($encrypted);

```
## Methods

- `encryptNumbers(int $value)`: Encrypts the input value and returns an encrypted string.
- `decryptNumbers(string $value)`: Decrypts the encrypted string and returns the original number.

## License

This package is open-sourced software licensed under the [MIT License](LICENSE).