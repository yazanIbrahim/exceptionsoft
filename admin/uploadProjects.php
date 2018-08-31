<?php
//credentials (get those from google developer console https://console.developers.google.com/)
$clientId = '1068406447391-05onnrrggb9d9furngqthm1i9dvjhnsu.apps.googleusercontent.com ';
$clientSecret = 'D2cFVJOu6TCkU0VB5tPvFEAU';
$redirectUri = '...';
require_once '../vendor/autoload.php'; // get from here https://github.com/google/google-api-php-client.git 
session_start();
$client = new Google_Client();
// Get your credentials from the console
$client->setApplicationName("Get Token");
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->setScopes(array('https://www.googleapis.com/auth/drive.file'));
$client->setAccessType("offline");
$client->setApprovalPrompt('force');
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
    $client->getAccessToken(["refreshToken"]);
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    return;
}
if (isset($_SESSION['token'])) {

    $client->setAccessToken($_SESSION['token']);
}
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['token']);
    $client->revokeToken();
}
?>

<!doctype html>
<html>
    <head><meta charset="utf-8"></head>
    <body>
        <header><h1>Token Generator</h1></header>
        <?php
        /*if ($client->getAccessToken()) {

            $_SESSION['token'] = $client->getAccessToken();
            echo ( $_SESSION['token']['access_token']);
            $token = json_encode($_SESSION['token']);
            $refresh_token =  $_SESSION['token']['refresh_token'];
            //  echo "Refresh Token = " . $token->refresh_token . '<br/>';

            $saveToken = file_put_contents("token.txt", $token); // Saving the refresh token in a text file. 
            if ($saveToken) {
                echo 'Token saved successfully!<br/><br/>';
            }
            echo "<a class='logout' href='?logout'>Logout</a>";
        } else {
            $authUrl = $client->createAuthUrl();
            print "<a class='login' href='$authUrl'>Connect Me!</a>";
        }*/
        include_once("includes/classes.php");
        $fullPath = "client_id.json";  // path to file you want to upload 
        $gdrive = new gdrive;
        $gdrive->fileRequest = $fullPath;
        $gdrive->initialize();
        ?>
    </body>
</html>
