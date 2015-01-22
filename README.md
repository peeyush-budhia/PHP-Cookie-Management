# PHP-Cookie-Management
Class is used for the Cookie Management. The class performs the following actions:
1. Set the cookie using base64_encode().
2. Check the existence of a cookie.
3. Check the cookie is empty or not.
4. Delete the cookie.
5. Retrieve the cookie value.

Example usage:
1. Create Object
<?php
$Cookie = new CookieManagement();
?>

2. Set Cookie
<?php
$Cookie->CookieSet('cookieName','cookieValue', SEVEN_DAYS);

// The above code will set the cookie for 7 days.
// Other options: ONE_DAY, THIRTY_DAYS, SIX_MONTHS, ONE_YEAR, LIFETIME
?>

3. Check existence of cookie
<?php
if($Cookie->isCookieExists('cookieName'))  {
   echo 'Cookie exists';
} else {
   echo 'Cookie not exists';
?>

4. Check the cookie is empty or not, if not then print the value of cookie
<?php
if(!$Cookie->isCookieEmpty('cookieName)) {
   echo $Cookie->CookieGet('cookieName');
} else {
   echo 'Cookie is empty';
}
?>

5. Delete the cookie
<?php
   $Cookie->CookieDelete('cookieName');
?>
