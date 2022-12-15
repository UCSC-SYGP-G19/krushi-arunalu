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
