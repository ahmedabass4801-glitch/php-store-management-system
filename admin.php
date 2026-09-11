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
            "Teddy" => ["price" => 180, "Quantity" => 0],
            "Lego"  => ["price" => 850, "Quantity" => 15],
            "Car"   => ["price" => 120, "Quantity" => 50],
        ],

    ];
}

if (!isset($_SESSION['current_admin'])){
    header("Location: index.php");
    exit();
}

function warning_counter(){
    $count = 0;
    foreach ($_SESSION['categories'] as $category){
        foreach ($category as $product){
            if ($product['Quantity'] <= 5){
                $count++;
            }
        }
    }
    return $count;
}

function wish_counter(){
    $count = 0;
    foreach ($_SESSION['wish'] as $user => $category){
        $count += count($category);
    }
    return $count;
}
/*
$_SESSION['sales'] = [
    user_1 [
        category = [
            "item_1" = [
                "Quantity" => x,
                "Total_Price" => y
            ],
            "item_2" = [
                "Quantity" => x,
                "Total_Price" => y
            ]
        ]
    ]
]
*/
function total_earn(){
    $money = 0;
    foreach ($_SESSION['sales'] as $user => $categories){
        foreach ($categories as $category => $items){
            foreach ($items as $item){
                $money += $item['Total_Price'];
            }
        }
    }
    return $money;
}

include("admin-page.php");
?>