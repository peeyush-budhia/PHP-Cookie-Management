<?php

/**
 * @package         PHP-Lib
 * @description     Class is used for the Cookie Management
 * @copyright       Copyright (c) 2013, Peeyush Budhia
 * @author          Peeyush Budhia <peeyush.budhia@phpnmysql.com>
 */

class CookieManagement
{
    const ONE_DAY = 86400;
    const SEVEN_DAYS = 604800;
    const THIRTY_DAYS = 2592000;
    const SIX_MONTHS = 15811200;
    const ONE_YEAR = 31536000;
    const LIFETIME = -1;

    /**
     * @author          Peeyush Budhia <peeyush.budhia@phpnmysql.com>
     * @description     The function is used to set the cookie
     * @param $cookieName   Name of cookie
     * @param $cookieValue  Value of cookie
     * @param $cookieExpireTime Expire time of cookie
     * @param string $cookiePath Use to set the path of cookie
     * @return bool     "true" if cookie is set
     *                  "false" if failed to set the cookie
     */
    function CookieSet($cookieName, $cookieValue, $cookieExpireTime, $cookiePath = '/')
    {
        $resultCookie = false;

        if (headers_sent()) {
            return $resultCookie;
        }

        if ($cookieExpireTime == -1) {
            $cookieExpireTime = self::ONE_YEAR * 30;
        } elseif (is_numeric($cookieExpireTime)) {
            $cookieExpireTime += time();
        } else {
            $cookieExpireTime = strtotime($cookieExpireTime);
        }

        $resultCookie = setcookie($cookieName, base64_encode($cookieValue), $cookieExpireTime, $cookiePath);

        if ($resultCookie) {
            $_COOKIE[$cookieName] = $cookieValue;
        }
        return $resultCookie;
    }

    /**
     * @author          Peeyush Budhia <peeyush.budhia@phpnmysql.com>
     * @description     The function is used to check the existence of cookie
     * @param $cookieName Name of cookie to check it's existence
     * @return bool     "true" if cookie exists
     *                  "false" if cookie not exists
     */
    function isCookieExists($cookieName)
    {
        return isset($_COOKIE[$cookieName]);
    }

    /**
     * @author          Peeyush Budhia <peeyush.budhia@phpnmysql.com>
     * @description     The function is used to check the cookie is empty or not
     * @param $cookieName Name of cookie to check value is existing or not
     * @return bool       "true" if cookie is empty
     *                    "false" if cookie is not empty
     */
    function isCookieEmpty($cookieName)
    {
        return empty($_COOKIE[$cookieName]);
    }

    /**
     * @author          Peeyush Budhia <peeyush.budhia@phpnmysql.com>
     * @description     The function is used to delete the cookie
     * @param $cookieName   Name of cookie
     * @param bool $removeGlobal To make sure cookie to be deleted globally or not
     * @param string $cookiePath Use specify the cookie path
     * @return bool     "true" if cookie is deleted
     *                  "false" if failed to delete the cookie
     */
    function CookieDelete($cookieName, $removeGlobal = false, $cookiePath = '/')
    {
        $cookieResult = false;
        if (headers_sent()) {
            return $cookieResult;
        }
        $cookieResult = setcookie($cookieName, '', time() - self::ONE_DAY, $cookiePath);
        if ($removeGlobal) {
            unset($_COOKIE[$cookieName]);
        }

        return $cookieResult;

    }

    /**
     * @author          Peeyush Budhia <peeyush.budhia@phpnmysql.com>
     * @description     The function is used to get the cookie value
     * @param $cookieName   Name of cookie
     * @return string       Value of cookie
     */
    function CookieGet($cookieName)
    {
        return (isset($_COOKIE[$cookieName]) ? base64_decode($_COOKIE[$cookieName]) : '');
    }
}
