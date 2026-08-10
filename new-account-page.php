<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="new-account.php" method="POST">

    <label for="email">Email Address</label><br>
    <input type="email" id="email" name="email" required placeholder="example@mail.com"><br><br>

    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" required placeholder="••••••••"><br><br>

    <label for="Confirm-password">Confirm Password</label><br>
    <input type="password" id="Confirm-password" name="Confirm-password" required placeholder="••••••••"><br><br>

    <button type="submit" class="submit-btn">submit</button><br>

    <?php
    if (!empty($message)){
        echo $message;
    }
    ?>
    </form>
</body>
</html>