<!DOCTYPE html>
<html>
<head>
    <title>Login - Fashion Shop</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff7a7a, #ff4d6d);
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left {
            width: 50%;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }

        .left h1 {
            font-size: 40px;
        }

        .left img {
            width: 250px;
            margin-top: 30px;
        }

        .right {
            width: 50%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 320px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #ff4d6d;
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #e63950;
        }

        .extra {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }

        .extra a {
            color: #ff4d6d;
            text-decoration: none;
        }

        .demo {
            margin-top: 15px;
            padding: 12px;
            border-radius: 10px;
            background: #fff3cd;
            border: 1px solid #ffe69c;
            font-size: 13px;
            text-align: center;
        }

        .error {
            background: #ffe5e5;
            color: red;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- LEFT -->
    <div class="left">
        <h1>Fashion Shop</h1>
        <p>Belanja mudah, cepat & terpercaya</p>
        <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png">
    </div>

    <!-- RIGHT -->
    <div class="right">

        <div class="login-box">

            <h2>Login Akun</h2>

            <!-- ERROR MESSAGE -->
            <?php if(isset($_SESSION['error'])): ?>
                <div class="error"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" action="/login">

                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn">Login</button>

 

                <div class="extra">
                    Belum punya akun? <a href="/register">Daftar</a>
                </div>

                <!-- DEMO ACCOUNT -->
                <div class="demo">
                    <strong>Demo Account</strong><br>
                    📧 mutiarabotani2222@gmail.com<br>
                    🔒 12345678
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>