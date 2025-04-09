<?php
/*
        -> DATOS METEREOLOGICOS OBTENIDOS DESDE: https://openweathermap.org/
            MAYOR INFORMACION, VISITAR DOCUMENTACION OFICIAL.
    */
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Guayaquil');
$ApiKey = "1d2ca94906d53729ae1ecccb77ef2e67";
$IDCiudad = "3583361";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $IDCiudad . "&lang=en&units=metric&APPID=" . $ApiKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
