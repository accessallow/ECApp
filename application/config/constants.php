<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



//define('URL','http://site1.lixter.com/');
//define('URL_X','http://site1.lixter.com/index.php/');


define('URL','http://localhost/ECApp/');
define('URL_X',URL.'index.php/');

define('IMG',URL.'bootstrap/img/');
define('CSS',URL.'bootstrap/css/');
define('JS',URL.'bootstrap/js/');
define('ICO',URL.'bootstrap/ico/');
define('PLUGINS',URL.'bootstrap/bootstrap_plugins/');
/* End of file constants.php */
/* Location: ./application/config/constants.php */

define('IMAGE_SERVER','http://localhost/image_server/');

//Info to be printed on bill titles
define('SHOP_NAME','Krishna Electronics');
define('SHOP_ADDR','125-C, Indrapuri');
define('PHONE','9584338959');

// Mega Title on the header bar
define('MegaTitle','Sanchaar ERP');