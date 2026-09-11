<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products Review</title>
</head>
<body>
    <?php print_stuff($_SESSION); ?>
    <hr>

    <?php if ($_SESSION['step'] == "products list"): ?>
        <form action="my-products.php" method="POST">
            <?php if (!empty($_SESSION['expanded'])): ?>
                <button type="submit" class="submit-btn" name="button" value="update" style="width: 130px;">Update Quantity</button>
                <?php echo str_repeat("&nbsp;", 4); ?>
                <button type="submit" class="submit-btn" name="button" value="add" style="width: 100px;">Add Product</button>
                <?php echo str_repeat("&nbsp;", 4); ?>
                <button type="submit" class="submit-btn" name="button" value="edit_price" style="width: 80px;">Edit price</button>
                <?php echo str_repeat("&nbsp;", 4); ?>
                <button type="submit" class="submit-btn" name="button" value="delete" style="width: 100px;">Delete</button>
                <?php echo str_repeat("&nbsp;", 4); ?>
            <?php else: ?>
                <button type="submit" class="submit-btn" name="button" value="edit" style="width: 70px;">Edit</button>
                <?php echo str_repeat("&nbsp;", 4); ?>
            <?php endif; ?>
            <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">Back</button>
        </form>

    <?php elseif ($_SESSION['step'] == "update quantity"): ?>
        <form action="my-products.php" method="POST">
            <label>Product name</label><br>
            <input type="text" name="item_name" placeholder="Enter product name"><br><br>

            <label>New quantity</label><br>
            <input type="number" name="new_quantity" value="1" min="1" step="1" style="width: 70px;"><br><br>

            <button type="submit" class="submit-btn" name="button" value="submit" style="width: 70px;">submit</button>
            <?php echo str_repeat("&nbsp;", 8); ?>
            <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">back</button>
        </form>
        <?php if (!empty($message)): ?>
            <?php echo ucwords($message); ?>
        <?php endif; ?>

    <?php elseif ($_SESSION['step'] == "edit price"): ?>
        <form action="my-products.php" method="POST">
            <label>Product name</label><br>
            <input type="text" name="item_name" placeholder="Enter product name"><br><br>

            <label>New price</label><br>
            <input type="number" name="new_price" value="1" min="1" step="1" style="width: 70px;"><br><br>

            <button type="submit" class="submit-btn" name="button" value="submit" style="width: 70px;">submit</button>
            <?php echo str_repeat("&nbsp;", 8); ?>
            <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">back</button>
        </form>
        <?php if (!empty($message)): ?>
            <?php echo ucwords($message); ?>
        <?php endif; ?>

    <?php elseif ($_SESSION['step'] == "add product"): ?>
        <form action="my-products.php" method="POST">
            <label>Category</label><br>
            <input type="text" name="category_name" placeholder="Enter category name"><br><br>

            <label>Product name</label><br>
            <input type="text" name="item_name" placeholder="Enter product name"><br><br>

            <label>Price</label><br>
            <input type="number" name="price" value="1" min="1" step="1" style="width: 70px;"><br><br>

            <label>Quantity</label><br>
            <input type="number" name="quantity" value="1" min="1" step="1" style="width: 70px;"><br><br>

            <button type="submit" class="submit-btn" name="button" value="submit" style="width: 70px;">submit</button>
            <?php echo str_repeat("&nbsp;", 8); ?>
            <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">back</button>
        </form>
        <?php if (!empty($message)): ?>
            <?php echo ucwords($message); ?>
        <?php endif; ?>

    <?php elseif ($_SESSION['step'] == "delete product"): ?>
        <form action="my-products.php" method="POST">
            <label>Product name</label><br>
            <input type="text" name="item_name" placeholder="Enter product name"><br><br>

            <button type="submit" class="submit-btn" name="button" value="submit" style="width: 70px;">submit</button>
            <?php echo str_repeat("&nbsp;", 8); ?>
            <button type="submit" class="submit-btn" name="button" value="back" style="width: 70px;">back</button>
        </form>
        <?php if (!empty($message)): ?>
            <?php echo ucwords($message); ?>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>