<?php
////////////////////////////////////////////
// -- DEVELOPMENT SERVER CONFIGURATION -- //
////////////////////////////////////////////

$dbHost      = "localhost";
$dbName      = "";
$dbUser      = "root";
$dbPasswd    = "";
$dbBackupDir = "/opt/pdai/backups";

// number of items displayed per page
$count        = 5;
// number of items displayed per page for the admin section
$count_admin  = 5;
// number of items displayed in the main page section resume
$count_resume = 3;
// number of items displayed per page for movile phones
$count_wap    = 3;
// max width for movile phones
$wap_width    = 20;
// number of items displayed per page for RSS documents
$count_rss    = 10;
// number of items displayed per page for ATOM documents
$count_atom   = 10;
// number of items displayed per page for the search
$searchCount  = 10;

// Session Time (seconds)
$SESSION_TIME = 3600;
// Application Name
$SYSTEM_NAME  = "DIMESAT";
// Admin Name
$ADMIN_NAME   = "Ariel Siles Encinas";
// Admin Login
$ADMIN_LOGIN  = "admin";
// Admin Password
$ADMIN_PASSWD = "admin";
// Mail of the administrator
$ADMIN_MAIL   = "arielrse@gmail.com";
// Path to find the directory with the 3th party libraries
$LIB          = "/home/dimesat/public_html/lib";
// URL to find the directory with the 3th party libraries
//$URL_LIB      = "http://200.105.204.226/lib"; //"http://localhost/lib";
$URL_LIB      = "http://localhost/lib";
// Path where the application is installed
$PATH         = "/home/dimesat/public_html";
// Path for the cache. Warning: it may not be a directory published
$CACHE        = "/opt/armonia";
// URL Root
$ROOT          = "http://www.dimesat.com.bo";
// URL of the system, it can be a domain, subdomain and can be in a directory
$URL          = "http://www.dimesat.com.bo";
$URLEN		  = "http://www.dimesat.com.bo";
// Set of colors and layour for the system
$THEME        = "default";
// URL Image
$URL2       = "$URL/system/presentation/templates/$THEME";
// Get a free google maps code for your site in: http://www.google.com/apis/maps/signup.html
$KEY_GOOGLE   = "ABQIAAAAZYk_-rVkJS9rZj2dXsrNZBSDBoE1C3D23Ne7y9nVbclYBuPsERSnb5Uql49v14kuD-rExecuf3QoKQ";


/////////////////////////////////////
// -- TEST SERVER CONFIGURATION -- //
/////////////////////////////////////
/*
$dbHost      = "localhost";
$dbName      = "";
$dbUser      = "";
$dbPasswd    = "";
$dbBackupDir = "/home/sienteco/cache/delicious/backups";

$count        = 25;
$count_admin  = 10;
$count_resume = 12;
$count_wap    = 3;
$wap_width    = 20;
$count_rss    = 10;
$count_atom   = 10;
$searchCount  = 20;

$SESSION_TIME = 3600;
$SYSTEM_NAME  = "SinLimite";
$ADMIN_NAME   = "Ariel Siles Encinas";
$ADMIN_LOGIN  = "admin";
$ADMIN_PASSWD = "admin";
$ADMIN_MAIL   = "arielrse@gmail.com";
$LIB          = "/home/sienteco/public_html/lib";
$URL_LIB      = "http://www.sientecochabamba.com/lib";
$PATH         = "/home/sienteco/public_html/blecasse.com/spanish";
$CACHE        = "/home/sienteco/cache";
$ROOT          = "http://www.blecasse.com";
$URL          = "http://www.blecasse.com/spanish";
$THEME        = "default";
$URL2       = "$URL/system/presentation/templates/$THEME";
$DEFAULT_LANGUAGE = "es";
$DEFAULT_COUNTRY  = "BOL";
$LANGUAGE_PATH = "$PATH/system/businessRules/i18n/languages";
$LANGUAGE_URL  = "$URL/system/businessRules/i18n/languages";
$MAIL_NUMBER = 5;
$KEY_GOOGLE   = "ABQIAAAAZYk_-rVkJS9rZj2dXsrNZBR8zTzK_OFHLyhMYj7c-rqVm2xvzhR6-TcTIBiD83OPGaG1ZASbonVatA";
*/
?>