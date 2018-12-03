<?php
define('FACEBOOK_LOGIN_SUCCESS', 'Facebook Login Successfully');
define('FACEBOOK_LOGIN_FAILURE', 'Something went wrong !!!');

//base path của web
define('BASE_PATH', 'http://localhost/tandat411.github.io/Task%20PHP/Week-5/Facebook');

//thông tin facebook app
define('FACEBOOK_APP_ID', '326156141308594');
define('FACEBOOK_APP_SECRET', 'f0505add66a8e65cad87f16682a2c970'); 
define('FACEBOOK_REDIRECT_URI', 
	'http://localhost/tandat411.github.io/Task%20PHP/Week-5/Facebook/callback');

define('FACEBOOK_SDK_V4_SRC_DIR','/vendor/facebook/graph-sdk/src/Facebook');
require_once(ROOT . DS . 'vendor' . DS . 'facebook' . DS . 
	'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php');
