<?php
namespace jdpowered\SocialBox\Logging;

interface LogInterface {

    /**
     * Create a new instance
     *
     * @param  string  $option The name of the database option to use as storage
     * @param  integer $lines The number of lines to keep
     *
     * @return jdpowered\SocialBox\Logging\LogInterface;
     */
    public function __construct($option, $size);

    /**
     * Log an error message
     *
     * @param  string $message
     * @param  mixed  $context = null
     *
     * @return void
     */
    public function error($message, $context = null);

    /**
     * Log a success message
     *
     * @param  string $message
     * @param  mixed  $context = null
     *
     * @return void
     */
    public function success($message, $context = null);

    /**
     * Get the logs content
     *
     * @param  integer $lines = null
     *
     * @return array
     */
    public function get($lines = null);

}
