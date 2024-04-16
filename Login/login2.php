<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPENGERGASSE-Login</title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/image-removebg-preview.png">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="login.js" defer></script>
</head>
<body class="text-center">

<?php
include("connect.php");
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pw']) && isset($_POST['email'])) {
        $username = stripcslashes($_POST['email']);
        $password = stripcslashes($_POST['pw']);
        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);

        $sql = "SELECT * FROM daten WHERE M_Email = '$username' AND M_Passwort = '$password'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            header("Location: /Main/main.html");
            exit();
        } else {
            $message = "<h1 class='error'>Login failed. Invalid username or password.</h1>";
        }
      }
}
?>

<main class="form-signin">
    <form method="POST">
        <img class="mb-4" src="img/spengergasse_logo_-_Moodle-removebg-preview.png" alt="" width="600" height="150">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        
        <?= $message ?>

        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@spengergasse.com" required pattern=".+@spengergasse\.at" >
            <label for="email">Email address (name@spengergasse.at)</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="pw" name="pw" placeholder="Password" required>
            <label for="pw">Password</label>
        </div>
        
        <div class="remember-me-container">
            <input type="checkbox" id="remember-me" name="remember-me" />
            <label for="remember-me">Remember me</label>
        </div>
        <input class="btn btn-lg btn-danger w-100" type="submit" id="btn" value="Login" />  
        <p class="mt-5 mb-3 text-muted">© Spengergasse 1758–2024 (TADEJA)</p>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
</body>
</html>
