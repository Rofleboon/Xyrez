<?php
$wcl_url = 'https://www.warcraftlogs.com:443/v1/reports/guild/Closed%20Society/Blackrock/EU?api_key=4a17488a491b8980ee6c89d6c1ae8b94';

$wcl_json = file_get_contents($wcl_url);
$wcl_array = json_decode($wcl_json, true);
$id = $wcl_array[0]['id'];


header("Location: https://www.warcraftlogs.com/reports/$id");

?>
