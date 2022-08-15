<?php

namespace jonatanolsson\rocketscraper;

class Rocketscraper
{
    /** @var string  */
    private static string $baseUrl = 'https://api.rocketscrape.com/?apiKey=%s&url=%s';

    /**
     * @param string $url
     * @param array|null $settings - (api_key)
     * @return string|null
     */
    public static function scrape(string $url, ?array $settings)
    {
        if (is_array($settings)) {
            self::handleSettings($settings);
        }

        if (!defined('ROCKETSCRAPE_API_KEY')) {
            trigger_error('ROCKETSCRAPE_API_KEY is not defined');
            return null;
        }

        /**
         *
         */
        $url = self::buildUrl($url);

        /*
         *
         */
        $curl = self::curl($url);

        /**
         * Only return the output if the http status code was OK
         */
        if ($curl && $curl['information'] && ($curl['information']['http_code'] >= 200 && $curl['information']['http_code'] < 300)) {
            return $curl['output'];
        }

        /**
         * The http status code is not OK
         */
        return null;
    }

    /**
     * @param $settings
     * @return void
     */
    private static function handleSettings($settings): void
    {
        if (!is_array($settings)) {
            return;
        }

        if (isset($settings['api_key'])) {
            define('ROCKETSCRAPE_API_KEY', $settings['api_key']);
        }
    }

    /**
     * @param $url
     * @return string
     */
    public static function buildUrl($url): string
    {
        return sprintf(self::$baseUrl, ROCKETSCRAPE_API_KEY ?? 'unknown', $url);
    }

    /**
     * @param string $url
     * @return array
     */
    private static function curl(string $url): array
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        $information = curl_getinfo($ch);

        curl_close($ch);

        return compact('output', 'information');
    }

    /**
     * For some reason if you want to change the baseUrl
     * @param string $url
     * @return void
     */
    private static function setBaseUrl(string $url)
    {
        self::$baseUrl = $url;
    }
}
