<?php
namespace jdpowered\SocialBox\Logging;

class Line {

    /**
     * The timestamp when the message has been logged
     *
     * @type integer
     */
    public $timestamp;

    /**
     * The level
     *
     * @type string
     */
    public $level;

    /**
     * The message
     *
     * @type string
     */
    public $message;

    /**
     * Additional context/data
     *
     * @type mixed
     */
    public $context;

}
