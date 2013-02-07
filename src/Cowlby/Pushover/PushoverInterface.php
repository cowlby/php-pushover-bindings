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

/**
 * Defines the general interface for pushing messages with Pushover.
 *
 * @author Jose Prado <cowlby@me.com>
 */
interface PushoverInterface
{
    /**
     * Pushes a message to Pushover.
     *
     * @param string $message The message to log.
     * @return PushoverInterface
     */
    public function push($message);
}
