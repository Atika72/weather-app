<?php
error_reporting(0);
    $weatherData = '';
    $error='';
    if(empty($_GET["city"])){
        $error= "No City Name";
    }else{
        $city = $_GET["city"];
        $api_key="8e3dd6efd60bf5cfe050f7fbd55a8e46";
        $weatherApi = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key";
        $api = file_get_contents($weatherApi);
        $weatherArray = json_decode($api, true);
        $weatherData = $weatherArray['weather'][0]['main'];
        $KelvinMinTemp = $weatherArray['main']['temp_min'];
        function kelvinToCelsius(float $kelvin): float{
            return $kelvin - 273.15;
        }
        $kelvin = $KelvinMinTemp;
        $minTemp = kelvinToCelsius($kelvin);
        $KelvinMaxTemp = $weatherArray['main']['temp_max'];
        $kelvin = $KelvinMaxTemp;
        $maxTemp = kelvinToCelsius($kelvin);
        $feels_like = $weatherArray['main']['feels_like'];
        $kelvin = $feels_like;
        $real_feel = kelvinToCelsius($kelvin);
        $temp = $weatherArray['main']['temp'];
        $kelvin = $temp;
        $main_temp = kelvinToCelsius($kelvin);
        $humidity = $weatherArray['main']['humidity'];
        $wind_speed = $weatherArray['wind']['speed'];
        $cityName = $weatherArray['name'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
    <div class="flex flex-row">
        <div class="w-1/2 h-screen bg-no-repeat bg-cover bg-left bg-slate-700 flex justify-center items-center flex-col gap-y-24"
            style="background-image: url('https://images.unsplash.com/photo-1590552515252-3a5a1bce7bed?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80');">
            <h1 class="text-white text-center text-7xl underline  decoration-gray-300">Search Your City Now
            </h1>
            <div class="">
                <form>
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative w-[500px]">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" name="city"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50"
                            placeholder="Search City" required>
                        <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-[#52b788] hover:bg-slate-950 focus:ring-4 focus:outline-none font-semibold rounded-sm text-sm px-4 py-2">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- second flex -->
        <div class="bg-white w-1/2 h-screen px-10">
            <h1 class="text-4xl text-black font-semibold pt-16 text-center">Today's Weather</h1>

            <section class="pt-20">
                <div
                    class="p-4 flex items-center justify-center gap-32 shadow-lg shad shadow-neutral-300-200 rounded-lg bg-white h-80 mb-auto">
                    <div class="my-auto">
                        <p class="font-bold text-5xl mb-2 text-[#52b788]"><?php echo $main_temp; ?>&deg;C</p>
                        <p class="text-4xl text-gray-800 tracking-wide">
                            <?php 
                                if($weatherData){
                                    echo $weatherData;
                                }else{
                                    echo $error;
                                }
                            ?>
                            <img src="./weather-svgrepo-com.svg" class="w-16 inline" />
                        </p>
                        <h1 class="font-bold text-6xl mb-2 text-[#52b788] uppercase">
                            <?php 
                                if($cityName){
                                    echo $cityName;
                                }else{
                                    echo $error;
                                }
                            ?>
                        </h1>
                        <p class="tracking-wider">
                            <?php echo date("Y-m-d") ?>
                        </p>
                    </div>
                    <div class="my-2 border-l-2 border-neutral-200 p-2 mb-14 pl-10">
                        <p class="text-gray-400 text-lg mb-2">Real Feel: <?php 
                            echo $real_feel;
                        ?>&deg;C</p>
                        <p class="text-gray-400 text-lg mb-2">Humidity: <?php echo $humidity ?>%</p>
                        <p class="text-gray-400 text-lg mb-2">Wind Speed: <?php echo $wind_speed ?>km/h</p>
                        <p class="text-gray-400 text-lg mb-2">Min Temp: <?php echo $minTemp; ?>&deg;C</p>
                        <p class="text-gray-400 text-lg">Max Temp: <?php echo $maxTemp; ?>&deg;C</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>