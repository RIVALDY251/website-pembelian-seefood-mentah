// api.js
const API_ENDPOINTS = {
    search: '/api/search',
    products: '/api/products'
};

// Fungsi fetch yang digunakan ulang
export async function fetchData(endpoint, params = {}) {
    try {
        const url = new URL(endpoint, window.location.origin);
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
        
        const response = await fetch(url);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error;
    }
}

// Contoh fungsi pencarian lokasi
export async function searchLocation(location) {
    try {
        const data = await fetchData(API_ENDPOINTS.search, { location });
        return data;
    } catch (error) {
        console.error('Location search failed:', error);
        throw error;
    }
}

// Fungsi ambil produk
export async function getProducts() {
    try {
        const products = await fetchData(API_ENDPOINTS.products);
        return products;
    } catch (error) {
        console.error('Failed to fetch products:', error);
        throw error;
    }
}