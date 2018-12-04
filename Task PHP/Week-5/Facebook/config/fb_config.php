<?php
define('FACEBOOK_LOGIN_SUCCESS', 'Facebook Login Successfully');
define('FACEBOOK_LOGIN_FAILURE', 'Something went wrong !!!');

//base path của web
define('BASE_PATH', 'http://localhost/tandat411.github.io/Task%20PHP/Week-5/Facebook');

//thông tin facebook app
define('FACEBOOK_APP_ID', '1013156468871860');
define('FACEBOOK_APP_SECRET', '58212ae6de206d1cc294687e27a0c557'); 
define('FACEBOOK_REDIRECT_URI', 
	'http://localhost/tandat411.github.io/Task%20PHP/Week-5/Facebook/callback');

define('FACEBOOK_SDK_V4_SRC_DIR','/vendor/facebook/graph-sdk/src/Facebook');
require_once(ROOT . DS . 'vendor' . DS . 'facebook' . DS . 
	'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php');
