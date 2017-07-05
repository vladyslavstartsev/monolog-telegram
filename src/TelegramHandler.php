<?php
namespace rahimi\TelegramHandler;

use Exception;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * Telegram Handler For Monolog
 *
 * This class helps you in logging your application events
 * into telegram using it's API.
 *
 * @author Moein Rahimi <m.rahimi2150@gmail.com>
 */

class TelegramHandler extends AbstractProcessingHandler
{

    private $token;
    private $channel;
    const host = 'https://api.telegram.org/bot';

    /**
     * getting token a channel name from Telegram Handler Object.
     *
     * @param string $token Telegram Bot Access Token Provided by BotFather
     * @param string $channel Telegram Channel userName
     * @param string|int @level Debug level of Logged Event

     */

    public function __construct($token, $channel)
    {

        if (!extension_loaded('curl')) {
            throw new Exception('curl is needed to use this library');
        }

        $this->token   = $token;
        $this->channel = $channel;
    }

    /**
     * format the log to send
     * @param $record[] log data
     * @return void
     */
    public function write(array $record)
    {
        $format = new LineFormatter;

        $context = $record['context'] ? $format->stringify($record['context']) : '';

        $date = $record['datetime']->format("Y-m-d  h:m");

        $message = $date . PHP_EOL . $this->getEmoji($record['level']) . $record['message'] . $context;

        $this->send($message);

    }

    /**
     *    send log to telegram channel
     *    @param string $message Text Message
     *    @return void
     *
     */
    public function send($message)
    {
        $ch = curl_init();

        $url = self::host . $this->token . "/SendMessage";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            'text'    => $message,
            'chat_id' => $this->channel,
        )));

        curl_exec($ch);


    }

    /**
     * make emoji for log events
     * @return array
     *
     */
    protected function emojiMap()
    {
        return [
            Logger::DEBUG     => '🚧',
            Logger::INFO      => '‍🗨',
            Logger::NOTICE    => '🕵',
            Logger::WARNING   => '⚡️',
            Logger::ERROR     => '🚨',
            Logger::CRITICAL  => '🤒',
            Logger::ALERT     => '👀',
            Logger::EMERGENCY => '🤕',
        ];
    }

    /**
     * return emoji for given level
     *
     * @param $level
     * @return string
     */
    protected function getEmoji($level)
    {
        $levelEmojiMap = $this->emojiMap();
        return $levelEmojiMap[$level];
    }

}
