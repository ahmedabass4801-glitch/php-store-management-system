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

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = "products list";
}

if (!isset($_SESSION['expanded'])) {
    $_SESSION['expanded'] = false;
}

function print_stuff($array) {
    foreach ($_SESSION['categories'] as $categories => $category) {
    echo "<h3>" . $categories . "</h3>";
    echo "<ul>";

    foreach ($category as $categoryName => $items) {
        echo "<li><strong>" . $categoryName . "</strong>";

        if ($items['Quantity'] <= 5) {
            echo str_repeat("&nbsp;", 5);
            echo "<span style='color: red; font-weight: bold;'>Warning</span>";
        }

        echo "<ul>";

        foreach ($items as $key => $thing) {
            echo "<li>" . $key . ": $thing" . "</li>";
        }

        echo "</ul>";
        echo "</li>";
    }

    echo "</ul>";
    }
}

function set_error($text){
    global $message;
    $message = "<span style='color: red; font-weight: bold;'>" . $text . "<br>Try Again";
}

function find_item_category($itemName){
    foreach ($_SESSION['categories'] as $categoryName => $items){
        if (isset($items[$itemName])){
            return $categoryName;
        }
    }
    return false;
}

function handle_products_list(){
    if (isset($_POST['button'])){
        if ($_POST['button'] == "back"){
            if ($_SESSION['expanded']){
                $_SESSION['expanded'] = false;
            } else {
                unset($_SESSION['step']);
                unset($_SESSION['expanded']);
                header("Location: admin.php");
                exit();
            }
        } elseif ($_POST['button'] == "edit"){
            $_SESSION['expanded'] = true;
        } elseif ($_POST['button'] == "update"){
            $_SESSION['step'] = "update quantity";
        } elseif ($_POST['button'] == "add"){
            $_SESSION['step'] = "add product";
        } elseif ($_POST['button'] == "edit_price"){
            $_SESSION['step'] = "edit price";
        } elseif ($_POST['button'] == "delete"){
            $_SESSION['step'] = "delete product";
        }
    }
}

function handle_update_quantity(){
    if (!isset($_POST['button'])) return;

    if ($_POST['button'] == "back"){
        $_SESSION['step'] = "products list";
        return;
    }

    if ($_POST['button'] != "submit") return;

    if (!isset($_POST['item_name']) || trim($_POST['item_name']) == "" ||
        !isset($_POST['new_quantity']) || $_POST['new_quantity'] === ""){
        set_error("You DID NOT enter full data");
        return;
    }

    $itemName = $_POST['item_name'];
    $newQuantity = (int)$_POST['new_quantity'];

    $category = find_item_category($itemName);

    if ($category === false){
        set_error("This product does not exist");
        return;
    }

    if ($newQuantity < 0){
        set_error("Quantity can not be less than or equal zero");
        return;
    }

    $_SESSION['categories'][$category][$itemName]['Quantity'] = $newQuantity;
    $_SESSION['step'] = "products list";
}

function handle_edit_price(){
    if (!isset($_POST['button'])) return;

    if ($_POST['button'] == "back"){
        $_SESSION['step'] = "products list";
        return;
    }

    if ($_POST['button'] != "submit") return;

    if (!isset($_POST['item_name']) || trim($_POST['item_name']) == "" ||
        !isset($_POST['new_price']) || $_POST['new_price'] === ""){
        set_error("You DID NOT enter full data");
        return;
    }

    $itemName = $_POST['item_name'];
    $newPrice = (int)$_POST['new_price'];

    $category = find_item_category($itemName);

    if ($category === false){
        set_error("This product does not exist");
        return;
    }

    if ($newPrice < 1){
        set_error("Price can not be less than 1");
        return;
    }

    $_SESSION['categories'][$category][$itemName]['price'] = $newPrice;
    $_SESSION['step'] = "products list";
}

function handle_add_product(){
    if (!isset($_POST['button'])) return;

    if ($_POST['button'] == "back"){
        $_SESSION['step'] = "products list";
        return;
    }

    if ($_POST['button'] != "submit") return;

    if (!isset($_POST['category_name']) || trim($_POST['category_name']) == "" ||
        !isset($_POST['item_name']) || trim($_POST['item_name']) == "" ||
        !isset($_POST['price']) || $_POST['price'] === "" ||
        !isset($_POST['quantity']) || $_POST['quantity'] === ""){
        set_error("You DID NOT enter full data");
        return;
    }

    $categoryName = $_POST['category_name'];
    $itemName = $_POST['item_name'];
    $price = (int)$_POST['price'];
    $quantity = (int)$_POST['quantity'];

    if (find_item_category($itemName) !== false){
        set_error("This product already exists");
        return;
    }

    if ($price < 1 || $quantity < 0){
        set_error("Enter a valid price and quantity");
        return;
    }

    if (!isset($_SESSION['categories'][$categoryName])){
        $_SESSION['categories'][$categoryName] = [];
    }

    $_SESSION['categories'][$categoryName][$itemName] = ["price" => $price, "Quantity" => $quantity];
    $_SESSION['step'] = "products list";
}

function handle_delete_product(){
    if (!isset($_POST['button'])) return;

    if ($_POST['button'] == "back"){
        $_SESSION['step'] = "products list";
        return;
    }

    if ($_POST['button'] != "submit") return;

    if (!isset($_POST['item_name']) || trim($_POST['item_name']) == ""){
        set_error("You DID NOT enter full data");
        return;
    }

    $itemName = $_POST['item_name'];
    $category = find_item_category($itemName);

    if ($category === false){
        set_error("This product does not exist");
        return;
    }

    unset($_SESSION['categories'][$category][$itemName]);

    if (empty($_SESSION['categories'][$category])){
        unset($_SESSION['categories'][$category]);
    }

    $_SESSION['step'] = "products list";
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $currentStep = $_SESSION['step'];

    if ($currentStep == "products list"){
        handle_products_list();
    } elseif ($currentStep == "update quantity"){
        handle_update_quantity();
    } elseif ($currentStep == "edit price"){
        handle_edit_price();
    } elseif ($currentStep == "add product"){
        handle_add_product();
    } elseif ($currentStep == "delete product"){
        handle_delete_product();
    }
}

include("my-products-page.php");
?>