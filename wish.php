<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['wish'])){
    $_SESSION['wish'] = [
        'Ahmed' => [
            'Electronics' => ['iPhone 15', 'AirPods Pro'],
            'Books' => ['Clean Code']
        ],
        'Mohamed' => [
            'Sportts' => ['Running Shoes', 'Football Shirt']
        ],
        'Ali' => [
            'Clothing' => ['Black Jacket', 'Blue Jeans'],
            'Electronics' => ['Gaming Mouse']
        ]
    ];
}

if(!isset($_SESSION['admin_step'])){
    $_SESSION['admin_step'] = "check wishes";
}

if(!isset($_SESSION['answer'])){
    $_SESSION['answer'] = [];
}

$error = "";

function there_is_wish($test) {
    $wish = false;
    foreach ($test as $user) {
        foreach ($user as $category) {
            if (!empty($category)) {
                $wish = true;
            }
        }
    }
    return $wish;
}

function nemc($category) {
    $n = false;
    foreach ($category as $items) {
        if (!empty($items)) {
            $n = true;
        }
    }
    return $n;
}

function exist($user, $categories, $items){
    if (!isset($_SESSION['wish'][$user])){
        return false;
    } else {
        foreach($categories as $category){
            if (!array_key_exists($category, $_SESSION['wish'][$user])){
                return false;
            }
        }
    }

    foreach($items as $item){
        $found = false;
        foreach($categories as $category){
            if (in_array($item, $_SESSION['wish'][$user][$category])){
                $found = true;
            }
        }

        if (!$found){
            return false;
        }
    }

    return true;
}

/* 
im so sorry to tell you that $category, $item will be array not single element
*/

function print_wishes($array) {
    foreach ($_SESSION['wish'] as $user => $category) {
        if (nemc($category)) {
            echo "<h3>" . $user . "</h3>";
            echo "<ul>";
            foreach ($category as $categoryName => $items) {
                if (!empty($items)) {
                    echo "<li><strong>" . $categoryName . "</strong>";
                    echo "<ul>";
                    foreach ($items as $wish) {
                        echo "<li>" . $wish . "</li>";
                    }
                    echo "</ul>";
                    echo "</li>";
                }
            }
            echo "</ul>";
        }
    }
}

function wipe($user, $categories, $items){
    foreach($items as $item){
        foreach($categories as $category){
            $index = array_search($item, $_SESSION['wish'][$user][$category]);
            if ($index !== false){
                unset($_SESSION['wish'][$user][$category][$index]);
            }
        }
    }
}

if(isset($_SESSION['admin_step'])){
    if ($_SESSION['admin_step'] == "check wishes"){
        if (isset($_POST['button'])){
            if ($_POST['button'] == "back"){
                header("Location: admin.php");
                exit();
            } elseif ($_POST['button'] == "accept"){
                $_SESSION['state'] = "accepted";
                $_SESSION['admin_step'] = "do action";
            } elseif ($_POST['button'] == "reject"){
                $_SESSION['state'] = "rejected";
                $_SESSION['admin_step'] = "do action";
            }
        }
    } elseif ($_SESSION['admin_step'] == "do action"){
        if (isset($_POST['user'], $_POST['categories'], $_POST['items']) &&
        !empty($_POST['user']) && !empty($_POST['categories']) && !empty($_POST['items'])){
            $user = $_POST['user'];
            $categories = explode(",", $_POST['categories']);
            $items = explode(",", $_POST['items']);
            if (isset($_POST['button'])){
                if (exist($user, $categories, $items)){
                    foreach($items as $item){
                        foreach($categories as $category){
                            $index = array_search($item, $_SESSION['wish'][$user][$category]);
                            if ($index !== false){
                                $_SESSION['answer'][$user][$_SESSION['state']][$category][] = $item;
                            }
                        }
                    }
                    wipe($user, $categories, $items);
                    if ($_POST['button'] == "confirm"){
                        header("Location: admin.php");
                        exit();
                    } elseif ($_POST['button'] == "again"){
                        $_SESSION['admin_step'] = "check wishes";
                        unset($_SESSION['error']);
                        header("Location: wish.php");
                        exit();
                    }

                } else {
                    $_SESSION['error'] = "your data isn't all accurate";
                }
            }
        } else {
            $_SESSION['error'] = "Please fill in all required fields";
        }
    }
}

include("wish-page.php");

?>