<?php

require('class.pdf2text.php');

// Load the composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';

// Load environment variables using the Dotenv library
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();

// Load the configuration files
require_once dirname(__DIR__) . '/app/config/AppConf.php';
require_once dirname(__DIR__) . '/app/config/DatabaseConf.php';

// Turn off error reporting
ini_set('display_errors', '0');
ini_set('log_errors', '0');

$baseUrl = "http://harti.gov.lk/images/download/market_information/";

$year = 2023;
$month = "may";
$date = "08-05-2022";
$url = $baseUrl . "$year/daily/$month/daily_$date.pdf";

$filename = dirname(__FILE__, 2) . "/public/pdf/daily_$date.pdf";

// Download file at given url
$ch = curl_init($url);

if ($ch === false) {
    die('File not found or failed to create curl object');
}

//$fp = fopen($filename, 'wb');
//curl_setopt($ch, CURLOPT_FILE, $fp);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_exec($ch);
//curl_close($ch);
//fclose($fp);


$a = new PDF2Text();
//$a->multibyte = false;
//$a->setUnicode(true);
$a->setFilename($filename);
$a->decodePDF();
$output = (string)$a->output();
//echo $output;

sleep(1);

$string = substr($output, 0, 7000);
$string = str_replace("\n", " ", $string);

echo "<br><br>";
$singleMarketCrops = [
    1 => "Karathakolomban",
    2 => "Kolikuttu",
    3 => "Pineapple - Large",
    4 => "Passion Fruits"
];
$multiMarketCrops = [
    5 => "Lime",
    6 => "Sweet Potatoe",
    7 => "Green Chillies",
    8 => "Manioc",
    9 => "Potato \(Nuwaraeliya\)",
    10 => "Tomato"
];

$mkts = [
    1 => "Peliyagoda Market",
    2 => "Kandy Market",
    3 => "Dambulla Market",
    4 => "Norochchole Market",
    5 => "Thambuththegama Market",
    6 => "Keppetipola Market",
    7 => "Nuwaraeliya Market"
];

foreach ($singleMarketCrops as $cropId => $crop) {
    $regex = '/(' . $crop . '\S*) (\d+ - \d+)/';
    preg_match($regex, $string, $matches);
    // access the group 2
    $price = $matches[2];
    echo $crop . " : " . $price;
    echo "<br>";
};

echo "<br><hr><br>";

foreach ($multiMarketCrops as $cropId => $crop) {
    echo $crop . "<br>";
    $regex1 = '/(' . $crop . ') ((\d+ - \d+\W*)+)/';
    preg_match_all($regex1, $string, $matches);

    $priceSet = $matches[2];

    $regex2 = '/\d+ - \d+|\s-/';
    preg_match_all($regex2, $priceSet[0], $matches2);

    $mktIndex = 1;

    foreach ($matches2[0] as $price) {
        if (strlen($price) != 2) {
            // add to db
            echo "$mkts[$mktIndex] : " . $price;
            echo "<br>";
        }
        $mktIndex++;

        if ($mktIndex == 7) {
            break;
        }
    }

    echo "<hr>";
}
