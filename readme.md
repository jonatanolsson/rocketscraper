# Rocketscrape library for php

Just a simple curl lib

## How to use

```
$reponse = jonatanolsson\rocketscrape\Rocketscraper::scrape('<your url here>', [
'api_key' => '<your fab rocketscrape api-key here>'
]);
```

or

```
define('ROCKETSCRAPE_API_KEY', '<your fab rocketscrape api-key here>');

$reponse = jonatanolsson\rocketscrape\Rocketscraper::scrape('<your url here>');
```

