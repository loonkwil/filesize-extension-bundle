# Filesize Extension

[![Build Status](https://travis-ci.org/loonkwil/filesize-extension-bundle.png)](https://travis-ci.org/loonkwil/filesize-extension-bundle)

## Install

composer.json
```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/loonkwil/filesize-extension-bundle.git"
    },
],
"require": {
    "spe/filesize-extension-bundle": "dev-master",
}
```

```bash
php composer.phar update
```

### Symfony 2.x

app/AppKernel.php:
```php
$bundles = array(
    // ...
    new SPE\FilesizeExtensionBundle\SPEFilesizeExtensionBundle(),
    // ...
);
```

### Silex

```php
use SPE\FilesizeExtensionBundle\Twig\FilesizeExtension;

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new FilesizeExtension());

    return $twig;
}));
```

## Usage

```twig
{{ file.size|readable_filesize }}
```
