<x-app-layout>

    @if (session('delete'))
        <div class="bg-black/70 rounded-b-lg font-josefin">
            <p class="text-rose-500 text-center text-2xl p-4">{{ session('delete') }}</p>
        </div>
    @endif

    <div class="flex flex-col justify-center items-center mt-24">
        @foreach ($reservations as $reservation)
            <div class="gap-2 flex flex-col justify-center items-center m-4 bg-black/70 w-80 h-40 rounded-lg font-josefin text-white">
                <div class="flex justify-center items-center gap-2">
                    <x-reservations-icon class="w-6 h-6"/>
                    <p>{{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y') }}</p>
                </div>
               
                <div class="flex justify-center items-center gap-2">
                    <x-time class="w-6 h-6"/>
                    <p>{{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}</p>
                </div>
              

                <form action="{{ route('reservations.destroy', $reservation) }}" method="post" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 mt-2 bg-red-500 rounded-lg hover:bg-red-800 transition duration-500">Delete</button>
                </form>
            </div>
        @endforeach

        <div>
            {{ $reservations->links() }}
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this reservation?');
        }
    </script>
   

</x-app-layout>

