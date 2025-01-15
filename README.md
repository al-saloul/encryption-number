

# Alsaloul Encryption Package

This package provides simple encryption and decryption functionality for numeric values. The encryption process involves mapping numbers to random strings, while decryption maps them back to the original numeric values.

## Features

- Encrypt numeric values using a custom encryption scheme.
- Decrypt encrypted values back to their original numeric form.
- Includes random padding for additional security.

## Installation

You can install this package in your Laravel project via Composer.

### Step 1: Add the repository to your `composer.json`

If you're using a local package or a package hosted in a private repository, add the repository path to the `repositories` section of your `composer.json` file.

```json
"repositories": [
    {
        "type": "path",
        "url": "packages/alsaloul/encryption"
    }
]

### Step 2: Add the autoload configuration

Add the `psr-4` autoload configuration in the `autoload` section of your `composer.json` file.

```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Alsaloul\\Encryption\\": "packages/alsaloul/encryption/src/"
    }
}
```

### Step 3: Update Composer

After updating the `composer.json` file, run the following command to update Composer's autoload files:

```bash
composer dump-autoload
```

### Step 4: Install the package (if necessary)

If the package is hosted in a Git repository or public repository, you can install it via Composer:

```bash
composer require alsaloul/encryption
```

---

## Usage

Once the package is installed, you can use the `Encryption` class to encrypt and decrypt numeric strings.

### Encrypt a Numeric String

To encrypt a number, simply call the `encryptNumbers` method with the number as a string.

```php
use Alsaloul\Encryption\Encryption;

$number = '12345';

// Encrypt the number
$encrypted = Encryption::encryptNumbers($number);

echo "Encrypted: $encrypted\n";
```

### Decrypt an Encrypted String

To decrypt an encrypted string, call the `decryptNumbers` method with the encrypted value.

```php
$decrypted = Encryption::decryptNumbers($encrypted);

echo "Decrypted: $decrypted\n";
```

### Example

Here is a full example of how to use the encryption and decryption:

```php
use Alsaloul\Encryption\Encryption;

$id = '12345';

// Encrypt the number
$encrypted = Encryption::encryptNumbers($id);
echo "Encrypted: $encrypted\n";

// Decrypt the number
$decrypted = Encryption::decryptNumbers($encrypted);
echo "Decrypted: $decrypted\n";
```

---

## How it Works

The package uses a custom encryption scheme based on a set of character mappings for each digit (0-9). The encryption process involves generating a random string of characters from a predefined set for each digit, and wrapping the result with random padding for added security.

### Encryption

- Each digit (0-9) is mapped to a string of characters (e.g., `1` maps to `"1q{k<*RFB"`).
- A random character from this mapped string is selected for each digit in the input number.
- Random padding is added to the result to make it more secure.

### Decryption

- The padding is removed from the encrypted string.
- Each character is mapped back to the corresponding digit using the predefined mappings.

---

## License

This package is open-source and released under the [MIT License](LICENSE).
```

---

### شرح للملف:

1. **التثبيت**:
   - يتم شرح كيفية إضافة الحزمة إلى `composer.json`، سواء كان المشروع يستخدم الحزمة بشكل محلي أو من خلال مستودع بعيد.
   - يتم توجيه المستخدم إلى إضافة المسارات اللازمة في `autoload` لتضمين الحزمة.

2. **الاستخدام**:
   - يتم تقديم أمثلة لاستخدام دوال `encryptNumbers` و `decryptNumbers` بشكل بسيط.
   - تم توضيح كيفية تشفير وفك تشفير الأرقام باستخدام هذه الدوال.

3. **كيف يعمل**:
   - يتم شرح آلية العمل الداخلية للحزمة، وهي خريطة الأحرف التي يتم استخدامها لتشفير وفك تشفير الأرقام.
   - يتم إضافة بعض الشرح حول كيفية إضافة الحشو العشوائي للتشفير.

4. **التراخيص**:
   - تم إضافة قسم التراخيص تحت اسم [MIT License] كترخيص مفتوح المصدر.

---

بعد أن تضيف هذا الملف إلى مشروعك، سيكون لدى أي مستخدم الحزمة فكرة واضحة عن كيفية استخدامها وكيفية تثبيتها في المشروع.