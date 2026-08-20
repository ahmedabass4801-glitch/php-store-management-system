<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

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

// $_SESSION['answer'] = [
//     'A' => [
//         'rejected' => [
//             'Electronics' => [
//                 'Laptop',
//                 'Keyboard',
//                 'Mouse'
//             ],
//             'Clothes' => [
//                 'T-Shirt',
//                 'Jacket'
//             ]
//         ],
//         'accepted' => [
//             'Electronics' => [
//                 'Monitor',
//                 'Headphones'
//             ]
//         ]
//     ],

//     'Mohamed' => [
//         'rejected' => [
//             'Books' => [
//                 'PHP Book',
//                 'SQL Book'
//             ]
//         ],
//         'accepted' => [
//             'Electronics' => [
//                 'Keyboard'
//             ]
//         ]
//     ]
// ];

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = "choose Categories";
}

function print_data($data){
    foreach ($data as $key => $value){
        echo $key . "&nbsp;:<br><br>";
            foreach ($value as $k => $v){
                echo "&nbsp;&nbsp;&nbsp;" . $k . "&nbsp;&nbsp;&nbsp;&nbsp;" . $v;
                if ($k == "price"){
                    echo "$";
                }
                echo "<br>";
            }
        echo "<br>";
    }
}

function do_log_out(){
    unset($_SESSION['step']);
    unset($_SESSION['user']);
    unset($_SESSION['chooses']);
    header("Location: index.php");
    exit();
}

function set_error($text){
    global $message;
    $message = "<span style='color: red; font-weight: bold;'>" . $text . "<br>Try Again";
}

function handle_choose_categories(){
    if (isset($_POST['button'])){
        if ($_POST['button'] == "submit"){
            if (!isset($_POST['Categories']) || count($_POST['Categories']) == 0) {
                set_error("You DID NOT choose any thing");
                return;
            } elseif (isset($_POST['Categories']) && count($_POST['Categories']) > 0) {
                $_SESSION['chooses'] = $_POST['Categories'];
                $_SESSION['step'] = "check prices";
            }
        } elseif ($_POST['button'] == "log_out"){
            do_log_out();
        }
    }
}

function handle_check_prices(){
    if (isset($_POST['button'])){
        if ($_POST['button'] == "buy"){
            $_SESSION['step'] = "choose what to pay";
        } elseif ($_POST['button'] == "back"){
            $_SESSION['step'] = "choose Categories";
        } elseif ($_POST['button'] == "log_out"){
            do_log_out();
        } elseif ($_POST['button'] == "wish") {
            $_SESSION['step'] = "ask for a wish";
        }
    } else {
        return;
    }
}

function handle_choose_what_to_pay(){
    if (!isset($_POST['chooses_2']) || count($_POST['chooses_2']) == 0){
        set_error("You DID NOT choose any thing");
        return;
    }

    $receipt = [];
    $total = 0;
    $_SESSION['chooses_2'] = $_POST['chooses_2'];
    $_SESSION['quantity'] = $_POST['quantity'];
    foreach ($_SESSION['chooses'] as $category){
        foreach ($_POST['chooses_2'] as $item){
            if (!isset($_SESSION['categories'][$category][$item])) continue;

            $available = $_SESSION['categories'][$category][$item]['Quantity'];
            $qty = isset($_SESSION['quantity']) ? (int)$_SESSION['quantity'][$item] : 0;
            if ($qty < 1 || $qty > $available) continue;
            
            $price = $_SESSION['categories'][$category][$item]['price'];
            $total += $price * $qty;

            $receipt[] = "$item x$qty = " . ($price * $qty) . "\$";
        }
    }

    if (count($receipt) == 0){
        set_error("You DID NOT choose any thing");
        return;
    }

    $_SESSION['receipt'] = $receipt;
    $_SESSION['total'] = $total;
    $_SESSION['step'] = "last step";
}

function handle_last_step(){
    if (isset($_POST['button'])){
        if ($_POST['button'] == "confirm"){
            foreach ($_SESSION['chooses'] as $category){
                foreach ($_SESSION['chooses_2'] as $item){
                    if (!isset($_SESSION['categories'][$category][$item])) {
                        continue;
                    }   
                        $qty = isset($_SESSION['quantity']) ? (int)$_SESSION['quantity'][$item] : 0;
                        $_SESSION['categories'][$category][$item]['Quantity'] -= $qty;
            }   }
            $_SESSION['step'] = "done";
        } elseif ($_POST['button'] == "edit"){
            $_SESSION['step'] = "choose what to pay";
        }
    }
}

function already_exist($list, $user, $item){
    foreach($list['wish'][$user] as $category => $wish){
        foreach($wish as $i){
            if($i == $item){
                return true;
            }
        }
    }

    return false;
}

function ask_for_wish(){
    if (!isset($_POST['button'])) return;
 
    if ($_POST['button'] == "wish"){
        if (!isset($_POST['Categories_wish']) || $_POST['Categories_wish'] == "" || !isset($_POST['item_wish']) || $_POST['item_wish'] == ""){
            set_error("you DID NOT enter full wish");
        } else {
            if (!isset($_SESSION['wish'])) {
                $_SESSION['wish'] = [];
            }
            $Categories_wish = $_POST['Categories_wish'];
            $item_wish = $_POST['item_wish'];
            $user = $_SESSION['user'];
            if (!isset($_SESSION['wish'][$user][$Categories_wish])) {
                $_SESSION['wish'][$user][$Categories_wish] = [];
            }
            if (!already_exist($_SESSION, $user, $item_wish)){
                $_SESSION['wish'][$user][$Categories_wish][] = $item_wish;
                $_SESSION['step'] = "ask for a wish";
                header("Location: client.php");
                exit();
            } else {
                set_error("you has sent this wish already before");
            }
        }
    } elseif ($_POST['button'] == "back"){
        $_SESSION['step'] = "check prices";
    } elseif ($_POST['button'] == "log_out") {
        do_log_out();
    } elseif ($_POST['button'] == "answer") {
        if (isset($_SESSION['answer'])){
            $_SESSION['step'] = "check answer";
            if (isset($_POST['button'])){
                if ($_POST['button'] == "log_out") {
                    do_log_out();
                }   
            }
        }
        else {
            set_error("there isn't any notification yet");
        }
    }
}

function done() {
    if (isset($_POST['button'])){
        if ($_POST['button'] == "log_out"){
            do_log_out();
        } elseif ($_POST['button'] == "again"){
            $_SESSION['step'] = "choose Categories";
        }
    }
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $currentStep = $_SESSION['step'];

    if ($currentStep == "choose Categories") {
        handle_choose_categories();
    } elseif ($currentStep == "check prices") {
        handle_check_prices();
    } elseif ($currentStep == "ask for a wish") {
        ask_for_wish();
    } elseif ($currentStep == "check answer") {
        ask_for_wish();
    } elseif ($currentStep == "choose what to pay") {
        handle_choose_what_to_pay();
    } elseif ($currentStep == "last step") {
        handle_last_step();
    } elseif ($currentStep == "done"){
        done();
    }
}

include("client-page.php");
?>