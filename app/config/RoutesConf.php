<?php

/**
 * @file
 * Defines routes and links related to all user roles
 */

// Names of controllers relevant to each user role without the Controller suffix
const PROTECTED_ROUTES = [
    "Common" => ["Login", "Register", "ForgotPassword", "ResetPassword", "Logout", "Marketplace", "ManageProfile",
        "ManufacturerStore"],
    "Producer" => ["AccountSetup", "ProducerDashboard", "Cultivations", "Harvests", "Sales", "CultivationQuestions",
        "ProducerCropRequests", "Announcements", "Profile", "Manufacturers", "ConnectionRequests"],
    "Manufacturer" => ["ManufacturerDashboard", "Sales", "ManufacturerOrders", "Producers", "Stocks",
        "ProductCategories", "Products", "ManufacturerCropRequests", "Inquiries", "ManufacturerSales",
        "PurchasedStocks", "ConnectionRequests"],
    "Customer" => ["Marketplace", "ShoppingCart", "Orders", "Profile", "SendInquiry", "Checkout", "Manufacturers"],
    "Agri Officer" => ["Dashboard", "Announcements", "Producers", "LandDetails",
        "CultivationDetails", "SetCropPrices", "CropPrices", "CultivationQuestions"],
    "Admin" => ["Dashboard", "AllProducts", "Crops", "Manufacturers", "Producers", "Announcements", "UserManagement"]
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
            "icon" => "purchased-stocks",
            "link" => "harvests",
        ],
        "Sales" => [
            "icon" => "manufacturer-sales",
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
            "link" => "producer-crop-requests",
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
            "icon" => "manufacturer-sales",
            "link" => "manufacturer-sales",
        ],
        "Purchases" => [
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
            "icon" => "manufacturer-crop-requests",
            "link" => "manufacturer-crop-requests",
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
            "icon" => "orders",
            "link" => "orders",
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
            "link" => "producers",
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
    "Admin" => [
        "Dashboard" => [
            "icon" => "dashboard",
            "link" => "Dashboard",
        ],
        "All Products" => [
            "icon" => "all-products",
            "link" => "all-products",
        ],
        "Crops" => [
            "icon" => "crops",
            "link" => "crops",
        ],
        "manufacturers" => [
            "icon" => "crops",
            "link" => "crops",
        ],
        "producers" => [
            "icon" => "producers",
            "link" => "producers",
        ],
        "announcements" => [
            "icon" => "announcements",
            "link" => "announcements",
        ],
        "User Management" => [
            "icon" => "user-management",
            "link" => "user-management",
        ],
    ],];
