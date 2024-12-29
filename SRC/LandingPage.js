import React, { useState } from 'react';

const LandingPage = () => {
const [searchLocation, setSearchLocation] = useState('');
const [isLoading, setIsLoading] = useState(false);
const [error, setError] = useState(null);

  // Sample featured products data
const featuredProducts = [
    {
    id: 1,
    name: "Fresh Tuna",
    description: "Premium quality fresh tuna",
    price: 150000,
    image: "/api/placeholder/300/200"
    },
    {
    id: 2,
    name: "King Crab",
    description: "Live king crab, fresh from the sea",
    price: 350000,
    image: "/api/placeholder/300/200"
    },
    {
    id: 3,
    name: "Salmon Fillet",
    description: "Premium salmon fillet cuts",
    price: 200000,
    image: "/api/placeholder/300/200"
    },
    {
    id: 4,
    name: "Jumbo Shrimp",
    description: "Fresh jumbo shrimp",
    price: 180000,
    image: "/api/placeholder/300/200"
    }
];

const handleSearch = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError(null);

    try {
        const query = searchLocation;
        const data = await searchLocation(query);
        console.log('Search results:', data);
        // Proses data yang diterima
    } catch (err) {
        setError('Gagal melakukan pencarian. Silakan coba lagi.');
    } finally {
        setIsLoading(false);
    }
};

return (
    <div className="min-h-screen">
      {/* Hero Section */}
    <div className="bg-yellow-400 min-h-[500px] flex items-center justify-center px-4">
        <div className="max-w-7xl w-full flex flex-col md:flex-row items-center justify-between gap-8">
        <div className="flex-1">
            <h1 className="text-4xl md:text-5xl font-bold mb-6 text-black text-center md:text-left">
            Welcome Samudra Jaya
            </h1>
            <form onSubmit={handleSearch} className="flex flex-col sm:flex-row gap-2">
            <input
                type="text"
                placeholder="Cari lokasi Anda..."
                className="flex-1 p-3 rounded-lg border border-gray-300"
                value={searchLocation}
                onChange={(e) => setSearchLocation(e.target.value)}
                disabled={isLoading}
            />
            <button
                type="submit"
                className="bg-red-400 text-white px-6 py-3 rounded-lg hover:bg-red-500 transition-colors disabled:bg-gray-400"
                disabled={isLoading}
            >
                {isLoading ? 'Mencari...' : 'Periksa'}
            </button>
            </form>
            {error && <p className="text-red-500 mt-2">{error}</p>}
        </div>
        <div className="flex-1 flex justify-center md:justify-end">
            <img 
            src="/api/placeholder/500/400" 
            alt="Sea Food Mascot" 
            className="w-full max-w-[500px] h-auto"
            loading="lazy"
            />
        </div>
        </div>
    </div>

      {/* Featured Products Section */}
    <div className="py-16">
        <div className="max-w-7xl mx-auto px-4">
        <h2 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            Produk Unggulan Kami
        </h2>
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {featuredProducts.map((product) => (
            <div 
                key={product.id} 
                className="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:-translate-y-2"
            >
                <img 
                src={product.image} 
                alt={product.name} 
                className="w-full h-48 object-cover"
                loading="lazy"
                />
                <div className="p-4">
                <h3 className="text-xl font-semibold text-gray-800 mb-2">{product.name}</h3>
                <p className="text-gray-600 mb-3">{product.description}</p>
                <p className="text-blue-600 text-lg font-semibold mb-3">
                    Rp {product.price.toLocaleString('id-ID')}
                </p>
                <button 
                    className="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                    onClick={() => console.log(`View details for ${product.name}`)}
                >
                    Lihat Detail
                </button>
                </div>
            </div>
            ))}
        </div>
        </div>
    </div>

      {/* Why Choose Us Section */}
    <div className="bg-gray-50 py-16">
        <div className="max-w-7xl mx-auto px-4">
        <h2 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            Mengapa Memilih Kami?
        </h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {[
            {
                title: "Selalu Segar",
                description: "Seafood kami dijamin segar karena langsung dari nelayan",
                icon: "/api/placeholder/80/80"
            },
            {
                title: "Kualitas Terbaik",
                description: "Kami hanya menjual produk dengan kualitas terbaik",
                icon: "/api/placeholder/80/80"
            },
            {
                title: "Pengiriman Cepat",
                description: "Pengiriman cepat untuk menjaga kesegaran produk",
                icon: "/api/placeholder/80/80"
            }
            ].map((feature, index) => (
            <div 
                key={index}
                className="bg-white p-8 rounded-lg text-center transition-transform hover:-translate-y-2"
            >
                <div className="w-20 h-20 mx-auto mb-6">
                <img 
                    src={feature.icon} 
                    alt={feature.title} 
                    className="w-full h-full"
                    loading="lazy"
                />
                </div>
                <h3 className="text-xl font-semibold text-gray-800 mb-4">{feature.title}</h3>
                <p className="text-gray-600">{feature.description}</p>
            </div>
            ))}
        </div>
        </div>
    </div>

      {/* Location Section */}
    <div className="py-16">
        <div className="max-w-7xl mx-auto px-4">
        <div className="flex flex-col md:flex-row items-center justify-between gap-8">
            <div className="flex-1">
            <h2 className="text-3xl md:text-4xl font-bold text-gray-800 text-center md:text-left mb-4">
                Temukan Lokasi Kami
            </h2>
            <div className="text-lg text-center md:text-left">
                <p>Instagram: @samudrajaya</p>
                <p className="mt-2">Alamat: Jl. Example Street No. 123</p>
                <p>Telepon: (021) 1234-5678</p>
            </div>
            </div>
            <div className="w-full md:w-[300px] h-[200px] bg-gray-100 rounded-lg overflow-hidden">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509123!2d144.9537353153164!3d-37.81627997975157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11f3b3%3A0x5045675218ceed0!2sYour%20Business%20Name!5e0!3m2!1sen!2sid!4v1616161616161!5m2!1sen!2sid"
                width="100%"
                height="100%"
                style={{ border: 0 }}
                allowFullScreen=""
                loading="lazy"
                title="Location Map"
            />
            </div>
        </div>
        </div>
    </div>

      {/* Footer */}
    <footer className="bg-gray-900 text-white py-16">
        <div className="max-w-7xl mx-auto px-4">
        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-12">
            {[
            {
                title: "Kota Kami",
                links: ["Jakarta", "Surabaya", "Medan", "Makassar", "Bandung"]
            },
            {
                title: "Perusahaan",
                links: ["Tentang Kami", "Tim", "Karir", "Blog"]
            },
            {
                title: "Kontak",
                links: ["Bantuan", "Kerjasama", "Gabung dengan Kami"]
            },
            {
                title: "Legal",
                links: ["Syarat & Ketentuan", "Kebijakan Pengembalian", "Privasi", "Cookie"]
            }
            ].map((section, index) => (
            <div key={index}>
                <h3 className="text-lg font-semibold mb-4">{section.title}</h3>
                <ul className="space-y-2">
                {section.links.map((link, linkIndex) => (
                    <li key={linkIndex}>
                    <button 
                        className="hover:text-gray-300 transition-colors"
                        onClick={() => console.log(`Clicked ${link}`)}
                    >
                        {link}
                    </button>
                    </li>
                ))}
                </ul>
            </div>
            ))}
        </div>
        <div className="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-gray-800">
            <p>© Samudra Jaya, {new Date().getFullYear()}</p>
            <div className="flex gap-4 mt-4 md:mt-0">
            {["Instagram", "Facebook", "Twitter"].map((social) => (
                <button
                key={social}
                className="hover:text-gray-300 transition-colors"
                onClick={() => console.log(`Navigate to ${social}`)}
                >
                {social}
                </button>
            ))}
            </div>
        </div>
        </div>
    </footer>
    </div>
);
};

export default LandingPage;