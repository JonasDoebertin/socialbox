<?php namespace jdpowered\TwitterOAuth;

/*
    Modified 2014 by Jonas Döbertin
    Original by Abraham Williams


    ORIGINAL LICENSE

    Copyright (c) 2009 Abraham Williams - http://abrah.am - abraham@abrah.am

    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
*/

/**
 * Twitter OAuth class
 */
class TwitterOAuth {

    /* Contains the last HTTP status code returned. */

    /* Contains the last API call. */
    public $url;
    /* Set timeout default. */
    public $timeout = 30;
    /* Set connect timeout. */
    public $connecttimeout = 30;
    /* Respons format. */

    /* Decode returned json data. */

    /* Contains the last HTTP headers returned. */
    public $http_info;

    /**
     *
     */
    const USER_AGENT = 'TwitterOAuth/0.1.0-dev';

    /**
     *
     */
    const HOST = "https://api.twitter.com/1.1/";

    /**
     * @var
     */
    private $sslVerification = true;

    /**
     * @var
     */
    private $userAgent;

    /**
     * @var
     */
    private $decodeJSON = true;

    /**
     * @var
     */
    private $format = 'json';

    /**
     * @var
     * Read-Only
     */
    private $lastStatusCode;

    /**
     * @var
     */
    private $signatureMethod;

    /**
     * @var
     */
    private $consumer;

    /**
     * @var
     */
    private $token;

    /**
     * construct TwitterOAuth object
     */
    function __construct($consumerKey, $consumerSecret, $token = null, $tokenSecret = null)
    {

        /* Initialize the signature method */
        $this->signatureMethod = new OAuthSignatureMethod_HMAC_SHA1();

        /* Create OAuth consumer */
        $this->consumer = new OAuthConsumer($consumerKey, $consumerSecret);

        /* Set OAuth token, if available */
        if(!empty($token) and !empty($tokenSecret))
        {
            $this->token = new OAuthConsumer($token, $tokenSecret);
        }
        else
        {
            $this->token = null;
        }
    }





    /**************************************************************************\
    *                        PROPERTY GETTERS & SETTERS                        *
    \**************************************************************************/

    public function setSslVerification($newSslVerification)
    {
        $this->sslVerification = $newSslVerification;
    }

    public function getSslVerification()
    {
        return $this->sslVerification;
    }

    public function setUserAgent($newUserAgent)
    {
        $this->userAgent = $newUserAgent;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setDecodeJSON($newDecodeJSON)
    {
        $this->decodeJSON = $newDecodeJSON;
    }

    public function getDecodeJSON()
    {
        return $this->decodeJSON;
    }

    public function getLastStatusCode()
    {
        return $this->lastStatusCode;
    }

    public function setFormat($newFormat)
    {
        $this->format = $newFormat;
    }

    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set API URLS
     */
    function accessTokenURL()
    {
        return 'https://api.twitter.com/oauth/access_token';
    }

    function authenticateURL()
    {
        return 'https://api.twitter.com/oauth/authenticate';
    }

    function authorizeURL()
    {
        return 'https://api.twitter.com/oauth/authorize';
    }

    function requestTokenURL()
    {
        return 'https://api.twitter.com/oauth/request_token';
    }

    /**
     * Debug helpers
     */
    function lastStatusCode()
    {
        return $this->http_status;
    }

    function lastAPICall()
    {
        return $this->last_api_call;
    }




    /**
     * Get a request_token from Twitter
     *
     * @returns a key/value array containing oauth_token and oauth_token_secret
     */
    function getRequestToken($oauth_callback)
    {
        $parameters = array();
        $parameters['oauth_callback'] = $oauth_callback;

        $request = $this->oAuthRequest($this->requestTokenURL(), 'GET', $parameters);

        $token = OAuthUtil::parse_parameters($request);
        $this->token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret']);
        return $token;
    }

    /**
     * Get the authorize URL
     *
     * @returns a string
     */
    function getAuthorizeURL($token, $sign_in_with_twitter = true)
    {
        if(is_array($token))
        {
            $token = $token['oauth_token'];
        }

        if(empty($sign_in_with_twitter))
        {
            return $this->authorizeURL() . "?oauth_token={$token}";
        }
        else
        {
            return $this->authenticateURL() . "?oauth_token={$token}";
        }
    }

    /**
     * Exchange request token and secret for an access token and
     * secret, to sign API calls.
     *
     * @returns array("oauth_token" => "the-access-token",
     *                "oauth_token_secret" => "the-access-secret",
     *                "user_id" => "9436992",
     *                "screen_name" => "abraham")
     */
    function getAccessToken($oauth_verifier)
    {
        $parameters = array();
        $parameters['oauth_verifier'] = $oauth_verifier;

        $request = $this->oAuthRequest($this->accessTokenURL(), 'GET', $parameters);

        $token = OAuthUtil::parse_parameters($request);
        $this->token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret']);
        return $token;
    }

    /**
     * One time exchange of username and password for access token and secret.
     *
     * @returns array("oauth_token" => "the-access-token",
     *                "oauth_token_secret" => "the-access-secret",
     *                "user_id" => "9436992",
     *                "screen_name" => "abraham",
     *                "x_auth_expires" => "0")
     */
    function getXAuthToken($username, $password)
    {
        $parameters = array();
        $parameters['x_auth_username'] = $username;
        $parameters['x_auth_password'] = $password;
        $parameters['x_auth_mode'] = 'client_auth';

        $request = $this->oAuthRequest($this->accessTokenURL(), 'POST', $parameters);

        $token = OAuthUtil::parse_parameters($request);
        $this->token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret']);
        return $token;
    }

    /**
     * GET wrapper for oAuthRequest.
     */
    function get($url, $parameters = array())
    {
        $response = $this->oAuthRequest($url, 'GET', $parameters);

        if($this->format === 'json' && $this->decodeJSON)
        {
            return json_decode($response);
        }

        return $response;
    }

    /**
     * POST wrapper for oAuthRequest.
     */
    function post($url, $parameters = array())
    {
        $response = $this->oAuthRequest($url, 'POST', $parameters);

        if($this->format === 'json' && $this->decodeJSON)
        {
            return json_decode($response);
        }

        return $response;
    }

    /**
     * DELETE wrapper for oAuthReqeust.
     */
    function delete($url, $parameters = array())
    {
        $response = $this->oAuthRequest($url, 'DELETE', $parameters);

        if($this->format === 'json' && $this->decodeJSON)
        {
            return json_decode($response);
        }

        return $response;
    }

    /**
     * Format and sign an OAuth / API request
     */
    function oAuthRequest($url, $method, $parameters) {

        if(strrpos($url, 'https://') !== 0 && strrpos($url, 'http://') !== 0)
        {
            $url = self::HOST . "{$url}.{$this->format}";
        }

        $request = OAuthRequest::from_consumer_and_token($this->consumer, $this->token, $method, $url, $parameters);
        $request->sign_request($this->signatureMethod, $this->consumer, $this->token);

        switch($method)
        {
            case 'GET':
                return $this->http($request->to_url(), 'GET');

            default:
                return $this->http($request->get_normalized_http_url(), $method, $request->to_postdata());
        }
    }

    /**
     * Make an HTTP request
     *
     * @return API results
     */
    function http($url, $method, $postfields = null)
    {
        $this->http_info = array();
        $ci = curl_init();

        /* Curl settings */
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array('Expect:'));

        /*
            Set user agent string
        */
        if( ! empty($this->userAgent))
        {
            curl_setopt($ci, CURLOPT_USERAGENT, self::USER_AGENT . ' ' . $this->userAgent);
        }
        else
        {
            curl_setopt($ci, CURLOPT_USERAGENT, self::USER_AGENT);
        }

        /*
            Set SSL peer and host verification
        */
        if( ! $this->sslVerification)
        {
            curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ci, CURLOPT_HEADER, false);

        switch($method)
        {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if(!empty($postfields))
                {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                }
            break;

            case 'DELETE':
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if(!empty($postfields))
                {
                    $url = "{$url}?{$postfields}";
                }
            break;
        }

        curl_setopt($ci, CURLOPT_URL, $url);

        $response = curl_exec($ci);

        $this->lastStatusCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ci));
        $this->url = $url;

        curl_close($ci);
        return $response;
    }

    /**
     * Get the header info to store.
     */
    function getHeader($ch, $header)
    {
        $i = strpos($header, ':');

        if( ! empty($i))
        {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }

        return strlen($header);
    }
}
