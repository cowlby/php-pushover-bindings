PHP Pushover Bindings
=====================

[![Build Status](https://secure.travis-ci.org/cowlby/php-pushover-bindings.png?branch=master)](http://travis-ci.org/cowlby/php-pushover-bindings)

This PHP Pushover bindings library provides a simple PHP interface with which to push messages via Pushover.

Installation
------------

The recommended way to install PHP Pushover Bindings is [through
composer](http://getcomposer.org). Just create a `composer.json` file and
run the `php composer.phar install` command to install it:

    {
        "require": {
            "cowlby/php-pushover-bindings": "~1.0"
        }
    }


Usage
-----

Create a PushoverApp instance:

    use Cowlby\Pushover\PushoverApp;

    $token = 'YOUR_APPLICATION_TOKEN';
    $user  = 'YOUR_USER_KEY';
    $pushover = new PushoverApp($token, $user);

Push messages with the `push()` method:

    $pushover->push('Hello World!');

You also pass an optional array of parameters as the second argument:

    $pushover->push('Hello World!', array(
        'title' => 'Testing'
    ));
