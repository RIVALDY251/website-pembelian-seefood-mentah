<?php
// Tambahkan file konfigurasi database dengan parameter yang benar
require_once 'config/database.php';

// Fungsi untuk membersihkan dan memvalidasi input
function cleanInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

// Variabel untuk menyimpan pesan error
$error = '';
$success = '';

// Proses registrasi saat form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi input
    $errors = [];
    
    // Bersihkan input
    $username = cleanInput($_POST['username'] ?? '');
    $fullname = cleanInput($_POST['fullname'] ?? '');
    $email = cleanInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validasi field wajib
    if (empty($username)) {
        $errors[] = "Username harus diisi";
    }
    
    if (empty($fullname)) {
        $errors[] = "Nama Lengkap harus diisi";
    }
    
    if (empty($email)) {
        $errors[] = "Email harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    }
    
    if (empty($confirm_password)) {
        $errors[] = "Konfirmasi Password harus diisi";
    }
    
    // Validasi kesesuaian password
    if ($password !== $confirm_password) {
        $errors[] = "Password dan konfirmasi password tidak cocok";
    }
    
    // Validasi panjang password
    if (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter";
    }
    
    // Jika tidak ada error, lanjutkan proses registrasi
    if (empty($errors)) {
        try {
            // Gunakan prepared statement untuk mencegah SQL Injection
            // Pastikan koneksi database sudah benar di file config/database.php
            
            // Cek apakah username atau email sudah ada
            $check_stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
            $check_stmt->bind_param("ss", $username, $email);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            
            if ($check_result->num_rows > 0) {
                $errors[] = "Username atau email sudah terdaftar";
            } else {
                // Hash password dengan algoritma yang aman
                $hashed_password = password_hash($password, PASSWORD_ARGON2ID);
                
                // Gunakan prepared statement untuk insert
                $insert_stmt = $conn->prepare("INSERT INTO users (username, fullname, email, password) VALUES (?, ?, ?, ?)");
                $insert_stmt->bind_param("ssss", $username, $fullname, $email, $hashed_password);
                
                if ($insert_stmt->execute()) {
                    // Set session untuk pesan sukses di halaman login
                    session_start();
                    $_SESSION['register_success'] = true;
                    header("Location: login.php");
                    exit();
                } else {
                    $errors[] = "Gagal mendaftar: " . $conn->error;
                }
            }
        } catch (Exception $e) {
            $errors[] = "Terjadi kesalahan sistem. Silakan coba lagi.";
            // Log error untuk debugging
            error_log("Registration Error: " . $e->getMessage());
        }
    }
    
    // Gabungkan error jika ada
    if (!empty($errors)) {
        $error = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Kost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* CSS sama seperti sebelumnya */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .register-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .registrasi-btn {
            width: 100%;
            padding: 10px;
            background-color: #ff9f00;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .registrasi-btn:hover {
            background-color: #ff8c00;
        }
        .error {
            color: #dc3545;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #ff9f00;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .password-container {
            position: relative;
        }
        
        .password-container input {
            width: calc(100% - 40px); /* Adjust input width to accommodate the icon */
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
        
        .toggle-password:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registrasi Akun Baru</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST" action="" novalidate>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" required>
                    <i class="toggle-password fas fa-eye" onclick="togglePassword('password')"></i>
                </div>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password:</label>
                <div class="password-container">
                    <input type="password" name="confirm_password" id="confirm_password" required>
                    <i class="toggle-password fas fa-eye" onclick="togglePassword('confirm_password')"></i>
                </div>
            </div>
            <button type="submit" class="registrasi-btn">Daftar</button>
            
            <div class="login-link">
                Sudah punya akun? <a href="login.php">Login di sini</a>
            </div>
        </form>
    </div>

    <script>
        // Function to toggle password visibility
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const icon = passwordInput.nextElementSibling;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Existing form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            
            if (password.length < 8) {
                e.preventDefault();
                alert('Password minimal 8 karakter!');
                return;
            }
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
            }
        });
    </script>
</body>
</html>