<?php
if(array_key_exists('submit',$_GET)){
    if($_GET('city')){
        $weatherApi = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city']).",uk&appid=8e3dd6efd60bf5cfe050f7fbd55a8e46
        ");
        $weatherArray = json_decode($weatherApi, true);
        $weatherData = $weatherArray['weather'][0]['description'];
    }
}