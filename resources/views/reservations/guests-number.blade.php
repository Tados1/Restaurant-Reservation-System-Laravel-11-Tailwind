<x-app-layout>

    @if(session('failure'))
        <div class="w-64 h-32 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center font-josefin bg-black/70 rounded-lg text-center">
            <p class="text-white p-2">{{ session('failure') }}</p>
            <a href="{{ route('guests-number')}}" class="text-white bg-rose-500 px-4 rounded-lg">&larr; Back</a>
        </div>
    @else
        <form action="{{ route('guests-number')}}" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center bg-black/70 w-80 h-40 rounded-lg font-josefin">
            @csrf

            <div class="">
                <label for="reservations" class='text-white'>Number of guests:</label>
                <input type="number" min="1" max="6" name="number" required class="bg-black text-white rounded-md ml-4"/>
            </div>

            <button class='text-rose-500 font-semibold pt-5'>Next &rarr;</button>
        </form>
    @endif

</x-app-layout>