<?php
session_start();

if(isset($_GET['code']) && isset($_GET['state'])){
    // Verify the state parameter
    $state = $_GET['state'];
    if ($state != 'lasagna') {
        echo "Invalid state parameter";
        exit();
    }

    // Exchange the authorization code for an access token
    $client_id = '17d284d6c3594fafa8085ee0eafca4cf';
    $client_secret = '2R44KaER3EQNqSAGgZdPGuKzOGphz5fx';
    $redirect_uri = 'https://xyrez.de/callback.php';
    $code = $_GET['code'];

    $token_url = 'https://oauth.battle.net/authorize';
    $token_url .= '?grant_type=authorization_code';
    $token_url .= '&code='.urlencode($code);
    $token_url .= '&redirect_uri='.urlencode($redirect_uri);

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_USERPWD, $client_id.':'.$client_secret);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($result);
    $access_token = $token_data->access_token;

    // Store the access token in the session
    $_SESSION['access_token'] = $access_token;

    // Redirect to the main page
    header('location: index.php');
}
?>
