<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Page</title>
</head>
<body>
    <form action="client.php" method="POST">
    <?php if ($_SESSION['step'] == "choose Categories"): ?>
        <p>Choose Categories You Want</p>

        <?php
            foreach ($_SESSION['categories'] as $key => $value){
                if (!has_stock($value)) continue;
                echo "<label><input type='checkbox' name='Categories[]' value='$key'> $key </label><br>";
            }
        ?>
        <br><button type="submit" class="submit-btn" style="width: 70px;" name="button" value="submit">submit</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" name="button" value="log_out" style="width: 70px;">log out</button><br><br>
        <?php if (!empty($message)): ?>
            <?php echo ucwords($message); ?>
        <?php endif; ?>

    <?php elseif ($_SESSION['step'] == "check prices"): ?>
        <?php
            foreach ($_SESSION['chooses'] as $thing){
                echo "<h3>" . $thing . "</h3>";
                echo "<table border='1' cellpadding='6' cellspacing='0'>";
                echo "<tr><th>Item</th><th>Price</th><th>Available Quantity</th></tr>";
                foreach ($_SESSION['categories'][$thing] as $item => $details){
                    if ($details['Quantity'] < 1) continue;
                    echo "<tr><td>" . $item . "</td><td>" . $details['price'] . "$</td><td>" . $details['Quantity'] . "</td></tr>";
                }
                echo "</table><br><hr>";
            }
        ?>
        <h3>buy some stuff ?</h3>
        <button type="submit" class="submit-btn" name="button" value="buy" style="width: 70px;">buy</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" name="button" value="log_out" style="width: 70px;">log out</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">back</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" name="button" value="wish" style="width: 70px;">wish</button><br><br>

    <?php elseif ($_SESSION['step'] == "ask for a wish"): ?>
        <label for = "Categories wish">Category</label><br>
        <label><input type= "text" name = "Categories_wish" placeholder = "Enter categorie you wish"><br><br>
        
        <label for = "Categories wish">Item</label><br>
        <input type= "text" name = "item_wish" placeholder = "Enter item you wish"><br><br>
        
        <button type="submit" class="submit-btn" style="width: 70px;" name = "button" value = "wish">submit</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" style="width: 100px;" name = "button" value = "answer">notification</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" style="width: 70px;" name = "button" value = "back">back</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" name="button" value="log_out" style="width: 70px;">log out</button><br><br>
        <?php echo "you can send more than wish by submitting every wish<br><br>"; ?>
        <?php if (!empty($message)): ?>
                <?php echo ucwords($message); ?>
        <?php endif; ?>
    
    <?php elseif ($_SESSION['step'] == "check answer"): ?>
    <?php if (empty($_SESSION['answer'][$_SESSION['user']])): ?>
        <p>No results</p>
    <?php else: ?>
        <?php foreach ($_SESSION['answer'][$_SESSION['user']] as $state => $categories): ?>
            <?php if (!empty($categories)): ?>
                <h2><?= $state == "accepted" ? "Accepted Wishes" : "Rejected Wishes" ?></h2>
                <?php foreach ($categories as $category => $items): ?>
                    <?php if (!empty($items)): ?>
                        <h3><?= htmlspecialchars($category) ?></h3>
                        <ul>
                            <?php foreach ($items as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <button type="submit" class="submit-btn" name="button" value="log_out" style="width: 70px;">log out</button><br><br>

    <?php elseif ($_SESSION['step'] == "choose what to pay"): ?>
        <?php
            foreach ($_SESSION['chooses'] as $current){
                echo "<b>" . $current . " : </b><br><br>";
                foreach ($_SESSION['categories'][$current] as $key => $value) {
                    if ($value['Quantity'] < 1) continue;
                    echo "<label><input type='checkbox' name='chooses_2[]' value='$key'> $key </label>";
                    echo str_repeat("&nbsp;", 4);
                    echo "<label><input type='number' name='quantity[$key]' value='1' min='1' max='" . $value['Quantity'] . "' style='width: 70px;' step='1'></label>";
                    echo "&nbsp;&nbsp;" . $value['price'] . "$<br><br>";
                }
                echo "<br><br><hr>";
            }
        ?>
        <button type="submit" class="submit-btn" style="width: 70px;" name="pay" value="pay">pay</button><br><br>
        <?php if (!empty($message)): ?>
            <?php echo ucwords($message); ?>
        <?php endif; ?>

    <?php elseif ($_SESSION['step'] == "last step"): ?>
        <h3>Receipt</h3>
        <?php foreach ($_SESSION['receipt'] as $line): ?>
            <?php echo $line; ?><br>
        <?php endforeach; ?>
        <br><b>Total: <?php echo $_SESSION['total']; ?>$</b><br><br>
        <button type="submit" class="submit-btn" name="button" value="edit" style="width: 90px;">edit stuff</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" name="button" value="confirm" style="width: 90px;">confirm</button>
    
    <?php elseif ($_SESSION['step'] == "done"): ?>
        your payment has done <b>seccesfully</b><br><br><b>buy something else ?</b><br><br>
        <button type="submit" class="submit-btn" name="button" value="again" style="width: 90px;">buy</button>
        <?php echo str_repeat("&nbsp;", 8); ?>
        <button type="submit" class="submit-btn" name="button" value="log_out" style="width: 90px;">log out</button>
    <?php endif; ?>
    </form>
</body>
</html>