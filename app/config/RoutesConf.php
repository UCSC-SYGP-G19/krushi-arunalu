<?php

/**
 * @file
 * Defines routes and links related to all user roles
 */

const ROUTES = [
    "Producer" => [
        "Dashboard" => [
            "icon" => "dashboard",
            "link" => "index",
        ],
        "Cultivations" => [
            "icon" => "cultivations",
            "link" => "cultivations",
        ],
        "Sales" => [
            "icon" => "sales",
            "link" => "sales",
        ],
        "Manufacturers" => [
            "icon" => "manufacturers",
            "link" => "manufacturers",
        ],
        "Cultivation Questions" => [
            "icon" => "cultivation-questions",
            "link" => "cultivation-questions",
        ],
        "Crop Requests" => [
            "icon" => "crop-requests",
            "link" => "crop-requests",
        ],
        "Announcements" => [
            "icon" => "announcements",
            "link" => "announcements",
        ],
    ],

    "Manufacturer" => [
        "Dashboard" => [
            "icon" => "dashboard",
            "link" => "index",
        ],
        "Sales" => [
            "icon" => "sales",
            "link" => "sales",
        ],
        "Purchases" => [
            "icon" => "purchases",
            "link" => "purchases",
        ],
        "Manufacturers" => [
            "icon" => "manufacturers",
            "link" => "manufacturers",
        ],
        "Purchased Stocks" => [
            "icon" => "stocks",
            "link" => "stocks",
        ],
        "Product Categories" => [
            "icon" => "categories",
            "link" => "product-category",
        ],
        "Products" => [
            "icon" => "product",
            "link" => "product",
        ],
        "Producers" => [
            "icon" => "producers",
            "link" => "producers",
        ],
        "Crop Requests" => [
            "icon" => "crop-requests-manufacturer",
            "link" => "crop-requests-manufacturer",
        ],
        "Inquiries" => [
            "icon" => "inquiries",
            "link" => "inquiries",

        ],
    ],

    "Customer" => [
        "Marketplace" => [
            "icon" => "dashboard",
            "link" => "marketplace",
        ],
        "All Manufacturers" => [
            "icon" => "manufacturers",
            "link" => "manufacturers",
        ],
        "My Orders" => [
            "icon" => "my-orders",
            "link" => "my-orders",
        ],
    ],

    "Agri Officer" => [
        "Dashboard" => [
            "icon" => "dashboard",
            "link" => "index",
        ],
        "Announcements" => [
            "icon" => "announcements",
            "link" => "announcements",
        ],
        "Producer Details" => [
            "icon" => "producer-details",
            "link" => "producer-details",
        ],
        "Land Details" => [
            "icon" => "land-details",
            "link" => "land-details",
        ],
        "Cultivation Details" => [
            "icon" => "cultivation-details",
            "link" => "cultivation-details",
        ],
        "Crop Prices" => [
            "icon" => "crop-prices",
            "link" => "crop-prices",
        ],
        "Cultivation Questions" => [
            "icon" => "cultivation-question",
            "link" => "cultivation-question",
        ],
    ],

];
