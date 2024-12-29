<?php include 'includes/header.php'; ?>

<style>
.info-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
    background: linear-gradient(135deg, #f0f9ff 0%, #e1f4ff 100%);
    min-height: 100vh;
}

.page-title {
    text-align: center;
    font-size: 2.8em;
    margin-bottom: 50px;
    color: #1a5f7a;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    position: relative;
    padding-bottom: 15px;
}

.page-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: #7cc6ff;
    border-radius: 2px;
}

.image-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); /* Memperbesar ukuran kolom */
    gap: 35px; /* Memperbesar jarak antar item */
    margin: 40px 0;
    padding: 30px; /* Memperbesar padding */
    background: rgba(255, 255, 255, 0.5);
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.gallery-item {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    aspect-ratio: 4/3; /* Mengubah rasio aspek untuk gambar lebih besar */
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    border: 3px solid #ffffff;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 100%); /* Memperkuat gradient */
    color: white;
    padding: 25px 20px; /* Memperbesar padding */
    transform: translateY(0);
    transition: all 0.3s ease;
    text-align: center;
    font-weight: 600;
    font-size: 1.3em; /* Memperbesar ukuran font */
    text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
}

.info-button {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #1a5f7a;
    color: white;
    border: none;
    padding: 10px 20px; /* Memperbesar padding button */
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    font-size: 1.1em; /* Memperbesar ukuran font */
    transition: all 0.3s ease;
}

.info-button:hover {
    background: #2980b9;
    transform: scale(1.05);
}

.info-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    z-index: 1000;
}

.modal-content {
    position: relative;
    background: white;
    width: 80%;
    max-width: 800px;
    margin: 50px auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.2);
}

.close-button {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #e74c3c;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

.close-button:hover {
    background: #c0392b;
}

.info-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 15px;
    margin-top: 40px;
}

.info-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border-top: 4px solid #7cc6ff;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.info-card h3 {
    color: #1a5f7a;
    font-size: 1.5em;
    margin-bottom: 15px;
    position: relative;
    padding-bottom: 10px;
}

.info-card h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background: #7cc6ff;
}

.info-card p {
    color: #444;
    line-height: 1.8;
    font-size: 1.05em;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2.2em;
    }
    
    .image-gallery {
        grid-template-columns: 1fr;
        padding: 15px;
    }
    
    .info-content {
        grid-template-columns: 1fr;
        padding: 15px;
    }
    
    .gallery-caption {
        padding: 20px 15px;
        font-size: 1.2em;
    }
}
</style>

<div class="info-container">
    <h2 class="page-title">Informasi Seafood</h2>
    
    <div class="image-gallery">
        <?php
        $seafoodInfo = [
            'Ikan Segar' => 'Ikan segar pilihan dengan kualitas terbaik. Ditangkap langsung dari laut dan diproses dengan standar kebersihan tinggi.',
            'Udang Premium' => 'Udang premium dengan ukuran besar dan daging yang manis. Cocok untuk berbagai hidangan seafood.',
            'Kepiting Segar' => 'Kepiting segar dengan daging tebal dan rasa manis. Ditangkap dari perairan terbaik.',
            'Cumi-cumi Segar' => 'Cumi-cumi segar dengan tekstur kenyal dan rasa yang lezat. Ideal untuk berbagai masakan.',
            'Kerang Pilihan' => 'Kerang pilihan yang masih segar dan bersih. Kaya akan nutrisi dan protein.',
            'Lobster Premium' => 'Lobster premium dengan ukuran jumbo dan daging yang tebal. Cocok untuk hidangan spesial.',
            'Gurita Segar' => 'Gurita segar dengan tekstur yang lembut. Diolah dengan cara khusus untuk mendapatkan hasil terbaik.',
            'Ikan Kakap Merah' => 'Ikan kakap merah dengan daging tebal dan rasa yang gurih. Sangat cocok untuk hidangan steam atau bakar.',
            'Salmon Segar' => 'Salmon segar dengan daging merah muda yang kaya omega-3. Cocok untuk sushi dan sashimi.'
        ];

        $images = [
            'image/segar.jpg',
            'image/premium.jpg', 
            'image/kepiting1.jpg',
            'image/cumi-cumi.jpg',
            'image/kerang11.jpg',
            'image/lobsterp.jpg',
            'image/gurita-s.jpg',
            'image/kakap-mp.jpg',
            'image/salmon-s.jpg'
        ];

        $captions = array_keys($seafoodInfo);

        for($i = 0; $i < count($images); $i++): ?>
            <div class="gallery-item">
                <img src="<?php echo $images[$i]; ?>" alt="<?php echo $captions[$i]; ?>" loading="lazy">
                <div class="gallery-caption"><?php echo $captions[$i]; ?></div>
                <button class="info-button" onclick="showInfo('<?php echo addslashes($captions[$i]); ?>', '<?php echo addslashes($seafoodInfo[$captions[$i]]); ?>')">Info</button>
            </div>
        <?php endfor; ?>
    </div>

    <div id="infoModal" class="info-modal">
        <div class="modal-content">
            <h3 id="modalTitle"></h3>
            <p id="modalDescription"></p>
            <button class="close-button" onclick="closeModal()">Kembali</button>
        </div>
    </div>

    <div class="info-content">
        <div class="info-card">
            <h3>Jenis-jenis Seafood</h3>
            <p>Kami menyediakan beragam seafood premium dari perairan terbaik, mulai dari ikan segar, udang windu, kepiting, hingga cumi-cumi. Setiap produk dipilih dengan standar kualitas tertinggi untuk memastikan kesegaran dan kelezatan maksimal. Koleksi seafood kami mencakup varietas lokal dan internasional yang diseleksi khusus untuk memenuhi ekspektasi pelanggan kami.</p>
        </div>
        
        <div class="info-card">
            <h3>Cara Memilih Seafood Segar</h3>
            <p>Kualitas seafood dapat dilihat dari beberapa indikator penting: warna yang cerah dan alami, tekstur daging yang kenyal dan elastis, serta aroma laut yang segar. Untuk ikan, perhatikan mata yang jernih dan menonjol, insang merah cerah, dan sisik yang masih kuat. Udang segar memiliki kepala yang menempel kuat, cangkang mengkilap, dan tidak berbau menyengat. Kepiting dan kerang harus masih hidup saat dibeli untuk menjamin kesegaran.</p>
        </div>
        
        <div class="info-card">
            <h3>Penyimpanan yang Tepat</h3>
            <p>Untuk menjaga kualitas seafood, simpan pada suhu optimal 0-4°C dalam wadah tertutup rapat. Seafood segar sebaiknya dikonsumsi dalam 1-2 hari. Untuk penyimpanan lebih lama, bekukan pada suhu -18°C dalam wadah kedap udara atau plastic vacuum. Hindari mencuci seafood sebelum disimpan untuk mencegah pertumbuhan bakteri. Letakkan seafood di bagian paling dingin kulkas dan pisahkan dari makanan lain.</p>
        </div>
        
        <div class="info-card">
            <h3>Nilai Gizi Seafood</h3>
            <p>Seafood merupakan sumber protein berkualitas tinggi dan omega-3 yang esensial bagi kesehatan. Kandungan EPA dan DHA dalam seafood mendukung fungsi otak dan kesehatan jantung. Selain itu, seafood kaya akan vitamin D, B12, selenium, dan yodium. Konsumsi seafood 2-3 kali seminggu membantu meningkatkan sistem kekebalan tubuh dan mendukung pertumbuhan optimal.</p>
        </div>

        <div class="info-card">
            <h3>Manfaat Mengkonsumsi Seafood</h3>
            <p>Mengkonsumsi seafood secara teratur memberikan berbagai manfaat kesehatan seperti menjaga kesehatan jantung, meningkatkan fungsi otak, mendukung pertumbuhan dan perkembangan janin, serta memperkuat sistem kekebalan tubuh. Seafood juga rendah kalori namun kaya akan nutrisi penting yang dibutuhkan tubuh.</p>
        </div>

        <div class="info-card">
            <h3>Tips Mengolah Seafood</h3>
            <p>Untuk mendapatkan hasil masakan seafood terbaik, pastikan bahan dalam keadaan segar, bersihkan dengan benar, dan jangan terlalu lama memasak agar tekstur tetap juicy. Gunakan bumbu yang sesuai untuk meningkatkan cita rasa tanpa menutupi rasa alami seafood. Perhatikan juga tingkat kematangan yang tepat untuk setiap jenis seafood.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach(item => {
        const img = item.querySelector('img');
        img.style.opacity = '0';
        img.addEventListener('load', () => {
            img.style.transition = 'opacity 0.5s ease';
            img.style.opacity = '1';
        });
    });

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.opacity = '1';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.info-card').forEach(card => {
            card.style.transform = 'translateY(20px)';
            card.style.opacity = '0';
            card.style.transition = 'all 0.5s ease';
            observer.observe(card);
        });
    }
});

function showInfo(title, description) {
    const modal = document.getElementById('infoModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    
    modalTitle.textContent = title;
    modalDescription.textContent = description;
    modal.style.display = 'block';
}

function closeModal() {
    const modal = document.getElementById('infoModal');
    modal.style.display = 'none';
}
</script>

<?php include 'includes/footer.php'; ?>
