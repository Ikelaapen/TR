<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan Password tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }

    $query = "SELECT * FROM loginuser WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];

        // Redirect ke halaman tagihan
        header("Location: beranda.php");
        exit;
    } else {
        echo "<script>alert('Username atau Password salah!'); window.history.back();</script>";
        exit;
    }
}

// Proses logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: loginuser.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<style>
    a {
    text-decoration: none;
  }

  body {
    margin: 0; /* Menghilangkan margin default */
    padding: 0; /* Menghilangkan padding default */
    height: 100vh; /* Membuat tinggi body memenuhi layar */
    display: flex; /* Mengaktifkan Flexbox */
    justify-content: center; /* Memusatkan elemen secara horizontal */
    align-items: center; /* Memusatkan elemen secara vertikal */
    background: -webkit-linear-gradient(bottom, #2dbd6e, #a6f77b); /* Linear gradient dari bawah ke atas */
    background-repeat: no-repeat; /* Mencegah pengulangan background */
    background-size: cover; /* Memastikan background menutupi seluruh layar */
}

  label {
    font-family: "Raleway", sans-serif;
    font-size: 11pt;
  }
  #forgot-pass {
    color: #2dbd6e;
    font-family: "Raleway", sans-serif;
    font-size: 10pt;
    margin-top: 3px;
    text-align: right;
  }

 
#card {
    background: #fbfbfb;
    border-radius: 8px;
    box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
    height: 410px;
    width: 329px;
}

  #card-content {
    padding: 12px 44px;
  }
  #card-title {
    font-family: "Raleway Thin", sans-serif;
    letter-spacing: 4px;
    padding-bottom: 23px;
    padding-top: 13px;
    text-align: center;
  }
  #signup {
    color: #2dbd6e;
    font-family: "Raleway", sans-serif;
    font-size: 10pt;
    margin-top: 16px;
    text-align: center;
  }
  #submit-btn {
    background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
    border: none;
    border-radius: 21px;
    box-shadow: 0px 1px 8px #24c64f;
    cursor: pointer;
    color: white;
    font-family: "Raleway SemiBold", sans-serif;
    height: 42.3px;
    margin: 0 auto;
    margin-top: 50px;
    transition: 0.25s;
    width: 153px;
  }
  #submit-btn:hover {
    box-shadow: 0px 1px 18px #24c64f;
  }
  .form {
    align-items: left;
    display: flex;
    flex-direction: column;
  }
  .form-border {
    background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
    height: 1px;
    width: 100%;
  }
  .form-content {
    background: #fbfbfb;
    border: none;
    outline: none;
    padding-top: 14px;
  }
  .underline-title {
    background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
    height: 2px;
    margin: -1.1rem auto 0 auto;
    width: 89px;
  }
</style>
</head>

<body>
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>LOGIN</h2>
                <div class="underline-title"></div>
            </div>
            <!-- Form login -->
            <form action="loginuser.php" method="post" class="form">
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

