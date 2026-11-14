<?php
defined('BASEPATH') OR exit('No direct script access allowed');
defined('APP_NAME') OR define('APP_NAME', 'TikTok Agency Monitoring');

if ( ! function_exists('random_bytes'))
{
    function random_bytes($length)
    {
        if ( ! is_int($length) || $length < 1)
        {
            trigger_error('random_bytes() expects a positive integer length', E_USER_WARNING);
            return FALSE;
        }

        if (function_exists('openssl_random_pseudo_bytes'))
        {
            $bytes = openssl_random_pseudo_bytes($length, $strong);
            if ($bytes !== FALSE && $strong === TRUE)
            {
                return $bytes;
            }
        }

        if (function_exists('mcrypt_create_iv'))
        {
            $bytes = mcrypt_create_iv($length, MCRYPT_DEV_URANDOM);
            if ($bytes !== FALSE)
            {
                return $bytes;
            }
        }

        trigger_error('random_bytes() requires a cryptographically secure random source on this PHP installation.', E_USER_ERROR);
        return FALSE;
    }
}
