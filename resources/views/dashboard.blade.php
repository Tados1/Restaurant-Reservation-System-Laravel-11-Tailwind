<x-app-layout>

    @if (session('success'))
        <p class="text-rose-500 text-2xl text-center m-4">{{ session('success') }}</p>
    @endif

    <div class="w-full h-full flex flex-col justify-center items-center xl:flex-row xl:mt-11">
            <a href="{{ route('guests-number') }}" class="text-white font-josefin text-2xl flex flex-col justify-center items-center bg-black/70 m-8 p-8 rounded-lg w-[300px] sm:w-[400px] sm:h-[350px]">
                Create a reservation
                <x-create-reservation-icon class="w-40 h-40"/>
            </a>
        
            <a href="{{ route('reservations.index') }}" class="text-white font-josefin text-2xl flex flex-col justify-center items-center bg-black/70 m-8 p-8 rounded-lg w-[300px] sm:w-[400px] sm:h-[350px]">
                Check Reservations
                <x-reservations-icon class="w-40 h-40"/>
            </a>
    </div>
    
</x-app-layout>