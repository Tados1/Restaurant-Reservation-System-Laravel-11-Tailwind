<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('APP_NAME') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-black/90 h-full">
        <header>   
            <div class="relative">
                <nav class="absolute top-0 right-0 z-10 p-2 md:p-4">
                    <ul class="flex justify-end items-center gap-1 xl:gap-3">
                        <li class="nav-link">
                            <a href="{{ route('login') }}">Log in</a>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                </nav>

                <img 
                    src="{{ asset('images/restaurant.jpg') }}" 
                    alt="AI-generated Restaurant Image"
                    class="w-full bg-i md:h-[300px] lg:h-[400px] xl:h-[450px] 2xl:h-[550px]"
                >

                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                    <h1 class="text-rose-500 text-2xl font-josefin font-bold md:text-4xl">Restaurant Tado</h1>
                    <p class="text-xl font-moderne text-slate-300 md:text-2xl xl:text-4xl">We eagerly await your visit!</p>

                    @if($hours)
                        <div class="flex justify-center items-center gap-2 mt-4 text-xl font-josefin text-slate-300 md:text-2xl xl:text-4xl xl:mt-8">
                            <x-opening-hours-logo class="w-8 h-8 xl:w-12 xl:h-12"/>
                            <p>{{ $hours['from_hour'] }} - {{ $hours['to_hour'] }}</p>
                        </div>
                    @else
                        <p>Opening hours are not available.</p>
                    @endif
                </div>
            </div>
        </header>

        <main>
            <div class="w-full flex justify-center items-center p-8">
                <p class="font-josefin text-slate-300 mr-4 md:text-xl xl:text-2xl 2xl:text-4xl">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore quibusdam vel ab debitis possimus officia aut officiis, pariatur cum animi, sunt molestiae hic quod? Reiciendis distinctio dolor quasi autem rerum.</p>

                <img 
                    src="{{ asset('images/patio.jpg') }}" 
                    alt="AI-generated Restaurant Patio Image"
                    class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/3"
                >
            </div>

            <div class="w-full flex justify-center items-center p-8">
                <img 
                    src="{{ asset('images/food.png') }}" 
                    alt="AI-generated Seafood Image"
                    class="w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/3"
                >
                <p class="font-josefin text-slate-300 ml-4 md:text-xl xl:text-2xl 2xl:text-4xl">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore quibusdam vel ab debitis possimus officia aut officiis, pariatur cum animi, sunt molestiae hic quod? Reiciendis distinctio dolor quasi autem rerum.</p>
            </div>

        </main>
    </body>
</html>