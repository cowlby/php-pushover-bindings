<?php

namespace Cowlby\Pushover;

use Pimple;

class PushoverApp extends Pimple implements PushoverInterface
{
	public function __construct($token, $user, $device)
	{
		$this['token'] = $token;
		$this['user'] = $user;
		$this['device'] = $device;
	}
	
	public function push($message)
	{
		$fp = fsockopen('ssl://api.pushover.net', 443, $errno, $errstr, 30);

		if (FALSE === $fp) {
            throw new \RuntimeException($errstr, $errno);
        }

		$body = sprintf('token=%s&user=%s&device=%s&message=%s',
			urlencode($this['token']),
			urlencode($this['user']),
			urlencode($this['device']),
			urlencode($message)
		);

        $request = "POST /1/messages.json HTTP/1.1\r\n";
        $request .= "Host: api.pushover.net\r\n";
        $request .= "User-Agent: PHP Pushover Bindings/0.x (+https://github.com/cowlby/php-pushover-bindings)\r\n";
        $request .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $request .= "Content-Length: " . strlen($body) . "\r\n";
        $request .= "Connection: Close\r\n";
	    $request .= "\r\n";
        $request .= $body;

        fwrite($fp, $request);

		while (!feof($fp)) {
			echo fgets($fp, 128);
	    }

        fclose($fp);

        return TRUE;
	}
}
