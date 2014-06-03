<?php

$dir = dirname(__FILE__);

/*
    Map classes to the corresponding files
*/
$classes = array(
    'TwitterOAuth'                   => $dir . '/src/TwitterOAuth.php',
    'OAuthException'                 => $dir . '/src/OAuth/Exception.php',
    'OAuthConsumer'                  => $dir . '/src/OAuth/Consumer.php',
    'OAuthToken'                     => $dir . '/src/OAuth/Token.php',
    'OAuthSignatureMethod'           => $dir . '/src/OAuth/SignatureMethods/SignatureMethod.php',
    'OAuthSignatureMethod_HMAC_SHA1' => $dir . '/src/OAuth/SignatureMethods/HmacSha1SignatureMethod.php',
    'OAuthSignatureMethod_PLAINTEXT' => $dir . '/src/OAuth/SignatureMethods/PlaintextSignatureMethod.php',
    'OAuthSignatureMethod_RSA_SHA1'  => $dir . '/src/OAuth/SignatureMethods/RsaSha1SignatureMethod.php',
    'OAuthRequest'                   => $dir . '/src/OAuth/Request.php',
    'OAuthServer'                    => $dir . '/src/OAuth/Server.php',
    'OAuthDataStore'                 => $dir . '/src/OAuth/DataStores/DataStore.php',
    'OAuthUtil'                      => $dir . '/src/OAuth/Util.php',
);

/*
    Load classes
*/
foreach($classes as $class => $file)
{
    if( ! class_exists($class))
    {
        include $file;
    }
}
