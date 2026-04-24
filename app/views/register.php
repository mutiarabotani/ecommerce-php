<!DOCTYPE html>
<html>
<head>
    <title>Register - E-Commerce</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4e73df;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #2e59d9;
        }

        a {
            color: #4e73df;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="register-card">

    <h2>E-Commerce</h2>
    <p>Daftar akun baru</p>

    <!-- ✅ FIX ROUTER -->
    <form method="POST" action="/register">

        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Daftar</button>

    </form>

    <p>
        Sudah punya akun? 
        <a href="/login">Login</a>
    </p>

</div>

</body>
</html>