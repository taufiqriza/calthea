<x-frontend.layout title="Beranda">

    {{-- Hero Section --}}
    <section id="beranda" class="relative min-h-screen flex items-center pt-16 lg:pt-0 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-cream-100 via-cream-50 to-beige-100"></div>
        
        {{-- Decorative Elements --}}
        <div class="absolute top-20 right-10 w-72 h-72 bg-coffee-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-beige-300/30 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-12 lg:py-0">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Content --}}
                <div class="text-center lg:text-left order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 rounded-full mb-6">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-green-700 text-sm font-medium">Open Daily from 10 AM 🌿</span>
                    </div>
                    
                    <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-coffee-900 leading-tight mb-6">
                        Cafe & Nature
                        <span class="block text-coffee-600">Experience</span>
                        <span class="block text-3xl sm:text-4xl lg:text-5xl mt-2 font-normal text-coffee-500">di Kota Batu</span>
                    </h1>
                    
                    <p class="text-coffee-600 text-lg lg:text-xl leading-relaxed mb-8 max-w-lg mx-auto lg:mx-0">
                        Nikmati secangkir kopi premium dengan suasana alam yang menenangkan. Pengalaman cafe unik di lereng Arjuno, Kota Batu.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#menu" class="px-8 py-4 bg-coffee-600 text-white font-semibold rounded-full hover:bg-coffee-700 hover:shadow-xl hover:shadow-coffee-600/30 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-coffee"></i>
                            Lihat Menu
                        </a>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="px-8 py-4 bg-gradient-to-r from-coffee-500 to-coffee-600 text-white font-semibold rounded-full hover:from-coffee-600 hover:to-coffee-700 hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i>
                            Chat WhatsApp
                        </a>
                    </div>
                    
                    {{-- Stats --}}
                    <div class="flex items-center justify-center lg:justify-start gap-8 mt-12 pt-8 border-t border-coffee-200">
                        <div class="text-center">
                            <div class="font-serif text-3xl font-bold text-coffee-800">460+</div>
                            <div class="text-coffee-500 text-sm">Followers</div>
                        </div>
                        <div class="w-px h-12 bg-coffee-200"></div>
                        <div class="text-center">
                            <a href="https://www.instagram.com/caltheabatu" target="_blank" class="flex items-center gap-1 text-pink-600 hover:text-pink-700">
                                <i class="fab fa-instagram text-2xl"></i>
                            </a>
                            <div class="text-coffee-500 text-sm">@caltheabatu</div>
                        </div>
                        <div class="w-px h-12 bg-coffee-200"></div>
                        <div class="text-center">
                            <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="text-coffee-600 hover:text-coffee-800">
                                <i class="fas fa-map-marker-alt text-2xl"></i>
                            </a>
                            <div class="text-coffee-500 text-sm">Kota Batu</div>
                        </div>
                    </div>
                </div>
                
                {{-- Image --}}
                <div class="order-1 lg:order-2 relative">
                    <div class="relative">
                        {{-- Main Image Container --}}
                        <div class="relative w-72 h-72 sm:w-96 sm:h-96 lg:w-[500px] lg:h-[500px] mx-auto">
                            {{-- Decorative Circle --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-coffee-200 to-coffee-300 rounded-full animate-float"></div>
                            
                            {{-- Coffee Image Placeholder --}}
                            <div class="absolute inset-4 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner">
                                <img src="{{ asset('images/logo-calthea.jpg') }}" alt="Calthea" class="w-48 h-48 lg:w-72 lg:h-72 object-contain">
                            </div>
                            
                            {{-- Floating Badge 1 --}}
                            <div class="absolute -left-4 top-1/4 bg-white rounded-2xl p-4 shadow-xl shadow-coffee-200/50 animate-float" style="animation-delay: 1s;">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-coffee-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-leaf text-coffee-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-coffee-800">100%</div>
                                        <div class="text-coffee-500 text-xs">Organik</div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Floating Badge 2 --}}
                            <div class="absolute -right-4 bottom-1/4 bg-white rounded-2xl p-4 shadow-xl shadow-coffee-200/50 animate-float" style="animation-delay: 2s;">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-award text-yellow-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-coffee-800">Best</div>
                                        <div class="text-coffee-500 text-xs">Quality</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden lg:flex flex-col items-center gap-2 text-coffee-400">
            <span class="text-sm">Scroll</span>
            <div class="w-6 h-10 border-2 border-coffee-300 rounded-full flex justify-center pt-2">
                <div class="w-1.5 h-3 bg-coffee-400 rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    {{-- Featured Menu Section --}}
    <section id="menu" class="py-20 lg:py-32 bg-white relative overflow-hidden">
        {{-- Decorative --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-coffee-100/50 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-beige-200/50 rounded-full -ml-24 -mb-24"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative">
            {{-- Header --}}
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 bg-coffee-100 text-coffee-600 text-sm font-medium rounded-full mb-4">Menu Pilihan</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-coffee-900 mb-6">
                    Menu Favorit Kami
                </h2>
                <p class="text-coffee-600 text-lg">
                    Minuman & makanan lezat dengan nuansa alam Kota Batu
                </p>
            </div>
            
            {{-- Coffee & Drinks --}}
            <div class="mb-12">
                <h3 class="font-serif text-2xl font-bold text-coffee-800 mb-8 flex items-center gap-3">
                    <i class="fas fa-mug-hot text-coffee-500"></i>
                    Minuman
                </h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                    {{-- Kopi Susu Calthea --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="relative">
                            <div class="w-full aspect-square bg-gradient-to-br from-coffee-200 to-coffee-400 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                                <i class="fas fa-glass-whiskey text-white text-5xl"></i>
                            </div>
                            <span class="absolute top-3 right-3 px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full">Best Seller</span>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Kopi Susu Calthea</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">18K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Signature drink dengan susu segar dan gula aren pilihan.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                    
                    {{-- Hot Caffe Latte --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-full aspect-square bg-gradient-to-br from-amber-100 to-amber-200 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                            <i class="fas fa-mug-hot text-amber-700 text-5xl"></i>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Hot Caffe Latte</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">20K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Kopi latte hangat dengan foam lembut sempurna.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                    
                    {{-- Matcha Latte --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-full aspect-square bg-gradient-to-br from-green-100 to-green-200 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                            <i class="fas fa-blender text-green-600 text-5xl"></i>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Matcha Latte</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">22K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Teh hijau premium dengan susu creamy.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                    
                    {{-- Es Coklat --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-full aspect-square bg-gradient-to-br from-amber-200 to-amber-400 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                            <i class="fas fa-cookie-bite text-amber-800 text-5xl"></i>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Es Coklat</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">18K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Coklat dingin yang menyegarkan untuk cuaca panas.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                </div>
            </div>

            {{-- Food Section --}}
            <div class="mb-12">
                <h3 class="font-serif text-2xl font-bold text-coffee-800 mb-8 flex items-center gap-3">
                    <i class="fas fa-utensils text-coffee-500"></i>
                    Makanan
                </h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                    {{-- Nasgor Calthea --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="relative">
                            <div class="w-full aspect-square bg-gradient-to-br from-orange-100 to-orange-200 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                                <i class="fas fa-bowl-rice text-orange-600 text-5xl"></i>
                            </div>
                            <span class="absolute top-3 right-3 px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">Favorit</span>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Nasgor Calthea</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">20K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Nasi goreng spesial dengan bumbu rahasia Calthea.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                    
                    {{-- Maryam --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-full aspect-square bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                            <i class="fas fa-cookie text-yellow-700 text-5xl"></i>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Roti Maryam</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">12K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Roti maryam lembut dengan topping coklat/keju.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                    
                    {{-- Chicken Wings --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-full aspect-square bg-gradient-to-br from-red-100 to-red-200 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                            <i class="fas fa-drumstick-bite text-red-600 text-5xl"></i>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Chicken Wings</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">18K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Sayap ayam crispy dengan saus pilihan.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                    
                    {{-- Kebab --}}
                    <div class="group bg-cream-50 rounded-3xl p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
                        <div class="w-full aspect-square bg-gradient-to-br from-amber-100 to-amber-300 rounded-2xl mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500">
                            <i class="fas fa-hotdog text-amber-700 text-5xl"></i>
                        </div>
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-serif text-xl font-semibold text-coffee-900">Kebab</h3>
                            <span class="px-3 py-1 bg-coffee-600 text-white text-sm font-semibold rounded-full">15K</span>
                        </div>
                        <p class="text-coffee-500 text-sm mb-4">Kebab dengan daging dan sayuran segar.</p>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-full py-3 bg-coffee-100 text-coffee-700 font-medium rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp"></i> Pesan
                        </a>
                    </div>
                </div>
            </div>

            {{-- Snacks Section - 20% Off --}}
            <div class="mb-12">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-serif text-2xl font-bold text-coffee-800 flex items-center gap-3">
                        <i class="fas fa-cookie-bite text-coffee-500"></i>
                        Snacks
                    </h3>
                    <span class="px-4 py-2 bg-red-500 text-white font-bold rounded-full animate-pulse">20% OFF Everyday!</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 lg:gap-6">
                    {{-- French Fries --}}
                    <div class="group bg-cream-50 rounded-2xl p-4 hover:shadow-lg hover:shadow-coffee-200/50 transition-all duration-300 hover:-translate-y-1 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-xl mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-french-fries text-yellow-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-coffee-800 text-sm">French Fries</h4>
                        <p class="text-coffee-400 text-xs line-through">15K</p>
                        <p class="text-red-500 font-bold">12K</p>
                    </div>
                    
                    {{-- Pisang Goreng --}}
                    <div class="group bg-cream-50 rounded-2xl p-4 hover:shadow-lg hover:shadow-coffee-200/50 transition-all duration-300 hover:-translate-y-1 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-yellow-200 to-amber-200 rounded-xl mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-seedling text-amber-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-coffee-800 text-sm">Pisang Goreng</h4>
                        <p class="text-coffee-400 text-xs line-through">12K</p>
                        <p class="text-red-500 font-bold">10K</p>
                    </div>
                    
                    {{-- Banana Nugget --}}
                    <div class="group bg-cream-50 rounded-2xl p-4 hover:shadow-lg hover:shadow-coffee-200/50 transition-all duration-300 hover:-translate-y-1 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-apple-whole text-amber-700 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-coffee-800 text-sm">Banana Nugget</h4>
                        <p class="text-coffee-400 text-xs line-through">15K</p>
                        <p class="text-red-500 font-bold">12K</p>
                    </div>
                    
                    {{-- Cireng --}}
                    <div class="group bg-cream-50 rounded-2xl p-4 hover:shadow-lg hover:shadow-coffee-200/50 transition-all duration-300 hover:-translate-y-1 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-orange-100 to-orange-200 rounded-xl mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-circle text-orange-500 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-coffee-800 text-sm">Cireng</h4>
                        <p class="text-coffee-400 text-xs line-through">10K</p>
                        <p class="text-red-500 font-bold">8K</p>
                    </div>
                    
                    {{-- Tahu Cabe Garam --}}
                    <div class="group bg-cream-50 rounded-2xl p-4 hover:shadow-lg hover:shadow-coffee-200/50 transition-all duration-300 hover:-translate-y-1 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-red-100 to-red-200 rounded-xl mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-pepper-hot text-red-500 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-coffee-800 text-sm">Tahu Cabe Garam</h4>
                        <p class="text-coffee-400 text-xs line-through">12K</p>
                        <p class="text-red-500 font-bold">10K</p>
                    </div>
                    
                    {{-- Lumpia Sayur --}}
                    <div class="group bg-cream-50 rounded-2xl p-4 hover:shadow-lg hover:shadow-coffee-200/50 transition-all duration-300 hover:-translate-y-1 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-green-100 to-green-200 rounded-xl mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-leaf text-green-600 text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-coffee-800 text-sm">Lumpia Sayur</h4>
                        <p class="text-coffee-400 text-xs line-through">12K</p>
                        <p class="text-red-500 font-bold">10K</p>
                    </div>
                </div>
            </div>

            {{-- Bundling Weekend Section --}}
            <div class="mb-12">
                <h3 class="font-serif text-2xl font-bold text-coffee-800 mb-8 flex items-center gap-3">
                    <i class="fas fa-gift text-coffee-500"></i>
                    Bundling Weekend
                    <span class="px-3 py-1 bg-gradient-to-r from-coffee-500 to-coffee-600 text-white text-xs font-semibold rounded-full">HEMAT!</span>
                </h3>
                <div class="grid sm:grid-cols-2 gap-6 lg:gap-8">
                    {{-- Package 1 --}}
                    <div class="group bg-gradient-to-br from-coffee-50 to-cream-100 rounded-3xl p-8 border-2 border-coffee-200 hover:border-coffee-400 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <span class="px-4 py-2 bg-coffee-600 text-white font-bold rounded-full">Paket 1</span>
                            <div class="text-right">
                                <span class="text-3xl font-bold text-coffee-800">25K</span>
                                <p class="text-xs text-coffee-500">Hemat 13K!</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-3 bg-white rounded-xl">
                                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-bowl-rice text-orange-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-coffee-800">Nasgor Calthea</h4>
                                    <p class="text-coffee-400 text-sm">Nasi goreng spesial</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-3 bg-white rounded-xl">
                                <div class="w-12 h-12 bg-coffee-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-glass-whiskey text-coffee-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-coffee-800">Kopi Susu Calthea</h4>
                                    <p class="text-coffee-400 text-sm">Signature drink</p>
                                </div>
                            </div>
                        </div>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="mt-6 w-full py-4 bg-coffee-600 text-white font-bold rounded-xl hover:bg-coffee-700 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-lg"></i> Pesan Paket Ini
                        </a>
                    </div>
                    
                    {{-- Package 2 --}}
                    <div class="group bg-gradient-to-br from-amber-50 to-cream-100 rounded-3xl p-8 border-2 border-amber-200 hover:border-amber-400 hover:shadow-xl hover:shadow-amber-200/50 transition-all duration-500">
                        <div class="flex items-center justify-between mb-6">
                            <span class="px-4 py-2 bg-amber-600 text-white font-bold rounded-full">Paket 2</span>
                            <div class="text-right">
                                <span class="text-3xl font-bold text-coffee-800">15K</span>
                                <p class="text-xs text-coffee-500">Hemat 17K!</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-3 bg-white rounded-xl">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-cookie text-yellow-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-coffee-800">Roti Maryam</h4>
                                    <p class="text-coffee-400 text-sm">Dengan topping</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-3 bg-white rounded-xl">
                                <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-mug-hot text-amber-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-coffee-800">Hot Caffe Latte</h4>
                                    <p class="text-coffee-400 text-sm">Kopi hangat</p>
                                </div>
                            </div>
                        </div>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="mt-6 w-full py-4 bg-amber-600 text-white font-bold rounded-xl hover:bg-amber-700 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-lg"></i> Pesan Paket Ini
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- View All --}}
            <div class="text-center mt-12">
                <a href="https://www.instagram.com/caltheabatu" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-pink-500 to-orange-400 text-white font-semibold rounded-full hover:from-pink-600 hover:to-orange-500 hover:shadow-xl transition-all duration-300">
                    <i class="fab fa-instagram"></i>
                    Lihat Menu Lengkap di Instagram
                </a>
            </div>
        </div>
    </section>

    {{-- Signature Drinks Section --}}
    <section class="py-20 lg:py-32 bg-gradient-to-br from-coffee-800 to-coffee-900 text-white relative overflow-hidden">
        {{-- Pattern --}}
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23fff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Content --}}
                <div>
                    <span class="inline-block px-4 py-2 bg-coffee-700 text-coffee-200 text-sm font-medium rounded-full mb-4">Signature Collection</span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">
                        Minuman Khas<br>
                        <span class="text-coffee-400">Calthea</span>
                    </h2>
                    <p class="text-coffee-300 text-lg leading-relaxed mb-8">
                        Kreasi eksklusif dari barista kami yang telah memenangkan berbagai penghargaan. Setiap minuman adalah karya seni yang dapat dinikmati.
                    </p>
                    
                    <div class="space-y-6 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-coffee-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-crown text-coffee-400"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg mb-1">Calthea Royal Blend</h4>
                                <p class="text-coffee-400 text-sm">Perpaduan 3 jenis biji kopi premium pilihan dari berbagai daerah.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-coffee-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-fire text-orange-400"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg mb-1">Spiced Mocha Deluxe</h4>
                                <p class="text-coffee-400 text-sm">Kopi mocha dengan sentuhan rempah khas Indonesia.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-coffee-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-snowflake text-blue-400"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg mb-1">Iced Coconut Coffee</h4>
                                <p class="text-coffee-400 text-sm">Kesegaran kelapa muda berpadu dengan kopi cold brew.</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="inline-flex items-center gap-2 px-8 py-4 bg-coffee-500 text-white font-semibold rounded-full hover:bg-coffee-400 hover:shadow-xl transition-all duration-300">
                        Coba Sekarang
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                {{-- Image --}}
                <div class="relative flex items-center justify-center">
                    <div class="w-72 h-72 sm:w-96 sm:h-96 bg-gradient-to-br from-coffee-600 to-coffee-700 rounded-full flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-mug-hot text-8xl text-coffee-400 mb-4"></i>
                            <p class="font-serif text-2xl text-coffee-300">Signature</p>
                        </div>
                    </div>
                    
                    {{-- Floating Elements --}}
                    <div class="absolute top-0 -right-4 w-20 h-20 bg-coffee-600 rounded-2xl flex items-center justify-center animate-float">
                        <i class="fas fa-star text-yellow-400 text-2xl"></i>
                    </div>
                    <div class="absolute -bottom-4 left-0 w-24 h-24 bg-coffee-700 rounded-full flex items-center justify-center animate-float" style="animation-delay: 1.5s;">
                        <i class="fas fa-heart text-red-400 text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section id="tentang" class="py-20 lg:py-32 bg-cream-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Image --}}
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-coffee-300/30">
                        <div class="aspect-[4/5] bg-gradient-to-br from-coffee-300 to-coffee-400 flex items-center justify-center">
                            <div class="text-center text-white p-8">
                                <i class="fas fa-store text-8xl mb-6 opacity-60"></i>
                                <p class="font-serif text-2xl">Our Café</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Experience Badge --}}
                    <div class="absolute -bottom-6 -right-6 lg:right-10 w-32 h-32 bg-coffee-600 rounded-3xl flex items-center justify-center text-white shadow-xl">
                        <div class="text-center">
                            <div class="font-serif text-4xl font-bold">5+</div>
                            <div class="text-sm text-coffee-200">Tahun</div>
                        </div>
                    </div>
                </div>
                
                {{-- Content --}}
                <div>
                    <span class="inline-block px-4 py-2 bg-coffee-100 text-coffee-600 text-sm font-medium rounded-full mb-4">Tentang Kami</span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-coffee-900 mb-6">
                        Cafe & Nature
                        <span class="block text-coffee-600">di Kota Batu 🌿</span>
                    </h2>
                    <p class="text-coffee-600 text-lg leading-relaxed mb-6">
                        Calthea Cafe & Nature terletak di lereng Gunung Arjuno, menawarkan pengalaman ngopi yang berbeda dengan nuansa alam yang menenangkan.
                    </p>
                    <p class="text-coffee-500 leading-relaxed mb-8">
                        Berlokasi di Jl. Arjuno Atas No.99, Bumiaji, Kota Batu, kami menyajikan kopi premium dengan pemandangan alam yang memukau. Tempat yang sempurna untuk bersantai, bekerja, atau berkumpul bersama orang terkasih.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="p-6 bg-white rounded-2xl">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-tree text-green-600 text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-coffee-900 mb-1">Nuansa Alam</h4>
                            <p class="text-coffee-500 text-sm">Suasana asri & sejuk</p>
                        </div>
                        <div class="p-6 bg-white rounded-2xl">
                            <div class="w-12 h-12 bg-coffee-100 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-coffee text-coffee-600 text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-coffee-900 mb-1">Kopi Premium</h4>
                            <p class="text-coffee-500 text-sm">Biji pilihan terbaik</p>
                        </div>
                    </div>
                    
                    <a href="#" class="inline-flex items-center gap-2 text-coffee-600 font-semibold hover:text-coffee-800 transition">
                        Pelajari Lebih Lanjut
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Reviews Section --}}
    <section id="ulasan" class="py-20 lg:py-32 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            {{-- Header --}}
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 bg-coffee-100 text-coffee-600 text-sm font-medium rounded-full mb-4">Testimoni</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-coffee-900 mb-6">
                    Apa Kata Mereka?
                </h2>
                <p class="text-coffee-600 text-lg">
                    Kepuasan pelanggan adalah prioritas utama kami.
                </p>
            </div>
            
            {{-- Reviews Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Review 1 --}}
                <div class="bg-cream-50 rounded-3xl p-8 relative">
                    <div class="absolute top-6 right-6 text-coffee-200 text-6xl font-serif">"</div>
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-500"></i>
                        @endfor
                    </div>
                    <p class="text-coffee-700 leading-relaxed mb-6 relative z-10">
                        "Kopi terbaik yang pernah saya coba! Suasananya sangat nyaman untuk bekerja atau hangout bersama teman. Pasti akan kembali lagi!"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-coffee-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-coffee-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-coffee-900">Andi Pratama</div>
                            <div class="text-coffee-500 text-sm">Jakarta</div>
                        </div>
                    </div>
                </div>
                
                {{-- Review 2 --}}
                <div class="bg-cream-50 rounded-3xl p-8 relative">
                    <div class="absolute top-6 right-6 text-coffee-200 text-6xl font-serif">"</div>
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-500"></i>
                        @endfor
                    </div>
                    <p class="text-coffee-700 leading-relaxed mb-6 relative z-10">
                        "Caramel Latte-nya juara banget! Staff-nya ramah dan pelayanannya cepat. Tempatnya juga cocok untuk foto-foto aesthetic."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-pink-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-pink-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-coffee-900">Sarah Dewi</div>
                            <div class="text-coffee-500 text-sm">Bandung</div>
                        </div>
                    </div>
                </div>
                
                {{-- Review 3 --}}
                <div class="bg-cream-50 rounded-3xl p-8 relative md:col-span-2 lg:col-span-1">
                    <div class="absolute top-6 right-6 text-coffee-200 text-6xl font-serif">"</div>
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-500"></i>
                        @endfor
                    </div>
                    <p class="text-coffee-700 leading-relaxed mb-6 relative z-10">
                        "Sebagai pecinta kopi, saya sangat terkesan dengan kualitas biji kopi yang digunakan. Aroma dan rasanya luar biasa. Worth it!"
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-coffee-900">Budi Santoso</div>
                            <div class="text-coffee-500 text-sm">Surabaya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Reservation CTA Section --}}
    <section id="reservasi" class="py-20 lg:py-32 bg-gradient-to-br from-coffee-100 via-cream-100 to-beige-100 relative overflow-hidden">
        {{-- Decorative --}}
        <div class="absolute top-10 left-10 w-32 h-32 bg-coffee-200/50 rounded-full blur-2xl"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 bg-beige-300/50 rounded-full blur-3xl"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative">
            <span class="inline-block px-4 py-2 bg-coffee-600 text-white text-sm font-medium rounded-full mb-4">Reservasi Meja</span>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-coffee-900 mb-6">
                Siap Untuk Pengalaman<br>
                <span class="text-coffee-600">Kopi Terbaik?</span>
            </h2>
            <p class="text-coffee-600 text-lg mb-10 max-w-2xl mx-auto">
                Reservasi meja Anda sekarang dan nikmati suasana café yang nyaman bersama kopi premium kami.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" id="pesan" class="px-10 py-5 bg-coffee-600 text-white font-bold text-lg rounded-full hover:bg-coffee-700 hover:shadow-2xl hover:shadow-coffee-600/40 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                    <i class="fab fa-whatsapp"></i>
                    Chat WhatsApp
                </a>
                <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="px-10 py-5 bg-white text-coffee-700 font-bold text-lg rounded-full border-2 border-coffee-200 hover:border-coffee-400 hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-3">
                    <i class="fas fa-map-marker-alt"></i>
                    Lihat Lokasi
                </a>
            </div>
            
            {{-- Trust Badges --}}
            <div class="flex flex-wrap items-center justify-center gap-8 mt-12 pt-8 border-t border-coffee-200">
                <div class="flex items-center gap-2 text-coffee-500">
                    <i class="fas fa-shield-alt text-coffee-600"></i>
                    <span class="text-sm">Pembayaran Aman</span>
                </div>
                <div class="flex items-center gap-2 text-coffee-500">
                    <i class="fas fa-clock text-coffee-600"></i>
                    <span class="text-sm">Respon Cepat</span>
                </div>
                <div class="flex items-center gap-2 text-coffee-500">
                    <i class="fas fa-heart text-coffee-600"></i>
                    <span class="text-sm">50K+ Pelanggan Puas</span>
                </div>
            </div>
        </div>
    </section>

</x-frontend.layout>
