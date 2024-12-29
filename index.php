<?php
include 'includes/header.php';
require_once 'config/database.php';

// Ambil 7 produk unggulan dari database (increased from 4 to 7)
$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 7";
$result = mysqli_query($conn, $sql);

// Tambahkan array produk cadangan jika database kosong
$fallback_products = [
    [
        'image' => 'image/kepiting.jpg',
        'name' => 'kepiting raja',
        'description' => 'Kepiting segar langsung dari laut',
        'price' => 280000,
        'discount' => 10
    ],
    [
        'image' => 'image/udang.jpg', 
        'name' => 'Udang Windu',
        'description' => 'Udang windu kualitas premium',
        'price' => 150000,
        'discount' => 15
    ],
    [
        'image' => 'image/cumi.jpg',
        'name' => 'Cumi-cumi Segar',
        'description' => 'Cumi-cumi fresh dari nelayan',
        'price' => 120000,
        'discount' => 20
    ],
    [
        'image' => 'image/kakap m.jpg',
        'name' => 'Ikan Kakap Merah',
        'description' => 'Ikan kakap merah pilihan',
        'price' => 170000,
        'discount' => 25
    ],
    [
        'image' => 'image/air.jpg',
        'name' => 'Lobster Air Laut',
        'description' => 'Lobster segar berkualitas',
        'price' => 350000,
        'discount' => 5
    ],
    [
        'image' => 'image/kerang.jpg',
        'name' => 'Kerang Hijau',
        'description' => 'Kerang hijau pilihan',
        'price' => 90000,
        'discount' => 30
    ]
];
?>

<style>
/* Reset dan Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f8f9fa;
}

/* Marquee Style */
.marquee-container {
    width: 100%;
    overflow: hidden;
    background: #007bff;
    padding: 10px 0;
    margin-bottom: 20px;
}

.marquee-text {
    color: white;
    font-size: 1.2em;
    white-space: nowrap;
    animation: marquee 20s linear infinite;
}

@keyframes marquee {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}

/* Hero Section - Improved */
.hero-section {
    background: linear-gradient(135deg, #ffc107 0%, #ffdb4d 100%);
    min-height: 600px;
    display: flex;
    align-items: center;
    padding: 60px 0;
    margin-bottom: 40px;
}

.hero-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    gap: 60px;
}

.hero-text {
    flex: 1;
}

.hero-text h1 {
    font-size: 4em;
    font-weight: 800;
    margin-bottom: 30px;
    color: #1a1a1a;
    line-height: 1.2;
}

.hero-image {
    flex: 1;
    display: flex;
    justify-content: center;
}

.hero-image img {
    max-width: 100%;
    height: auto;
    border-radius: 30px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    transition: transform 0.3s ease;
}

.hero-image img:hover {
    transform: scale(1.05);
}

/* Search Box - Enhanced */
.search-box {
    display: flex;
    gap: 15px;
    margin-top: 40px;
}

.search-box input {
    flex: 1;
    padding: 18px;
    border: none;
    border-radius: 15px;
    font-size: 1.1em;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.search-box button {
    padding: 18px 35px;
    background: #ff4757;
    color: white;
    border: none;
    border-radius: 15px;
    font-weight: 600;
    font-size: 1.1em;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-box button:hover {
    background: #ff6b81;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255,71,87,0.3);
}

/* Products Section - Improved */
.featured-section {
    padding: 100px 0;
    background: white;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-title {
    font-size: 3em;
    text-align: center;
    margin-bottom: 60px;
    color: #2d3436;
    position: relative;
    padding-bottom: 20px;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 5px;
    background: linear-gradient(45deg, #007bff, #00a6ff);
    border-radius: 3px;
}

/* Product Cards - Enhanced */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-top: 50px;
}

.product-card {
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
}

.product-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.product-image {
    position: relative;
    overflow: hidden;
    height: 280px;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.1);
}

.discount-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff4757;
    color: white;
    padding: 5px 10px;
    border-radius: 10px;
    font-weight: bold;
    z-index: 1;
}

.product-info {
    padding: 30px;
}

.product-info h3 {
    font-size: 1.6em;
    margin-bottom: 15px;
    color: #2d3436;
}

.product-info p {
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.price {
    font-size: 1.8em;
    color: #007bff;
    font-weight: 700;
    margin: 20px 0;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    font-size: 1.2em;
    margin-right: 10px;
}

.discounted-price {
    color: #ff4757;
}

.buy-button {
    display: block;
    padding: 15px;
    background: linear-gradient(45deg, #007bff, #00a6ff);
    color: white;
    text-decoration: none;
    text-align: center;
    border-radius: 15px;
    font-weight: 600;
    font-size: 1.1em;
    transition: all 0.3s ease;
}

.buy-button:hover {
    background: linear-gradient(45deg, #0056b3, #007bff);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

/* Features Section - Enhanced */
.why-us-section {
    padding: 100px 0;
    background: #f8f9fa;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 50px;
}

.feature-card {
    text-align: center;
    padding: 50px 30px;
    background: white;
    border-radius: 25px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.feature-card img {
    width: 120px;
    height: 120px;
    margin-bottom: 30px;
    transition: transform 0.3s ease;
}

.feature-card:hover img {
    transform: scale(1.1);
}

.feature-card h3 {
    font-size: 1.8em;
    margin-bottom: 20px;
    color: #2d3436;
}

.feature-card p {
    color: #666;
    font-size: 1.1em;
    line-height: 1.6;
}

/* Map Section - Enhanced */
.map-section {
    padding: 100px 0;
    background: white;
}

.map-container {
    max-width: 1000px;
    margin: 0 auto;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}

.map-container iframe {
    width: 100%;
    height: 500px;
    border: none;
}

/* Responsive Design - Enhanced */
@media (max-width: 992px) {
    .hero-content {
        flex-direction: column;
        text-align: center;
        gap: 40px;
    }
    
    .hero-text h1 {
        font-size: 3em;
    }
    
    .section-title {
        font-size: 2.5em;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }
    
    .features-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
}

@media (max-width: 576px) {
    .hero-text h1 {
        font-size: 2.5em;
    }
    
    .search-box {
        flex-direction: column;
    }
    
    .search-box button {
        width: 100%;
    }
    
    .section-title {
        font-size: 2em;
    }
    
    .product-card {
        margin: 0 10px;
    }
}
</style>

<div class="marquee-container">
    <div class="marquee-text">
        Selamat datang di Samudra Jaya - Temukan seafood segar berkualitas terbaik dengan harga terjangkau! Gratis ongkir untuk pembelian di atas Rp 500.000
    </div>
</div>

<div class="hero-section">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Welcome to Samudra Jaya</h1>
            <div class="search-box">
                <input type="text" placeholder="Cari lokasi Anda...">
                <button>Periksa</button>
            </div>
        </div>
        <div class="hero-image">
            <img src="image/logooo.png" alt="Sea Food Mascot">
        </div>
    </div>
</div>

<div class="featured-section">
    <div class="container">
        <h2 class="section-title">Produk Unggulan Kami</h2>
        <div class="products-grid">
            <?php 
            $products_displayed = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $products_displayed++;
                $discount = rand(5, 30); // Random discount between 5-30%
                $original_price = $row['price'];
                $discounted_price = $original_price * (1 - $discount/100);
            ?>
                <div class="product-card">
                    <div class="discount-badge">Diskon <?php echo $discount; ?>%</div>
                    <div class="product-image">
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <p class="price">
                            <span class="original-price">Rp <?php echo number_format($original_price, 0, ',', '.'); ?></span>
                            <span class="discounted-price">Rp <?php echo number_format($discounted_price, 0, ',', '.'); ?></span>
                        </p>
                        <a href="beli.php?id=<?php echo $row['id']; ?>" class="buy-button">Lihat Detail</a>
                    </div>
                </div>
            <?php 
            }

            // Tampilkan produk cadangan jika data dari database kurang dari 7
            if ($products_displayed < 7) {
                for ($i = $products_displayed; $i < 6; $i++) {
                    $product = $fallback_products[$i];
                    $original_price = $product['price'];
                    $discounted_price = $original_price * (1 - $product['discount']/100);
            ?>
                <div class="product-card">
                    <div class="discount-badge">Diskon <?php echo $product['discount']; ?>%</div>
                    <div class="product-image">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="product-info">
                        <h3><?php echo $product['name']; ?></h3>
                        <p><?php echo $product['description']; ?></p>
                        <p class="price">
                            <span class="original-price">Rp <?php echo number_format($original_price, 0, ',', '.'); ?></span>
                            <span class="discounted-price">Rp <?php echo number_format($discounted_price, 0, ',', '.'); ?></span>
                        </p>
                        <a href="beli.php" class="buy-button">Lihat Detail</a>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="why-us-section">
    <div class="container">
        <h2 class="section-title">Mengapa Memilih Kami?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <img src="image/fresh.png" alt="Kesegaran">
                <h3>Selalu Segar</h3>
                <p>Seafood kami dijamin segar karena langsung dari nelayan terpercaya dengan standar kualitas tinggi</p>
            </div>
            <div class="feature-card">
                <img src="image/bulat1.png" alt="Kualitas">
                <h3>Kualitas Terbaik</h3>
                <p>Kami hanya menjual produk dengan kualitas best seller yang telah melalui proses seleksi ketat</p>
            </div>
            <div class="feature-card">
                <img src="image/mobil.png" alt="Pengiriman">
                <h3>Pengiriman Cepat</h3>
                <p>Pengiriman cepat dan terjamin untuk menjaga kesegaran produk sampai ke tangan Anda</p>
                </div>
        </div>
    </div>
</div>

<div class="map-section">
    <div class="container">
        <h2 class="section-title">Temukan Lokasi Kami</h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7988.382183866347!2d113.28982584539231!3d-7.788354084946207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7abc73df3fedf%3A0xdc728874342e9416!2sHome%20kepiting%20(p.dudung)!5e1!3m2!1sen!2sid!4v1731498403974!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

<script>
// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Lazy loading for images
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[data-src]');
    const imageOptions = {
        threshold: 0,
        rootMargin: '0px 0px 50px 0px'
    };

    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    }, imageOptions);

    images.forEach(img => imageObserver.observe(img));
});

// Add animation on scroll
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.product-card, .feature-card');
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const elementBottom = element.getBoundingClientRect().bottom;
        
        if (elementTop < window.innerHeight && elementBottom > 0) {
            element.classList.add('visible');
        }
    });
};

window.addEventListener('scroll', animateOnScroll);
window.addEventListener('load', animateOnScroll);
</script>

<?php
include 'includes/footer.php';
?>