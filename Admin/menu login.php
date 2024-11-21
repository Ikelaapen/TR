<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="menu login.css">
    <link rel="stylesheet" href="beranda.css">
</head>

<body>
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>LOGIN</h2>
                <div class="underline-title"></div>
            </div>
            <!-- Form login -->
            <form action="login.php" method="post" class="form">
                <label for="username" style="padding-top:13px">&nbsp;Username</label>
                <input id="username" class="form-content" type="text" name="username" required />
                <div class="form-border"></div>

                <label for="user-password" style="padding-top:22px">&nbsp;Password</label>
                <input id="user-password" class="form-content" type="password" name="password" required />
                <div class="form-border"></div>

                <input id="submit-btn" type="submit" value="LOGIN" />
            </form>
        </div>
    </div>
</body>

</html>
