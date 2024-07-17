@extends('front-end.layouts.app')

@section('content')
<div class="hidden sm:flex justify-center  text-white py-2">
    <div class="flex justify-center gap-4">
        <div class="bg-gray-200 w-1/2 h-40">
            <img src="https://cdn.gadgets360.com/content/assets/latest-telugu-movie-banner-1200x400.jpg" alt="Image 1" class="object-cover w-full h-full">
        </div>
        <div class="bg-gray-200 w-1/2 h-40">
            <img src="https://cdn.gadgets360.com/content/assets/latest-telugu-movie-banner-1200x400.jpg" alt="Image 2" class="object-cover w-full h-full">
        </div>
        <div class="bg-gray-200 w-1/2 h-40">
            <img src="https://cdn.gadgets360.com/content/assets/latest-telugu-movie-banner-1200x400.jpg" alt="Image 2" class="object-cover w-full h-full">
        </div>
    </div>
</div>
<div class="bg-gray-100">
    <div class="container mx-auto px-4 p-4 flex">
        <div class="hidden sm:block w-1/6">
            <div class="text-white text-center py-2 pr-4">
                <div class="mb-4">
                    <img src="https://static.digit.in/OTT/v2/images/love-today-930119.jpg" alt="Image 1" class="w-full h-300 object-cover mb-2 rounded-lg">
                    <img src="https://static.digit.in/OTT/v2/images/love-today-930119.jpg" alt="Image 2" class="w-full h-300 object-cover mb-2 rounded-lg">
                    <img src="https://static.digit.in/OTT/v2/images/love-today-930119.jpg" alt="Image 3" class="w-full h-300 object-cover rounded-lg">
                </div>
            </div>
        </div>
        <div class="w-full sm:w-2/3">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">{{ $downloadLink->title }}</h1>
                <div class="flex items-center mb-4">
                    <img src="{{ asset('storage/' . $downloadLink->image) }}" alt="{{ $downloadLink->title }}" class="w-32 h-auto rounded-lg">
                    <div class="ml-4">
                        <p class="text-lg sm:text-xl font-semibold text-gray-800">{{ $downloadLink->title }}</p>
                        <p class="text-sm text-gray-600">{{ $downloadLink->description }}</p>
                    </div>
                </div>
                
                {{-- <h2 class="text-xl sm:text-2xl font-bold mb-2">Types:</h2>
                <ul class="flex flex-wrap gap-2 mb-4">
                    @foreach ($downloadLink->types as $type)
                        <li class="bg-blue-500 text-white py-1 px-3 rounded-lg text-sm">{{ $type->type }}</li>
                    @endforeach
                </ul> --}}
                
                <h2 class="text-xl sm:text-2xl font-bold mb-2 mt-4">Subtitles:</h2>
                    <div class="space-y-4">
                        <div class="border shadow-lg rounded-lg p-4">
                            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
                                <div class="w-full md:w-1/3">
                                    <select id="language-select" class="w-full border border-gray-300 rounded-md py-2 px-3">
                                        <option value="en">English</option>
                                        <option value="ta">Tamil</option>
                                        <option value="sg">Sungala</option>
                                        <option value="fr">French</option>
                                        <option value="de">German</option>
                                        <option value="es">Spanish</option>
                                        <option value="jp">Japanese</option>                                        
                                    </select>
                                </div>
                                <div class="w-full md:w-1/3">
                                    <a id="download-link" href="#" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md transition duration-300 w-full text-center">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- <div class="mb-4">
                    @foreach ($downloadLink->subtitles as $subtitle)
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <div class="ml-4 flex gap-2">
                                <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2">
                                    <i class="fas fa-download mr-1"></i> Tamil
                                </a>
                                <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2">
                                    <i class="fas fa-download mr-1"></i> English
                                </a>
                                <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-2 mb-2">
                                    <i class="fas fa-download mr-1"></i> Sinhala
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                 --}}
                <h2 class="text-xl sm:text-2xl font-bold mb-2 mt-4">Download Links:</h2>
                <div class="space-y-4">
                    @foreach ($downloadLink->types as $type)
                        <div class="border shadow-lg rounded-lg p-4">
                            <h3 class="text-lg font-bold mb-4 text-center">{{ $type->type }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach ($type->links as $link)
                                    <div class="border border-blue-500 rounded-md p-2 flex items-center justify-center">
                                        <a href="{{ $link->url }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition duration-300 w-full text-center">
                                            <i class="fas fa-download mr-1"></i> {{ $link->link_type }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                
                
            </div>
        </div>
        <div class="hidden sm:block w-1/6">
            <div class="text-white text-center py-2 pl-4">
                <div class="mb-4">
                    <img src="https://static.moviecrow.com/gallery/20240411/228242-Ghilli%20Rerelease%20Vijay%20April%2020%202024.jpg" alt="Image 1" class="w-full h-300 object-cover mb-2 rounded-lg">
                    <img src="https://static.moviecrow.com/gallery/20240411/228242-Ghilli%20Rerelease%20Vijay%20April%2020%202024.jpg" alt="Image 2" class="w-full h-300 object-cover mb-2 rounded-lg">
                    <img src="https://static.moviecrow.com/gallery/20240411/228242-Ghilli%20Rerelease%20Vijay%20April%2020%202024.jpg" alt="Image 3" class="w-full h-300 object-cover rounded-lg">
                </div>
            </div>
        </div>
        
    </div>
    <div class="hidden sm:flex justify-center  text-white py-2">
        <div class="flex justify-center gap-4">
            <div class="bg-gray-200 w-1/2 h-40">
                <img src="https://cdn.gadgets360.com/content/assets/latest-telugu-movie-banner-1200x400.jpg" alt="Image 1" class="object-cover w-full h-full">
            </div>
            <div class="bg-gray-200 w-1/2 h-40">
                <img src="https://cdn.gadgets360.com/content/assets/latest-telugu-movie-banner-1200x400.jpg" alt="Image 2" class="object-cover w-full h-full">
            </div>
            <div class="bg-gray-200 w-1/2 h-40">
                <img src="https://cdn.gadgets360.com/content/assets/latest-telugu-movie-banner-1200x400.jpg" alt="Image 2" class="object-cover w-full h-full">
            </div>
        </div>
    </div>
    <!-- Grid Section for New TV Series -->
<div class="container mx-auto px-4">
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-center my-4">Downloads</h1>
    <section class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 p-4">
        @foreach ($downloadLinks->take(5) as $downloadLink)
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

</div>
@endsection
