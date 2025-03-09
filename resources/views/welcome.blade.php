<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrosoft</title>
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js para interactividad -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="container mx-auto flex justify-between items-center p-4">
            <img src="{{ asset('images/LogoAgrosoft2.png')}}" alt="Logo de la Finca" class="h-16 w-auto sm:h-20">
            <div>
                @auth
                    <a href="{{ url('/home') }}" class="text-gray-700 mr-4">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 mr-4">Ingresar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-700">Registrarse</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>
    
    <!-- Slider Hero Section -->
    <div x-data="{ activeSlide: 1 }" class="relative w-full h-screen overflow-hidden">
        <!-- Slides -->
        <div class="relative w-full h-full">
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-700"
                 :class="{'opacity-0': activeSlide !== 1, 'opacity-100': activeSlide === 1}"
                 style="background-image: url('{{ asset('images/slider1.jpg') }}'); background-size: cover; background-position: center;">
            </div>
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-700"
                 :class="{'opacity-0': activeSlide !== 2, 'opacity-100': activeSlide === 2}"
                 style="background-image: url('{{ asset('images/Slider2.jpg') }}'); background-size: cover; background-position: center;">
            </div>
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-all duration-700"
                 :class="{'opacity-0': activeSlide !== 3, 'opacity-100': activeSlide === 3}"
                 style="background-image: url('{{ asset('images/Slider3.jpg') }}'); background-size: cover; background-position: center;">
            </div>
        </div>
    
        <!-- Botones de control -->
        <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-3">
            <button @click="activeSlide = 1" class="w-4 h-4 bg-white rounded-full"></button>
            <button @click="activeSlide = 2" class="w-4 h-4 bg-white rounded-full"></button>
            <button @click="activeSlide = 3" class="w-4 h-4 bg-white rounded-full"></button>
        </div>
    </div>
    
    <!-- Sección de Servicios -->
    <section class="container mx-auto py-12">
        <h2 class="text-3xl font-bold text-center text-gray-800">Nuestros Servicios</h2>
        <div class="grid md:grid-cols-3 gap-8 mt-8">
            <div class="bg-white shadow-lg p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold text-gray-700">Registro de Cultivos</h3>
                <p class="text-gray-600 mt-2">Optimiza la gestión de tus cultivos con Agrosoft.</p>
            </div>
            <div class="bg-white shadow-lg p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold text-gray-700">Monitoreo en Tiempo Real</h3>
                <p class="text-gray-600 mt-2">Visualiza en un mapa interactivo el estado de tus cultivos.</p>
            </div>
            <div class="bg-white shadow-lg p-6 rounded-lg text-center">
                <h3 class="text-xl font-semibold text-gray-700">Análisis de Datos</h3>
                <p class="text-gray-600 mt-2">Reportes detallados para mejorar tu productividad.</p>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-green-800 text-white text-center py-6">
        <p>&copy; 2024 Agrosoft - Todos los derechos reservados</p>
    </footer>
    
</body>
</html>
