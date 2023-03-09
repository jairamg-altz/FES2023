<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$srName = $_SERVER['SCRIPT_NAME'];
if(!empty($srName)) { $main_root = "https://" . $_SERVER['HTTP_HOST'].$srName;}
else { $main_root = "http://" . $_SERVER['HTTP_HOST'];}
/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); //highest automatically-assigned error code
//Root Configuration
define('ACCESS_KEY', '202012-2DEC4-TW212-0001');
define('SESSION_NAME', 'fes_home');
define('NODE_URL', 'http://localhost:8080');
define('API_URL', $main_root);
define('IMAGE_URL', $main_root.'/../media/img/');
//print_r(IMAGE_URL);exit;
//Mail Configuration
define('PROTOCOL', 'smtp');
define('SMTP_HOST', 'tls://mail.indiaobservatory.org.in');
define('SMTP_PORT', 587);//25,587/465
define('SMTP_USER', 'ibis@indiaobservatory.org.in');
define('SMTP_PASS', 'Earlier@123');
define('email_id', 'ibis@indiaobservatory.org.in');
/*define('SMTP_PASS', 'April@2022');
define('email_id', 'ibis@fes.org.in');*/


/*
* Data Playground Range Map Services
* Species, Temporal and Spatial Demand Map Services
*/
define('speciesBiomesWMSUrl', 'https://data.altztech.com/FES/wms?');
define('speciesBiomesLayerName', 'FES:Mammals');
define('avesLayerURL', 'https://data.altztech.com/FES/wms?');
define('ambhibiansLayerURL', 'https://data.altztech.com/FES/wms?');
define('reptiliansLayerURL', 'https://data.altztech.com/FES/wms?');
define('mammalianLayerURL', 'https://data.altztech.com/FES/wms?');
define('spatialDemandLayerURL', 'https://data.altztech.com/FES/wms?');
define('temporalDemandLayerURL', 'https://data.altztech.com/FES/wms?');
define('avesLayerName', 'FES:aves');
define('ambhibiansLayerName', 'FES:amphibians');
define('reptiliansLayerName', 'FES:reptilians');
define('mammaliansLayerName', 'FES:mammalians');
define('spatialDemandLayerName', 'FES:spatialdemand');
define('temporalDemandLayerName', 'FES:temporaldemand');


/* Instagram App Client Id */
define('INSTAGRAM_CLIENT_ID', '1073640066597637');

/* Instagram App Client Secret */
define('INSTAGRAM_CLIENT_SECRET', 'bbe5dee54305f6df64fed99dadbdef68');

/* Instagram App Redirect Url */
define('INSTAGRAM_REDIRECT_URI', 'https://fes.altztech.com/index.php/Login/insta/');
define('authURL', "https://api.instagram.com/oauth/authorize/?client_id=" . INSTAGRAM_CLIENT_ID . "&redirect_uri=" . INSTAGRAM_REDIRECT_URI. "&scope=user_profile&response_type=code");

//print_r(authURL);exit;
/*google crendencials*/
define('ClientID', '485998340075-029tba4aovrehrot92c9lttrh8ibfc9s.apps.googleusercontent.com');
define('CLIENTSECRET', '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');
define('REDIRECT_URI', 'https://fes.altztech.com/index.php/Login/glogin');
/*define('ClientID', '987326083632-rri386fnbo35nbblsuar3gpigjjj1rv9.apps.googleusercontent.com');
define('CLIENTSECRET', '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');
define('REDIRECT_URI','https://fes.altztech.com/index.php/Login/glogin');*/

include_once APPPATH . "libraries/vendor/autoload.php";
    $google_client = new Google_Client();
    $google_client->setClientId(ClientID); //Define your ClientID
    $google_client->setClientSecret(CLIENTSECRET); //Define your Client Secret Key
    $google_client->setRedirectUri(REDIRECT_URI); //Define your Redirect Uri
    $google_client->addScope('email'); 
    $google_client->addScope('profile');
$loginURL =  $google_client->createAuthUrl();
define('loginURL', $loginURL);