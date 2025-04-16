<?php
header('Content-Type: application/json');

// Optional: turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Your data
$data = [
    ['first_name' => 'Sarah', 'city' => 'Nairobi', 'country' => 'Kenya', 'date_joined' => 'March 25, 2025'],
    ['first_name' => 'Tunde', 'city' => 'Lagos', 'country' => 'Nigeria', 'date_joined' => 'March 26, 2025'],
    ['first_name' => 'Amina', 'city' => 'Casablanca', 'country' => 'Morocco', 'date_joined' => 'March 27, 2025'],
    ['first_name' => 'Jean', 'city' => 'Abidjan', 'country' => "Côte d'Ivoire", 'date_joined' => 'March 27, 2025'],
    ['first_name' => 'Leila', 'city' => 'Cairo', 'country' => 'Egypt', 'date_joined' => 'March 28, 2025'],
    ['first_name' => 'Ali', 'city' => 'Tunis', 'country' => 'Tunisia', 'date_joined' => 'March 29, 2025'],
    ['first_name' => 'Musa', 'city' => 'Kano', 'country' => 'Nigeria', 'date_joined' => 'March 30, 2025'],
];

echo json_encode($data);
