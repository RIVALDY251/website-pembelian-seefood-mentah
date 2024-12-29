<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seafood Website</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        nav {
            background-color: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        nav ul li {
            margin: 0 15px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 16px;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #ffc107;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="informasi.php">Informasi Seafood</a></li>
            <li><a href="beli.php">Stok Seafood</a></li>
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Daftar</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- footer code -->
</body>
</html>