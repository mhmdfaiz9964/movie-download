@extends('front-end.layouts.app')

@section('content')
<!-- Image Carousel -->
<div class="container mx-auto px-4 p-4 h-30">
    <div id="default-carousel" class="glide">
        <!-- Carousel wrapper -->
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <li class="glide__slide">
                    <img src="https://www.91-cdn.com/pricebaba-blogimages/wp-content/uploads/2022/09/New-Tamil-Movies-on-OTT.png" alt="Slider Image 1" class="w-full h-auto rounded-lg">
                </li>
                <!-- Item 2 -->
                <li class="glide__slide">
                    <img src="https://i.ytimg.com/vi/sRJICIeGFPs/maxresdefault.jpg" alt="Slider Image 2" class="w-full h-auto">
                </li>
                <!-- Item 3 -->
                <li class="glide__slide">
                    <img src="https://www.91-cdn.com/pricebaba-blogimages/wp-content/uploads/2022/09/New-Tamil-Movies-on-OTT.png" alt="Slider Image 3" class="w-full h-auto rounded-lg">
                </li>
                <!-- Item 4 -->
                <li class="glide__slide">
                    <img src="https://www.91-cdn.com/pricebaba-blogimages/wp-content/uploads/2022/09/New-Tamil-Movies-on-OTT.png" alt="Slider Image 4" class="w-full h-auto rounded-lg">
                </li>
                <!-- Item 5 -->
                <li class="glide__slide">
                    <img src="https://www.91-cdn.com/pricebaba-blogimages/wp-content/uploads/2022/09/New-Tamil-Movies-on-OTT.png" alt="Slider Image 5" class="w-full h-auto rounded-lg">
                </li>
            </ul>
        </div>

        <!-- Slider indicators -->
        <div class="glide__bullets" data-glide-el="controls[nav]">
            <button class="glide__bullet" data-glide-dir="=0"></button>
            <button class="glide__bullet" data-glide-dir="=1"></button>
            <button class="glide__bullet" data-glide-dir="=2"></button>
            <button class="glide__bullet" data-glide-dir="=3"></button>
            <button class="glide__bullet" data-glide-dir="=4"></button>
        </div>

        <!-- Slider controls -->
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i class="fas fa-arrow-left"></i></button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i class='fas fa-arrow-right'></i></button>
        </div>
    </div>
</div>

<!-- Grid Section for New Movies -->
<div class="container mx-auto px-4">
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-center my-4">New Movies</h1>
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 p-4">
        @foreach ($downloadLinks as $downloadLink)
        <div class="bg-white rounded-lg shadow-md">
            <img src="{{ asset('storage/' . $downloadLink->image) }}" alt="{{ $downloadLink->title }}" class="w-full h-auto rounded-t-lg">
            <div class="p-4">
                <h2 class="text-lg font-semibold mb-2">{{ $downloadLink->title }}</h2>
                <a href="{{ route('download-links.show', ['id' => $downloadLink->id]) }}" class="block w-full bg-white border border-blue-500 text-blue-500 py-2 px-4 rounded-md text-center text-sm hover:bg-blue-500 hover:text-white hover:border-blue-600 flex items-center justify-center">
                    <span class="mr-2">Download</span>
                    <i class="fas fa-download"></i>
                </a>
            </div>
        </div>
        @endforeach
    </section>
</div>

<!-- Grid Section for New TV Series -->
<div class="container mx-auto px-4">
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-center my-4">New TV Series</h1>
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 p-4">
        @foreach ($downloadLinks as $downloadLink)
        <div class="bg-white rounded-lg shadow-md">
            <img src="{{ asset('storage/' . $downloadLink->image) }}" alt="{{ $downloadLink->title }}" class="w-full h-auto rounded-t-lg">
            <div class="p-4">
                <h2 class="text-lg font-semibold mb-2">{{ $downloadLink->title }}</h2>
                <a href="{{ route('download-links.show', ['id' => $downloadLink->id]) }}" class="block w-full bg-white border border-blue-500 text-blue-500 py-2 px-4 rounded-md text-center text-sm hover:bg-blue-500 hover:text-white hover:border-blue-600 flex items-center justify-center">
                    <span class="mr-2">Download</span>
                    <i class="fas fa-download"></i>
                </a>
            </div>
        </div>
        @endforeach
    </section>
</div>
@endsection

@section('scripts')
<!-- Glide.js JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/glide.min.js"></script>
<script>
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
@endsection