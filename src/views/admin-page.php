<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>
<body>
<a href="wish.php">wishes section</a>
&nbsp;&nbsp;
<?php echo wish_counter() . " wish(es)"; ?><br>
<a href="my-products.php">products review</a>
&nbsp;&nbsp;
<span style="color: red;">
<?php echo warning_counter() . " Warning(s)"; ?>
</span><br>
<a href="sales.php">Sales</a>
&nbsp;&nbsp;
<?php echo total_earn() . " $"; ?><br>
<a href="index.php">log out</a><br>
</body>
</html>