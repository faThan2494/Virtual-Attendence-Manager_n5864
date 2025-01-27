<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="login.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Open+Sans:wght@300..800&family=Poppins:wght@100..900&display=swap');
    </style>
    <title>LOGIN</title>
</head>
<body>
    <div class="login-box">
        <div class="login-header">
            <header>Welcome To Login Portal</header>
        </div>
        <form name="form" action="login.php" method="POST">
            <div class="input-box">
                <input type="email" name="email" class="input-feild" placeholder="Email" autocomplete="on" required>
            </div>

            <div class="input-box">
                <input type="password" name="password" class="input-feild" placeholder="Password" autocomplete="off" required>
            </div>

            <div class="forgot">
                
                <section>
                    <a href="#">Forgot password</a>
                </section>
            </div>

            <div class="input-submit">
                <input type="submit" class="submit-btn" value="Sign In">
            </div>
        </form>
    </div>
</body>
</html>
