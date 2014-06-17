<?php

abstract class OAuthDataStore {

    abstract function lookup_consumer($consumer_key);

    abstract function lookup_token($consumer, $token_type, $token);

    abstract function lookup_nonce($consumer, $token, $nonce, $timestamp);

    abstract function new_request_token($consumer, $callback = null);

    abstract function new_access_token($token, $consumer, $verifier = null);

}
