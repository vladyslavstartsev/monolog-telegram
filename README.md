

monolog-telegram
=============

Telegram Handler for monolog which allows you to log messages into telegram channels using bots . 




# Screenshot
-------------
![telegram handler demo screenshot](https://i.imgsafe.org/9d330119c8.png)





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
use rahimi\TelegramHandler\TelegramHandler;
$log = new Logger('TelegramHandler');
$log->pushHandler(new TelegramHandler($token,$channel));


$log->info('hello world !');
/**
* There is 8 level of logging
*/
$log->notice('hello world !');
$log->info('hello world !');
$log->debug('hello world !');
$log->warning('hello world !');
$log->critical('hello world !');
$log->alert('hello world !');
$log->emergency('hello world !');
$log->error('hello world !');


/**
* Optionally you can pass second paramater such as a object
**/
$log->info('user just logged in !',['user'=>$user]);

```

# License
This tool in Licensed under MIT, so feel free to fork it and make it better that it is !
