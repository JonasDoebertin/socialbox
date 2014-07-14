<?php
namespace jdpowered\SocialBox\Exceptions;

use jdpowered\SocialBox\Exception;

class MalformedDataException extends Exception {

    public function __construct($result)
    {
        /*
            Set an error message
         */
        $message = __('Received malformed data from API', 'socialbox');

        /*
            Pass on to parent
         */
        parent::__construct($message);
    }

}
