
<?php
$wcl_base_url = 'https://www.warcraftlogs.com:443/v1/reports/guild/how%20bizarre/Blackmoore/EU?api_key=4a17488a491b8980ee6c89d6c1ae8b94';
$wcl_base_json = file_get_contents($wcl_base_url);
$wcl_base_array = json_decode($wcl_base_json, true);
$id = $wcl_base_array[0]['id'];

$latest_fight = $wcl_base_array[0]['id'];;
$wcl_last_fight_url = 'https://www.warcraftlogs.com/v1/report/fights/'.$latest_fight.'?translate=true&api_key=4a17488a491b8980ee6c89d6c1ae8b94';
$wcl_fight_json = file_get_contents($wcl_last_fight_url);
$wcl_fight_array = json_decode($wcl_fight_json, true);

$last_fight_array = end($wcl_fight_array['fights']);
$last_fight_ID = $last_fight_array['id'];
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel=StyleSheet href="styles.css" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="https://xyrez.de">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class = "container-fluid machmitteamk">
            <h2 class=text-center>letzter log, letzter fight</h2>
        </div>
        <div class="container-fluid alert alert-primary text-center" style="max-width:100%"><?php
            echo "<a href =\"https://www.warcraftlogs.com/reports/$id#fight=$last_fight_ID\" target = _blank>letzter fight wcl</a><br>";
        ?></div>
        <div class="container-fluid alert alert-primary text-center" style="max-width:100%"><?php
            echo "<a href =\"https://www.wipefest.gg/report/$id/fight/$last_fight_ID\" target = _blank>letzter fight wipefest</a><br>";
        ?></div>
    </body>
            <footer>
    <div>© 2019-2020 Xyrez </div>
    </footer>
</html>
