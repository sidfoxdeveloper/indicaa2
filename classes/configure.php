<?php
ob_start();
session_start();
error_reporting('E_ALL & ~E_NOTICE');

class Connect {

    function Connect() {
        
        define('URL_BASE', 'http://'. $_SERVER['HTTP_HOST'] . '/indicaa/');
        define('DIR_BASE', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/');        
        define('URL_BASEADMIN', 'http://' . $_SERVER['HTTP_HOST'] . '/indicaa/');
        define('DIR_BASEADMIN', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/');
        
        define('URL_SUPERADMIN', 'http://' . $_SERVER['HTTP_HOST'] . '/indicaa/superadmin/');
        define('DIR_SUPERADMIN', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/superadmin/');
        
        define('URL_MANAGER', 'http://' . $_SERVER['HTTP_HOST'] . '/indicaa/manager/');
        define('DIR_MANAGER', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/manager/');
        
        define('URL_COUNTRYADMIN', 'http://' . $_SERVER['HTTP_HOST'] . '/indicaa/countryadmin/');
        define('DIR_COUNTRYADMIN', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/countryadmin/');
        
        define('URL_EMOADMIN', 'http://' . $_SERVER['HTTP_HOST'] . '/indicaa/emoadmin/');
        define('DIR_EMOADMIN', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/emoadmin/');
        
        define('URL_COUNTRYMANAGER', 'http://' . $_SERVER['HTTP_HOST'] . '/indicaa/countrymanager/');
        define('DIR_COUNTRYMANAGER', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/countrymanager/');
        
        define('URL_INSPECTOR', 'http://' . $_SERVER['HTTP_HOST'] . '/indicaa/inspector/');
        define('DIR_INSPECTOR', $_SERVER['DOCUMENT_ROOT'] . '/indicaa/inspector/');
        
        define('CURRENT_PAGE', substr($_SERVER['REDIRECT_URL'], 10) );

        define('DIR_UPLOADS', 'uploads/');
        define('DIR_SECURE', 'secure/');
        define('DIR_INCLUDES', 'includes/');
        define('DIR_CLASSES', 'classes/');
        define('DIR_FUNCTIONS', 'functions/');
        define('DIR_IMAGES', 'images/');
        define('DIR_JS', 'js/');
        define('DIR_CSS', 'css/');
        define('DIR_SMTP', 'smtp/');
        define('DIR_JQUERYUI', 'jqueryui/');
        define('DIR_FANCYBOX', 'fancybox/');
        define('DIR_VALIDTIPS', 'validtips/');

        define('SITENAME', 'Indicaa Group');
        define('ADMIN_EMAIL', 'sidfoxdeveloper@gmail.com');
        
        /** Timezone **/
        /* date_default_timezone_set('Australia/Sydney'); */

        /** Define Currency Sign **/
        define('CUR_SIGN', '$');
        
        /** Define Google Maps Api Key **/
        /* define('MAP_API_KEY', 'AIzaSyDLTUQFb_yobdsH8sDSX23yUXu5XtX02wo'); */

        /** Deafult Variables * */
        define('DEF_COUNTRY', '11');
        define('DEF_PROVINCE', '1');
        define('DEFAULT_LIMIT', '10');

        define('BASSOCCIATES', 'Indicaa Group');
        define('BASSOCCIATES_LINK', '');
        
    }

    function dbconnect() {
        define('DBHOST', 'localhost');
        define('DBNAME', 'indicaa');
        define('DBUSER', 'root');
        define('DBPASS', 'root');
        $connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        return $connect;
    }

}