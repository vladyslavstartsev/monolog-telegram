monolog-mysql
=============

Telegram Handler for monolog which allows you to log messages into telegram channels using bots . 


# Installation
-----------
Install using composer:

  >composer require rahimi/monolog-telegram  


# Usage
it is just like other monolog handlers, you need to pass below paramaters to telegramhandler object:
- **$token** your bot token provided by BotFather
- **$channel** your telegram channel userName


# Examples
Now Simply use it like this :

```php
require 'vendor/autoload.php';
use Monolog\Logger;
use Moein\TelegramHandler\TelegramHandler;
$log = new Logger('TelegramHandler');
$log->pushHandler(new TelegramHandler($token,$channel));


$log->info('hello world !');
```

# License
This tool in Licensed under MIT, so feel free to fork it and make it better that it is !
