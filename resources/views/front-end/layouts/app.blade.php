<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Cinema Flix - Download</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.tutorialjinni.com/Glide.js/3.4.1/css/glide.core.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.tutorialjinni.com/Glide.js/3.4.1/css/glide.core.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.tutorialjinni.com/Glide.js/3.4.1/css/glide.theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.tutorialjinni.com/Glide.js/3.4.1/css/glide.theme.min.css" />
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-white shadow-sm">
    <nav class="container mx-auto p-4">
        <div class="flex justify-between items-center">
            <!-- Logo or Branding -->
            <a href="#" class="text-xl font-bold">Your Logo/Brand</a>

            <!-- Hamburger Menu -->
            <div class="block lg:hidden">
                <button id="menu-btn" class="text-gray-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Navigation Links -->
            <ul class="hidden lg:flex space-x-4">
                <li><a href="#" class="text-gray-800 hover:text-blue-600 inline-block border-b-2 mr-6 border-transparent hover:border-blue-600"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#" class="text-gray-800 hover:text-blue-600 inline-block border-b-2 mr-6 border-transparent hover:border-blue-600"><i class="fas fa-film"></i> Movies</a></li>
                <li><a href="#" class="text-gray-800 hover:text-blue-600 inline-block border-b-2 mr-6 border-transparent hover:border-blue-600"><i class="fas fa-tv"></i> TV Series</a></li>
                <li><a href="#" class="text-gray-800 hover:text-blue-600 inline-block border-b-2 mr-6 border-transparent hover:border-blue-600"><i class="fas fa-video"></i> Videos</a></li>
                <li><a href="#" class="text-gray-800 hover:text-blue-600 inline-block border-b-2 mr-6 border-transparent hover:border-blue-600"><i class="fas fa-closed-captioning"></i> Subtitles</a></li>
            </ul>            
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden transition-all duration-300 ease-in-out">
            <ul class="mt-4 space-y-2">
                <li><a href="#" class="block text-gray-800 hover:text-blue-600 mb-8"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#" class="block text-gray-800 hover:text-blue-600 mb-8"><i class="fas fa-film"></i> Movies</a></li>
                <li><a href="#" class="block text-gray-800 hover:text-blue-600 mb-8"><i class="fas fa-tv"></i> TV Series</a></li>
                <li><a href="#" class="block text-gray-800 hover:text-blue-600 mb-8"><i class="fas fa-video"></i> Videos</a></li>
                <li><a href="#" class="block text-gray-800 hover:text-blue-600 mb-8"><i class="fas fa-closed-captioning"></i> Subtitles</a></li>
            </ul>
        </div>
    </nav>
</header>

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-200 py-4 mt-8">
    <div class="container mx-auto text-center">
        <p class="text-gray-600">Design And Developed By Blue Line Web Solutions &copy; 2024</p>
    </div>
</footer>

<!-- External JS -->
<script src="https://cdn.tutorialjinni.com/Glide.js/3.4.1/glide.js"></script>
<script src="https://cdn.tutorialjinni.com/Glide.js/3.4.1/glide.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

<script>
    document.getElementById('menu-btn').addEventListener('click', () => {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('block');
    });

    new Glide('.glide', {
        type: 'carousel',
        startAt: 0,
        perView: 1,
        autoplay: 5000,
        hoverpause: true,
        animationDuration: 500,
        animationTimingFunc: 'ease-in-out',
        gap: 0
    }).mount();
</script>

</body>
</html>
