<x-app-layout>
    @if (session('failure'))
        <p class="font-josefin font-bold text-rose-500 text-2xl text-center mt-8">{{ session('failure') }}</p>
    @else
        <form action="{{ route('date')}}" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center bg-black/70 w-80 h-40 rounded-lg font-josefin">
            @csrf

            @if (session('success'))
                <p class="text-rose-500 font-semibold pt-2">{{ session('success') }}</p>
            @endif

            <label for="reservations" class='text-white p-2'>Select date:</label>
            <input type="date" name="date" id="date" required min="{{ now()->toDateString() }}" max="{{ now()->addDays(7)->toDateString() }}" />

            <button class='text-rose-500 font-semibold pt-5'>Next &rarr;</button>
        </form>
    @endif
</x-app-layout>