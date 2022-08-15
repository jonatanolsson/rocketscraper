<?php

include_once "src/Rocketscraper.php";

$url = jonatanolsson\rocketscraper\Rocketscraper::scrape('https://httpbin.org/ip', [
    'api_key' => '<your fab rocketscrape api-key here>'
]);


