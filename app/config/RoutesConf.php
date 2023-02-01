<?php

/**
 * @file
 * Defines routes and links related to all user roles
 */

// Names of controllers relevant to each user role without the Controller suffix
const PROTECTED_ROUTES = [
    "Common" => ["Login", "Register", "ForgotPassword", "ResetPassword", "Logout", "Marketplace", "ManageProfile"],
    "Producer" => ["AccountSetup","ProducerDashboard", "Cultivations", "Harvests", "Sales", "Manufacturers", "CultivationQuestions",
        "CropRequests", "Announcements", "Profile"],
    "Manufacturer" => ["ManufacturerDashboard", "Sales", "Purchases", "Manufacturers", "Stocks", "ProductCategories",
        "Products"],
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
];
