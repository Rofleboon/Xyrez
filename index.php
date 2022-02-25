<?php
session_start();
$wcl_base_url = 'https://www.warcraftlogs.com:443/v1/reports/guild/ist%20Gildenlos/MalGanis/EU?api_key=4a17488a491b8980ee6c89d6c1ae8b94';

$wcl_base_json = file_get_contents($wcl_base_url);
$wcl_base_array = json_decode($wcl_base_json, true);
$_SESSION["total"] = 0;
$amount = 9;

function showData($amount, $current, $wcl_base_array){        
        for ($x = 0; $x <= $amount; $x++) {
            $id = $wcl_base_array[$current]['id'];
            $title = $wcl_base_array[$current]['title'];
            $owner = $wcl_base_array[$current]['owner'];
            date_default_timezone_set('Europe/Berlin');
            $timestamp = $wcl_base_array[$current]['start'];
            $datetime = gmdate("d.m.y", $timestamp/1000);
            $dateday = date('N', $timestamp/1000);
            switch ($dateday) {
                case '0':
                    $weekday = 'Sonntag';
                    break;
                case '1':
                    $weekday = 'Montag';
                    break;
                case '2':
                    $weekday = 'Dienstag';
                    break;
                case '3':
                    $weekday = 'Mittwoch';
                    break;
                case '4':
                    $weekday = 'Donnerstag';
                    break;
                case '5':
                    $weekday = 'Freitag';
                    break;
                case '6':
                    $weekday = 'Samstag';                    
                    break;
            }
            
            $current++;            
            $_SESSION["total"]++;            
        ?>
        <div class="container-fluid entry ">
            <div class="d-inline p-2"><?php
                echo "<a href =\"https://www.warcraftlogs.com/reports/$id\" target = _blank>$weekday $datetime: $title</a>";
            ?></div> | 
            <div class="d-inline p-2"><?php
                echo "<a href =\"https://www.wipefest.gg//report/$id\" target = _blank>Wipefest</a>";
            ?></div>
            </div>

        <?php
        }
        
}
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:wght@400;700&display=swap" rel="stylesheet">
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <!-- obsolete for now
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        -->
        <link rel=StyleSheet href="styles.css" type="text/css">
    </head>
    
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://xyrez.de"><img src="img/logo.png"><span class="sr-only">(current)</span></a>
                    </li>
                   
                </ul>
                <ul class="navbar-nav justify-content-end">
                  <li class="nav-item">
                   <a class="nav-link" href="https://progstats.io/details/eu/malganis/620556-ist-gildenlos/all/28-sanctum-of-domination\" target="_blank">Progstats.io</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://xyrez.de" target="_blank">Raider.io</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="http://xyrez.de" target="_blank">Warcraftlogs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://xyrez.de" target="_blank">wowprogress</a>
                  </li>
                </ul>
            </div>
        </nav> 
    <div class="wrapper center">
        <div class = "container-fluid center">
            <h2>Die letzten -ist gildenlos- Logs!</h2>
        </div> 
        
        <?php            
        showData($amount, $_SESSION["total"], $wcl_base_array);      
        
        
            
        if(array_key_exists('load1', $_POST)) {               
        showData($amount, $_SESSION["total"], $wcl_base_array);
        }
        
        

      
        ?>
        
        <form method="post">
        <input type="submit" name="load1"
                class="button"value="load more..."/>
        </form>
        
        </div>
        <?php
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        ?>
    </body>
</html>
