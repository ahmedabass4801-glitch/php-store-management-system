<?php
session_start();
if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = [

        "Electronics" => [
            "TV"      => ["price" => 1300, "Quantity" => 13],
            "Fridge"  => ["price" => 30000, "Quantity" => 4],
            "Oven"    => ["price" => 25000, "Quantity" => 6],
        ],

        "Food" => [
            "Rice"  => ["price" => 35, "Quantity" => 120],
            "Milk"  => ["price" => 30, "Quantity" => 80],
            "Bread" => ["price" => 5, "Quantity" => 200],
        ],

        "Decoration" => [
            "Lamp"       => ["price" => 450, "Quantity" => 20],
            "Wall Clock" => ["price" => 300, "Quantity" => 15],
            "Vase"       => ["price" => 250, "Quantity" => 25],
        ],

        "Clothes" => [
            "T-Shirt" => ["price" => 250, "Quantity" => 40],
            "Jeans"   => ["price" => 600, "Quantity" => 25],
            "Jacket"  => ["price" => 1200, "Quantity" => 10],
        ],

        "Kids Toys" => [
            "Teddy" => ["price" => 180, "Quantity" => 30],
            "Lego"  => ["price" => 850, "Quantity" => 15],
            "Car"   => ["price" => 120, "Quantity" => 50],
        ],

    ];
}

include("admin-page.php");
?>