<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Page</title>
</head>
<body>
    <form action = "forget-password.php" method = "POST">
        <?php if (!$found): ?>
        <label for="email">Email Address</label><br>
        <input type="email" id="email" name="email" required placeholder="example@mail.com"><br><br>
        <button type="submit" class="submit-btn">sumbit</button><br><br>
        <?php
        if (!empty($message_1)) {
                echo ucwords($message_1);
            }
        ?>
        <?php endif; ?>

        <?php if (isset($found) && $found === true): ?>
                <label for="new-password">Enter your new password</label><br>
                <input type="password" id="new-password" name="new-password" required placeholder="••••••••"><br><br>
                <label for="confirm-new-password">confirm your new password</label><br>
                <input type="password" id="confirm-new-password" name="confirm-new-password" required placeholder="••••••••"><br><br>
                <button type="submit" class="submit-btn">confirm your new password</button><br><br>
                <?php
                if (!empty($message_2)) {
                        echo ucwords($message_2);
                    }
                ?>
        <?php endif; ?>
    </form>
</body>
</html>