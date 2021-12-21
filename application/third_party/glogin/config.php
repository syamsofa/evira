
<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId("272293735465-astq2is8me89nn89k0mu0gls4k25ebto.apps.googleusercontent.com");

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret("AtSOV1wL3_SN1KgFFWXAMFIi");

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/evira/gredirect');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
// session_start();

?>
