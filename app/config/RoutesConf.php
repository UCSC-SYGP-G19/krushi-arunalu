<?php

/**
 * @file
 * Defines routes and links related to all user roles
 */

// Names of controllers relevant to each user role without the Controller suffix
const PROTECTED_ROUTES = [
    "Common" => ["Login", "Register", "ForgotPassword", "ResetPassword", "Logout", "Marketplace", "ManageProfile",
        "ManufacturerStore"],
    "Producer" => ["AccountSetup","ProducerDashboard", "Cultivations", "Harvests", "Sales", "CultivationQuestions",
        "CropRequests", "Announcements", "Profile", "Manufacturers"],
    "Manufacturer" => ["ManufacturerDashboard", "Sales", "ManufacturerOrders", "Producers", "Stocks",
        "ProductCategories", "Products", "ManufacturerCropRequests", "Inquiries", "ManufacturerSales",
        "PurchasedStocks"],
    "Customer" => ["Marketplace", "ShoppingCart", "Orders", "Profile", "SendInquiry", "Checkout", "Manufacturers"],
    "Agri Officer" => ["Dashboard", "Announcements", "Producers", "land-details",
        "cultivation-details", "crop-prices", "crop-prices", "cultivation-questions"],
    "Admin" => ["Dashboard", "AllProducts", "Crops", "Manufacturers", "Producers", "Announcements", "UserManagement"]
];

//$html = "";
//
//const NAVBAR_LINKS = [
//    "Producer", "Agri Officer", "Customer" => [
//        "Profile" => [
//            "link" => "",
//            "svgPath1" => "M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512
//                        14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014
//                        3.3335 14.9493 3.3335 15.8333V17.5",
//            "svgPath2" => "M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238
//                        11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889
//                        9.16667 9.99984 9.16667Z"
//        ],
//        "Logout" => [
//            "link" => "logout",
//            "svgPath1" => "",
//            "svgPath2" => "",
//            "svgPath3" => "",
//            "option" => "logout"
//        ]
//    ],
//    "Manufacturer" => [
//        "Profile" => [
//            "link" => "manageProfile",
//            "svgPath1" => "M16.6668 17.5V15.8333C16.6668 14.9493 16.3156 14.1014 15.6905 13.4763C15.0654 12.8512
//                        14.2176 12.5 13.3335 12.5H6.66683C5.78277 12.5 4.93493 12.8512 4.30981 13.4763C3.68469 14.1014
//                        3.3335 14.9493 3.3335 15.8333V17.5",
//            "svgPath2" => "M9.99984 9.16667C11.8408 9.16667 13.3332 7.67428 13.3332 5.83333C13.3332 3.99238
//                        11.8408 2.5 9.99984 2.5C8.15889 2.5 6.6665 3.99238 6.6665 5.83333C6.6665 7.67428 8.15889
//                        9.16667 9.99984 9.16667Z"
//        ],
//        "My Store" => [
//            "link" => "",
//            "svg" => "",
//            "option" => "My Store"
//        ],
//        "Logout" => [
//            "link" => "logout",
//            "svgPathS" => ;echo $html,
//            "option" => "Logout"
//        ]
//    ]
//]);

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
