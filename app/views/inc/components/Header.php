<?php

use app\helpers\Flash;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description"
          content="<?php echo SITE_NAME ?> is a Purchase and Sales Management System for Agri and Crop Products">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/public/css/styles.css">
    <title><?php echo $this->title ?? SITE_NAME ?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo URL_ROOT ?>/public/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo URL_ROOT ?>/public/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL_ROOT ?>/public/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo URL_ROOT ?>/public/favicons/site.webmanifest">

    <script>
        const URL_ROOT = '<?php echo URL_ROOT ?>';
        const SITE_NAME = '<?php echo SITE_NAME ?>';
        let message = '<?php echo Flash::getMessage() ?>'
        if (message === '') {
            message = null;
        } else {
            message = JSON.parse(message);
        }

        function spinnerHtml() {
            return `
            <div class="justify-content-center align-items-center d-flex min-h-100 p-4">
                <svg width="48" height="48" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <style>.spinner_7mtw{transform-origin:center;animation:spinner_jgYN .6s linear infinite}@keyframes spinner_jgYN{100%{transform:rotate(360deg)}}</style>
                    <path class="spinner_7mtw" d="M2,12A11.2,11.2,0,0,1,13,1.05C12.67,1,12.34,1,12,1a11,11,0,0,0,0,22c.34,0,.67,0,1-.05C6,23,2,17.74,2,12Z"/>
                </svg>
            </div>
            `;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--    <script src="sweetalert2.all.min.js"></script>-->
    <script src="<?php echo URL_ROOT ?>/public/js/scripts.js" defer></script>
</head>
