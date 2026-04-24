<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>

    <link rel="stylesheet" href="/public/css/forgot.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="forgot-wrapper">
    <div class="forgot-card">

        <h2>Reset Password</h2>
        <p>Masukkan email kamu untuk menerima link reset</p>

        <form method="POST" action="/forgot">

            <input type="email" name="email" placeholder="Masukkan Email" required>

            <button type="submit">Kirim Link</button>

        </form>

        <p class="register-text">
            <a href="/login">Kembali ke Login</a>
        </p>

    </div>
</div>

</body>
</html>