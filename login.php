<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset=""UTF-8>
        <title>Document</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
    <div class="img">
        <div class="content">
            <h2> Login</h2>
            <form method="post">
                <div class="username">
                    <input type="text" name="username" required placeholder="      Enter user name">
                    
                </div>
                <div class="pass">
                    <input type="password" class="pass-key" required placeholder="      Enter password">
                    <span class="show">show</span>
                </div>
                <div class="button1">
                    <input type="submit" value="login">

                </div>
            </form>
            <div class="signup">

                <p class="p1">Don't have an account?</p>
                <a href="signup.php"> create one </a>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>