# Filesize Extension

[![Build Status](https://travis-ci.org/loonkwil/filesize-extension-bundle.png)](https://travis-ci.org/loonkwil/filesize-extension-bundle)

## Install

### Symfony 4.x, 5.x

```bash
composer require spe/filesize-extension-bundle:^2.0
```

### Symfony 2.x, 3.x

```bash
composer require spe/filesize-extension-bundle:^1.0
```

app/AppKernel.php:
```php
$bundles = array(
    // ...
    new SPE\FilesizeExtensionBundle\SPEFilesizeExtensionBundle(),
    // ...
);
```

## Usage

```twig
{{ file.size|readable_filesize }} {# 123.45 KB #}
{{ file.size|readable_filesize(0) }} {# 123 KB #}
{{ file.size|readable_filesize(0, '') }} {# 123KB #}
```
