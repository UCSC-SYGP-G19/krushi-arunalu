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
        if(message === ''){
          message = null;
        } else {
          message = JSON.parse(message);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--    <script src="sweetalert2.all.min.js"></script>-->
    <script src="<?php echo URL_ROOT ?>/public/js/scripts.js" defer></script>
</head>
