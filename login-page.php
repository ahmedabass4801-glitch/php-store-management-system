<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>

        <h2>Sign In</h2>
    <form action="index.php" method="POST">

    <label for="email">Email Address</label><br>
    <input type="email" id="email" name="email" required placeholder="example@mail.com"><br><br>

    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" required placeholder="••••••••"><br><br>

    <button type="submit" class="submit-btn">Login</button><br><br>
    <a href="forget-password-page.php">Forgot Password?</a>
    &nbsp;&nbsp;&nbsp;
    <a href="new-account-page.php">Create New Account</a><br>

        <?php 
        if (!empty($error)) {
            echo $error;
        }
        ?>

    </form>

</body>
</html>