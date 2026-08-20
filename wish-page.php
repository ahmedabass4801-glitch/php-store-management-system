<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>clients wishes</title>
</head>
<body>

    <form method="POST">

<?php if ($_SESSION['admin_step'] == "check wishes"): ?>
    <?php if (there_is_wish($_SESSION['wish'])) : ?>
        <?php print_wishes($_SESSION); ?>
        <hr>
        <button type="submit" class="submit-btn" name="button" value="accept" style="width: 100px;">accept wishes</button>
        <?php echo str_repeat("&nbsp;", 4); ?>
        <button type="submit" class="submit-btn" name="button" value="reject" style="width: 100px;">reject wishes</button>
        <?php echo str_repeat("&nbsp;", 4); ?>
        <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">back</button>
    <?php else : ?>
        <?php echo "<b>there is no wishes yet</b>"; ?>
        <hr>
        <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">back</button>
    <?php endif; ?>
            
    <?php elseif ($_SESSION['admin_step'] == "do action"): ?>
        <?php print_wishes($_SESSION); ?>
        <hr>
        <label for="user">username</label><br>
        <input type="text" id="user" name="user" required placeholder="username"><br><br>

        <label for="categories">category</label><br>
        <input type="text" id="categories" name="categories" required placeholder="category_1,category_2,etc.."><br><br>

        <label for="items">item</label><br>
        <input type="text" id="items" name="items" required placeholder="item_1,item_2,etc.."><br><br>

        <button type="submit" class="submit-btn" name="button" value="confirm">submit & dashboard</button>
        <?php echo str_repeat("&nbsp;", 4); ?>
        <button type="submit" class="submit-btn" name="button" value="again">accept / reject other wishes</button><br><br>

        <?php
        if (!empty($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
        ?>

    <?php endif; ?>

    </form>

</body>
</html>

