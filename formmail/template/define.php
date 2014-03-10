<?
define( "ADMIN_MAIL", "s6software@users.sourceforge.net" ); // bug report email

define( "HOST_NAME", getEnv( "HTTP_HOST" ) );
define( "PHP_SELF", getEnv( "SCRIPT_NAME" ) );

define( "ERR_MISSING", "Missing required field : " );
define( "ERR_EMAIL", "Please type in a valid e-mail address : " );
define( "ERR_CREDIT_CARD_NUMBER", "Please check the credit card number : " );
define( "ERR_CREDIT_CARD_EXPIRED", "Please check the credit card expiry date : " );
define( "ERR_SELECT_UPLOAD", "Please select upload file : " );

error_reporting( E_ERROR | E_WARNING | E_PARSE );
?>