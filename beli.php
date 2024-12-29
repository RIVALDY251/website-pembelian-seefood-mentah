<?php
include 'includes/header.php';
require_once 'config/database.php';

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil data produk dari database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<div class="products-container">
    <h2>Beli Seafood</h2>
    <div class="products-grid">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card">
                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p class="price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                <button onclick="addToCart(<?php echo $row['id']; ?>)">Tambah ke Keranjang</button>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seafood Store</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .products-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        h2 {
            color: #1a5f7a;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-info h3 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .product-info p {
            color: #666;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .price {
            color: #e67e22;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .btn-whatsapp {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background: #25D366;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn-whatsapp:hover {
            background: #128C7E;
        }

        .btn-whatsapp i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }

            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="products-container">
        <div class="products-grid">
            <?php
            $products = [
                ['id' => 1, 'name' => 'Udang Segar', 'price' => 150000, 'image' => 'image/udang.jpg'],
                ['id' => 2, 'name' => 'Kepiting Raja', 'price' => 280000, 'image' => 'image/kepiting.jpg'],
                ['id' => 3, 'name' => 'Ikan Salmon', 'price' => 200000, 'image' => 'image/salmon.jpg'],
                ['id' => 4, 'name' => 'Cumi-Cumi', 'price' => 120000, 'image' => 'image/cumi.jpg'],
                ['id' => 5, 'name' => 'Lobster', 'price' => 350000, 'image' => 'image/lobster.jpg'],
                ['id' => 6, 'name' => 'Kerang Hijau', 'price' => 90000, 'image' => 'image/kerang.jpg'],
                ['id' => 7, 'name' => 'Gurita', 'price' => 180000, 'image' => 'image/gurita.jpg'],
                ['id' => 8, 'name' => 'Ikan Tuna', 'price' => 250000, 'image' => 'image/tuna.jpg'],
                ['id' => 9, 'name' => 'Kakap Merah', 'price' => 170000, 'image' => 'image/kakapmerah.jpg'],
                ['id' => 10, 'name' => 'oysters', 'price' => 110000, 'image' => 'image/kerangbig.jpg'],
                ['id' => 9, 'name' => 'Kakap kuning ', 'price' => 170000, 'image' => 'image/kakapkuning.jpg'],
                ['id' => 10, 'name' => 'Hiu', 'price' => 110000, 'image' => 'image/hiu.jpg'],
            ];

            foreach ($products as $product): 
            ?>
                <div class="product-card">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <div class="product-info">
                        <h3><?php echo $product['name']; ?></h3>
                        <p>Seafood segar langsung dari laut, kualitas terjamin</p>
                        <p class="price">
                            Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>
                        </p>
                        <p class="discount-info">Diskon sesuai dengan  produck halaman pertama</p>
                        <a href="https://wa.me/085219107138?text=Saya ingin memesan <?php echo $product['name']; ?> dengan harga promo Rp <?php echo number_format($discountedPrice, 0, ',', '.'); ?> (sudah termasuk diskon 10%)" class="btn-whatsapp" target="_blank">
                            <i class="fab fa-whatsapp"></i>Pesan via WhatsApp
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html><?php
include 'includes/footer.php';
?>
