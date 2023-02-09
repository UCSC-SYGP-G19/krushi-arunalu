<?php

/**
 * @file
 * Defines routes and links related to all user roles
 */

// Names of controllers relevant to each user role without the Controller suffix
const PROTECTED_ROUTES = [
    "Common" => ["Login", "Register", "ForgotPassword", "ResetPassword", "Logout", "Marketplace", "ManageProfile"],
    "Producer" => ["AccountSetup","ProducerDashboard", "Cultivations", "Harvests", "Sales", "CultivationQuestions",
        "CropRequests", "Announcements", "Profile"],
    "Manufacturer" => ["ManufacturerDashboard", "Sales", "ManufacturerOrders", "Producers", "Stocks",
        "ProductCategories", "Products", "CropRequests", "Inquiries"],
    "Customer" => ["Marketplace", "ShoppingCart", "Orders", "Profile"],
];

const SIDEBAR_ROUTES = [
    "Producer" => [
        "Dashboard" => [
            "icon" => "dashboard",
            "link" => "producer-dashboard",
        ],
        "Cultivations" => [
            "icon" => "cultivations",
            "link" => "cultivations",
        ],
        "Harvests" => [
            "icon" => "stocks",
            "link" => "harvests",
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
            "link" => "manufacturer-dashboard",
        ],
        "Sales" => [
            "icon" => "sales",
            "link" => "sales",
        ],
        "Manufacturer Orders" => [
            "icon" => "manufacturer-orders",
            "link" => "manufacturer-orders",
        ],
        "Purchased Stocks" => [
            "icon" => "purchased-stocks",
            "link" => "purchased-stocks",
        ],
        "Product Categories" => [
            "icon" => "product-categories",
            "link" => "product-categories",
        ],
        "Products" => [
            "icon" => "products",
            "link" => "products",
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
            "icon" => "cultivation-questions",
            "link" => "cultivation-questions",
        ],
    ],

];
