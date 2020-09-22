# Microsoft Azure LUIS PHP SDK

[![Build Status](https://travis-ci.com/goodjun/azure-luis-php-sdk.svg?branch=master)](https://travis-ci.com/goodjun/azure-luis-php-sdk)
[![Coverage Status](https://coveralls.io/repos/github/goodjun/azure-luis-php-sdk/badge.svg?branch=master)](https://coveralls.io/github/goodjun/azure-luis-php-sdk?branch=master)

__Welcome to Microsoft Azure LUIS PHP SDK__. This repository contains Azure LUIS PHP SDK and samples for REST API.

## How to use?

```php
// from LUIS Profile -> Settings -> Authoring Resources
$primaryKey = '00000000-0000-0000-0000-000000000000';
$location = 'westus';

// Luis Client
$luisClient = new LuisClient($primaryKey, $location);

// create app
$app = new App();
$app->setName('app name')->setDescription('app description');
$appId = $luisClient->createApp($app);

// update app
$luisClient->app($appId)->update('new name','new description');

// delete app
$luisClient->app($appId)->delete();
```

## Prerequisites
 - PHP 5.5+.
 - cURL & JSON extension.

## Run a unit test

 - Run `composer install`
 - Set the environment variable.
    ```
    export LUIS_LOCATION=luis-location
    export LUIS_PRIMARY_KEY=luis-primary
    export LUIS_APP_ID=app-id
    ```
 - Run `php vendor/bin/phpunit`
 
## License

 - MIT

## LUIS Documentation

 - [What is Language Understanding (LUIS)?](https://docs.microsoft.com/zh-cn/azure/cognitive-services/luis/what-is-luis)
 - [LUIS Programmatic APIs v2.0](https://westus.dev.cognitive.microsoft.com/docs/services/5890b47c39e2bb17b84a55ff/operations/5890b47c39e2bb052c5b9c2f).