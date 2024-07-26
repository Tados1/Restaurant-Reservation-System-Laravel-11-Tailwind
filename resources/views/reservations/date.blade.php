<x-app-layout>
    <form action="{{ route('date')}}" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center bg-black/70 p-8 rounded-lg font-josefin md:text-2xl lg:text-4xl">
        @csrf

        @if (session('success'))
            <p class="text-rose-500 font-semibold text-center">{{ session('success') }}</p>
        @endif

        <label for="reservations" class='text-white p-2'>Select date:</label>
        <input type="date" name="date" id="date" required min="{{ now()->toDateString() }}" max="{{ now()->addDays(7)->toDateString() }}" />

        <button class='text-rose-500 font-semibold pt-5'>Next &rarr;</button>
    </form>
</x-app-layout>