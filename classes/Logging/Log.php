<?php
namespace jdpowered\SocialBox\Logging;

class Log implements LogInterface {

    /**
     * The name of the database option to use as storage
     *
     * @type string
     */
    protected $option;

    /**
     * The number of lines to keep
     *
     * @type integer
     */
    protected $size;

    /**
     * The log content
     *
     * @type array
     */
    protected $lines;

    /**
     * Create a new instance
     *
     * @param  string  $option The name of the database option to use as storage
     * @param  integer $lines The number of lines to keep
     *
     * @return jdpowered\SocialBox\Logging\Log;
     */
    public function __construct($option, $size)
    {
        $this->option = $option;
        $this->size   = $size;

        $this->load();
    }

    /**
     * Log an error message
     *
     * @param  string $message
     * @param  mixed  $context = null
     *
     * @return void
     */
    public function error($message, $context = null)
    {
        $this->log(Levels::ERROR, $message, $context);
    }

    /**
     * Log a success message
     *
     * @param  string $message
     * @param  mixed  $context = null
     *
     * @return void
     */
    public function success($message, $context = null)
    {
        $this->log(Levels::SUCCESS, $message, $context);
    }

    /**
     * Get the logs content
     *
     * @param  integer|null $num
     *
     * @return array
     */
    public function get($num = null)
    {
        /*
            Return all lines if a limit was not set
         */
        if(is_null($num))
            $num = count($this->lines);

        return array_slice($this->lines, count($this->lines) - $num);
    }

    /**
     * Log a message
     *
     * @param  string $level
     * @param  string $message
     * @param  mixed  $context = null
     *
     * @return void
     */
    protected function log($level, $message, $context = null)
    {
        /*
            Create new log entry
         */
        $line = new Line;
        $line->timestamp = time();
        $line->level     = $level;
        $line->message   = $this->interpolate($message, $context);
        $line->context   = $context;

        /*
            Save log entry
         */
        $this->lines[] = $line;
        $this->save();
    }

    /**
     * Load the current log entries from database
     *
     * @return array
     */
    protected function load()
    {
        /*
            Get current log from database
         */
        $this->lines = get_option($this->option);

        /*
            Make sure we're working with an array
         */
        if( ! is_array($this->lines))
            $this->lines = array();
    }

    /**
     * Save the log lines to database
     *
     * @return void
     */
    protected function save()
    {
        /*
            Limit the log size
         */
        $this->truncateLines();

        /*
            Save lines to database
         */
        update_option($this->option, $this->lines);
    }

    /**
     * Truncate lines array by removing out-dated log entries.
     *
     * @return void
     */
    protected function truncateLines()
    {
        if(count($this->lines) > $this->size)
            $this->lines = array_slice($this->lines, (count($this->lines) - $this->size));
    }

    /**
     * Interpolate context values into the message placeholders
     *
     * @param  string     $message
     * @param  array|null $context
     *
     * @return string
     */
    protected function interpolate($message, $context = null)
    {
        /*
            If the context hasn't been set or isn't an array, simply return the
            massage
         */
        if(is_null($context) or ! is_array($context))
            return $message;

        /*
            Build a replacement array with braces around the context keys
         */
        $replacements = $this->buildReplacements($context);

        /*
            Interpolate replacement values into the message and return it
         */
        return strtr($message, $replacements);
    }

    /**
     * Recursively build an array with all the replacement strings
     *
     * @param array  $context
     * @param string $base    = ''
     *
     * @return array
     */
    protected function buildReplacements($context, $base = '')
    {
        $replacements = array();

        foreach($context as $key => $value)
        {
            if (is_array($value)) {
                $replacements = array_merge($replacements, $this->buildReplacements($value, $key . '.'));
            } else {
                $replacements['{' . $base . $key . '}'] = $value;
            }
        }

        return $replacements;
    }

}
