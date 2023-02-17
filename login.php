<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <button type="submit" name="login">Login with Battle.net</button>
    </form>
</body>
</html>

<?php
session_start();

if(isset($_POST['login'])){
    // Redirect the user to the Battle.net login page
    $client_id = 'your_client_id';
    $redirect_uri = 'https://example.com/callback.php';
    $scope = 'wow.profile';
    $state = 'some_random_string';

    $login_url = 'https://us.battle.net/oauth/authorize';
    $login_url .= '?response_type=code';
    $login_url .= '&client_id='.urlencode($client_id);
    $login_url .= '&redirect_uri='.urlencode($redirect_uri);
    $login_url .= '&scope='.urlencode($scope);
    $login_url .= '&state='.urlencode($state);

    header('location: '.$login_url);
}
?>