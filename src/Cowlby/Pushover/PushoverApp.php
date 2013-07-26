<?php

/*
 * This file is part of the PHP Pushover Bindings package.
 *
 * (c) Jose Prado <cowlby@me.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cowlby\Pushover;

use Pimple;

/**
 * Simple implementation of a Pushover notification system.
 *
 * @author Jose Prado <cowlby@me.com>
 */
class PushoverApp extends Pimple implements PushoverInterface
{
    /**
     * Constructor.
     *
     * @param string $token The application token to push with.
     * @param string $user  The user key to push with.
     */
    public function __construct($token, $user)
    {
        $this['token'] = $token;
        $this['user'] = $user;
    }

    /**
     * @see \Cowlby\Pushover\PushoverInterface::push()
     */
    public function push($message, array $parameters = array())
    {
        $fp = fsockopen('ssl://api.pushover.net', 443, $errno, $errstr, 30);

        if (FALSE === $fp) {
            throw new \RuntimeException($errstr, $errno);
        }

        $body = http_build_query(array_merge($parameters, array(
            'token' => $this['token'],
            'user' => $this['user'],
            'message' => $message
        )));

        $request = "POST /1/messages.json HTTP/1.1\r\n";
        $request .= "Host: api.pushover.net\r\n";
        $request .= "User-Agent: PHP Pushover Bindings/0.x (+https://github.com/cowlby/php-pushover-bindings)\r\n";
        $request .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $request .= "Content-Length: " . strlen($body) . "\r\n";
        $request .= "Connection: Close\r\n";
        $request .= "\r\n";
        $request .= $body;

        fwrite($fp, $request);
        fclose($fp);

        return true;
    }
}
