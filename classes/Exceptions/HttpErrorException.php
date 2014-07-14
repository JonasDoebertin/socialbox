<?php
namespace jdpowered\SocialBox\Exceptions;

use jdpowered\SocialBox\Exception;

class HttpErrorException extends Exception {

    public function __construct($result)
    {
        /*
            Set error message based on type of result data
         */
        if ($result instanceof WP_Error) {

            $message = $result->get_error_message();

        } else if (isset($result['response'])) {

            $message = "{$result['response']['code']} {$result['response']['message']}: {$result['body']}";

        } else {

            $message = __('Unknown HTTP error', 'socialbox');

        }

        /*
            Store result data
         */
        $this->result = $result;

        /*
            Pass on to parent
         */
        parent::__construct($message);
    }

}
