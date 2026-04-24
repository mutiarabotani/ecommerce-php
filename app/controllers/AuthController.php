<?php
require_once __DIR__ . '/../models/User.php';

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AuthController {

    //  LOGIN VIEW 
    public function login() {
        include __DIR__ . '/../views/login.php';
    }

    //  REGISTER VIEW
    public function register() {
        include __DIR__ . '/../views/register.php';
    }

    //FORGOT VIEW 
    public function forgot() {
        include __DIR__ . '/../views/forgot.php';
    }

    // LOGIN
    public function processLogin() {
        $userModel = new User();
        $user = $userModel->login($_POST['email'], $_POST['password']);

        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['login_success'] = $user['username'];

            header("Location: /dashboard"); 
            exit;
        } else {
            $_SESSION['error'] = "Email atau password salah";

            header("Location: /login"); 
            exit;
        }
    }

    //REGISTER
    public function processRegister() {
        $userModel = new User();
        $userModel->register($_POST['username'], $_POST['email'], $_POST['password']);

        $_SESSION['success'] = "Akun berhasil dibuat, silakan login";

        header("Location: /login");
        exit;
    }

    // FORGOT PASSWORD 
    public function processForgot() {

        $email = $_POST['email'];

        require __DIR__ . '/../../vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = 'mutiarabotani795@gmail.com';
            $mail->Password = 'app_password'; // nanti isi app password

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mutiarabotani795@gmail.com', 'E-Cuti System');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password E-Cuti';
            $mail->Body = "
                Halo,<br><br>
                Klik link berikut untuk reset password:<br>
                <a href='http://localhost:8000/login'>Reset Password</a>
            ";

            $mail->send();

            $_SESSION['success'] = "Link reset dikirim ke email";
            header("Location: /login");
            exit;

        } catch (Exception $e) {
            echo "Gagal kirim email: " . $mail->ErrorInfo;
        }
    }
    public function logout() {

        // hapus semua session
        session_unset();
        session_destroy();

        // redirect ke login
        header("Location: /login");
        exit;
    }
}