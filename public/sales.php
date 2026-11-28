<?php
session_start();

if (isset($_SESSION['sales']) && !empty($_SESSION['sales'])){
    foreach ($_SESSION['sales'] as $users => $user){
        echo "<b>" . $users . "</b><br>";
        foreach ($user as $categories => $category){
            echo str_repeat("&nbsp;", 8);
            echo "• <b>" . $categories . " :</b><br><br>";
            foreach ($category as $items => $item){
                echo str_repeat("&nbsp;", 16);
                echo "- <b>" . $items . "</b><br>";
                foreach($item as $key => $value){
                    echo str_repeat("&nbsp;", 24);
                    echo $key . " : " . $value;
                    echo $key == "Total_Price" ? "$<br>" : "<br>";
                }
                echo "<br>";
            } 
        }
        echo "<hr>";
    }
} else {
    echo "There is NOT any Sales Yet!<hr>";
}

echo "<form method = 'POST'>";
echo "<button type = 'submit' class = 'submit-btn' name = 'button' value = 'back' style = 'width: 70px;'>back</button>";
echo "</form>";

if (isset($_POST['button'])){
    if ($_POST['button'] == "back"){
        header("Location: admin.php");
        exit();
    }
}
?>