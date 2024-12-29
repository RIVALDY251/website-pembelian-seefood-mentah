<?php
header('Content-Type: application/json');
include 'config/database.php';

// Handler untuk pencarian lokasi
if ($_SERVER['REQUEST_URI'] === '/api/search' && isset($_GET['location'])) {
    $location = mysqli_real_escape_string($conn, $_GET['location']);
    
    // Contoh query pencarian sederhana
    $sql = "SELECT * FROM locations WHERE name LIKE '%$location%'";
    $result = mysqli_query($conn, $sql);
    
    $locations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $locations[] = $row;
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $locations
    ]);
    exit();
}

// Handler untuk produk
if ($_SERVER['REQUEST_URI'] === '/api/products') {
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    
    echo json_encode([
        'status' => 'success', 
        'data' => $products
    ]);
    exit();
}

// Jika tidak ada endpoint yang cocok
http_response_code(404);
echo json_encode(['status' => 'error', 'message' => 'Endpoint not found']);
exit();
?>