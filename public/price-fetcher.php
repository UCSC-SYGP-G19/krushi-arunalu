<?php

use app\models\CropPrice;

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

$mkts = [
    1 => "Peliyagoda Market",
    2 => "Kandy Market",
    3 => "Dambulla Market",
    4 => "Meegoda Market",
    5 => "Norochchole Market",
    6 => "Thambuththegama Market",
    7 => "Keppetipola Market",
    8 => "Nuwaraeliya Market",
    9 => "Bandarawela Market",
    10 => "Veyangoda Market",
];

function downloadFile($url, $filename): bool
{
    if (file_exists($filename)) {
        return true;
    }
    $fp = fopen($filename, 'w+');
    $ch = curl_init($url);

    if ($ch === false) {
        echo('File not found or failed to create curl object');
        return false;
    }

    curl_setopt($ch, CURLOPT_TIMEOUT, 50);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);

    return true;
}

function convertPdfToText($filename): ?string
{
    $a = new PDF2Text();
    //$a->multibyte = false;
    //$a->setUnicode(true);
    $a->setFilename($filename);
    $a->decodePDF();
    $output = (string)$a->output();

    if (strlen($output) < 5000) {
        return null;
    }

    $string = substr($output, 0, 7000);
    return str_replace("\n", " ", $string);
    //echo $output;
}

function extractSingleMarketPrices($text): array
{
    $singleMarketCrops = [
        9 => "Karathakolomban",
        12 => "Kolikuttu",
        11 => "Pineapple - Large",
        19 => "Passion Fruits"
    ];
    $output = [];
    foreach ($singleMarketCrops as $cropId => $crop) {
        $regex1 = '/(' . $crop . '\S*) (\d+ - \d+)/';
        preg_match($regex1, $text, $matches);
        $price = $matches[2];

        $regex2 = '/\d+/';
        preg_match_all($regex2, $price, $matches2);
        $lowPrice = $matches2[0][0];
        $highPrice = $matches2[0][1];

        $output[] = [
            "cropId" => $cropId,
            "lowPrice" => $lowPrice,
            "highPrice" => $highPrice
        ];
//        echo $crop . " : " . $price;
//        echo "<br>";
    };
    return $output;
}

function extractMultiMarketPrices($text): array
{
    $multiMarketCrops = [
        10 => "Lime",
        6 => "Sweet Potatoe",
        18 => "Green Chillies",
        7 => "Manioc",
        5 => "Potato \(Nuwaraeliya\)",
        8 => "Tomato"
    ];
    $output = [];
//    $output2 = [];
//    $marketOutput = [];
    foreach ($multiMarketCrops as $cropId => $crop) {
        $cropOutput = [];
        $regex1 = '/(' . $crop . ') ((\d+ - \d+\W*)+)/';
        preg_match_all($regex1, $text, $matches);

        $priceSet = $matches[2];

        $regex2 = '/\d+ - \d+|\s-/';
        preg_match_all($regex2, $priceSet[0], $matches2);

        $mktIndex = 1;

        foreach ($matches2[0] as $price) {
            if (strlen($price) != 2) {
                $regex3 = '/\d+/';
                preg_match_all($regex3, $price, $matches3);
                $lowPrice = $matches3[0][0];
                $highPrice = $matches3[0][1];

                $cropOutput[] =
                    [
                        "marketId" => $mktIndex,
                        "lowPrice" => $lowPrice,
                        "highPrice" => $highPrice
                    ];

//                $marketOutput[$mktIndex][] = [
//                    "cropId" => $cropId,
//                    "lowPrice" => $lowPrice,
//                    "highPrice" => $highPrice
//                ];

//                print_r($marketOutput[$mktIndex]);
                // echo "$mkts[$mktIndex] : " . $price;
                // echo "<br>";
            }
            $mktIndex++;

            if ($mktIndex > 10) {
                break;
            }

//            print_r($marketOutput);
        }

//        cropOutput = [
//            [
//                "marketId" => 1,
//                "highPrice" => 100,
//                "lowPrice" => 50
//            ],
//            [
//                "marketId" => 2,
//                "highPrice" => 100,
//                "lowPrice" => 50
//            ]
//        ]

        $output[] = [
            "cropId" => $cropId,
            "data" => $cropOutput
        ];

//        $output2[] = [
//            "marketId" => $mktIndex,
//            "data" => $marketOutput
//        ];
    }

//    output = [
//        [
//            "cropId" => 1,
//            "data" => [
//                [
//                    "marketId" => 1,
//                    "highPrice" => 100,
//                    "lowPrice" => 50
//                ],
//                [
//                    "marketId" => 2,
//                    "highPrice" => 100,
//                    "lowPrice" => 50
//                ]
//            ],
//        ],
//    ]

//    print_r($output);
    return $output;
}

function bulkInsertSingleMarketPriceToDB($marketId, $date, $data): void
{
    // send a curl post request to CropPriceController@bulkInsertSingleMarketPrice

//    $url = "http://localhost:8000/crop-price/bulk-insert-single-market-price";
//    $data = [
//        'date' => $date,
//        'marketId' => $marketId,
//        'data' => $data
//    ];
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//
//    $response = curl_exec($ch);
//    curl_close($ch);

//    $data = [
//        [
//            "cropId" => 1,
//            "lowPrice" => 100,
//            "highPrice" => 200
//        ],
//        [
//            "cropId" => 1,
//            "lowPrice" => 100,
//            "highPrice" => 200
//        ]
//    ];

    $cropPriceModel = new CropPrice();
    $cropPriceModel->batchInsertSingleMarketPricesToDb($marketId, $date, $data);
}

function bulkInsertMultipleMarketPriceToDB($date, $data): void
{
    // send a curl post request to CropPriceController@bulkInsertSingleMarketPrice

//    $url = "http://localhost:8000/crop-price/bulk-insert-single-market-price";
//    $data = [
//        'date' => $date,
//        'marketId' => $marketId,
//        'data' => $data
//    ];
//    $ch = curl_init($url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//
//    $response = curl_exec($ch);
//    curl_close($ch);

//    $data = [
//        [
//            "cropId" => 1,
//            "lowPrice" => 100,
//            "highPrice" => 200
//        ],
//        [
//            "cropId" => 1,
//            "lowPrice" => 100,
//            "highPrice" => 200
//        ]
//    ];

//    print_r($data);

    $cropPriceModel = new CropPrice();
    $cropPriceModel->batchInsertMultiMarketPricesToDb($date, $data);
}

function generateDates($start, $end): array
{
    $dates = [];

    $interval = new DateInterval('P1D');
    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach ($period as $date) {
        // if date is saturday, skip
        if ($date->format('w') == 6) {
            continue;
        }

        // if date is sunday, skip
        if ($date->format('w') == 0) {
            continue;
        }

        $dates[] = $date->format('d-m-Y');
    }

    return $dates;
}

// Enter required start and end date here (returns in dd-mm-yyyy format)
// (the filename is set as 2022 for 2023 files in HARTI)
$dates = generateDates("2023-05-12", date("Y-m-d"));

foreach ($dates as $date) {
    $year = date("Y", strtotime($date));
    $month = date("F", strtotime($date));
    $month = strtolower($month);

    if ($year == "2023") {
        $modifiedDate = str_replace("2023", "2022", $date);
    } else {
        $modifiedDate = $date;
    }

    $url = $baseUrl . "$year/daily/$month/daily_$modifiedDate.pdf";
    $filename = dirname(__FILE__, 2) . "/public/pdf/daily_$date.pdf";
//    echo "Downloading: " . $url . "<br>";

    if (!downloadFile($url, $filename)) {
        continue;
    }
    sleep(1);

    $text = convertPdfToText($filename);
    if ($text == null) {
        continue;
    }
    sleep(0.25);

    ini_set('display_errors', '0');
    ini_set('log_errors', '0');

    $singleMarketPrices = extractSingleMarketPrices($text);
    bulkInsertSingleMarketPriceToDB(1, date("Y-m-d", strtotime($date)), $singleMarketPrices);
    sleep(0.25);

    $multiMarketPrices = extractMultiMarketPrices($text);
    bulkInsertMultipleMarketPriceToDB(date("Y-m-d", strtotime($date)), $multiMarketPrices);
    sleep(0.25);
}

echo "Done :)";
