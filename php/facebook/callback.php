<?php
/**
 * Created by PhpStorm.
 * User: dylan
 * Date: 11/6/2015
 * Time: 8:38 PM
 */
include ("connect.php");

session_start();
require_once 'facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';

$config = array(
    'app_id' => '1704809339752311',
    'app_secret' => '91b32c37590a6e659a30566f37380e2c',
  
);
$fb = new Facebook\Facebook([
'app_id' => '1704809339752311',
'app_secret' => '91b32c37590a6e659a30566f37380e2c',
'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
try
{
    $accessToken = $helper->getAccessToken();
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
}

catch(FacebookExceptionsFacebookResponseException $e)
{

    // When Graph returns an error

    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
}

catch(FacebookExceptionsFacebookSDKException $e)
{

    // When validation fails or other local issues

    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken))
{
    if ($helper->getError())
    {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    }
    else
    {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }

    exit;
}

// Logged in

echo '<h3>Access Token</h3>';
$user = $response->getGraphUser();

if ($user)//Login Suceess
{
  
    $userId = $user["id"];
    $userName = $user["name"];

// create session
    //header("Location: ../../earthquakeLocator.php");
    $_SESSION['fb_access_token'] = (string)$accessToken;
    $_SESSION['userId'] = $userId;
    $_SESSION['id'] = $userId;
    $_SESSION['username'] = $userName;
    $result = mysql_query("SELECT count(userId) FROM tbluser as numberOfUserWithId WHERE userId=$userId and userStatus=1 and userType='facebook';"); //check if user is block
    $countActiveUser = mysql_fetch_array($result);

    if ($countActiveUser[0] == 1)//user already in db and active
    {
        header("Location: ../../earthquakeLocator.php"); //redirect to main page //modify It
        die();
    }
    else
    { //user not in db/or block
        $result = mysql_query("SELECT count(userId) FROM tbluser as numberOfUserWithId WHERE userId='$userId';");
        $userNotRegister = mysql_fetch_array($result);

        if ($userNotRegister[0] == 0) //user not in db
        { // insert user not registered in db
            mysql_query("INSERT INTO `tbluser`(`userId`, `userType`,  `userFullName`) VALUES ('$userId','facebook','$userName')"); //put user detail in db
            header("Location: ../../earthquakeLocator.php"); //redirect to main page //modify it
            die();
        }

        else
        { //user had been block
            header("Location: http://localhost/mobileEarthquake/userBlock.html "); //redirect to bad page //Modify It
            die();
        }
    }


}

// var_dump($accessToken->getValue());
// The OAuth 2.0 client handler helps us manage access tokens

$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token

$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';

// var_dump($tokenMetadata);
// Validation (these will throw FacebookSDKException's when they fail)

$tokenMetadata->validateAppId($config['app_id']);

// If you know the user ID this access token belongs to, you can validate it here
// $tokenMetadata->validateUserId('123');

$tokenMetadata->validateExpiration();

if (!$accessToken->isLongLived())
{

    // Exchanges a short-lived access token for a long-lived one

    try
    {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    }

    catch(FacebookExceptionsFacebookSDKException $e)
    {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>";
        exit;
    }

    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
}


?>

