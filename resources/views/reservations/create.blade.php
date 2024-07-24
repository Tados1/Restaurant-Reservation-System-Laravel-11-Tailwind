<x-app-layout>

    @if (session('success'))
        @if (isset($availableTimes)) 
            <form action="{{ route('reservations.store')}}" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center bg-black/70 w-80 h-40 rounded-lg font-josefin">
                @csrf

                <p class="text-rose-500">{{ session('success') }}</p>

                <p class="text-white">All times available</p>
                
                <div>
                    <label for="start_time" class='text-white'>Select Time</label>
                    <select name="start_time" id="start_time" class="bg-black text-white rounded-lg focus:ring-rose-500 focus:border-rose-500">
                        @foreach($availableTimes as $hour) 
                            <option value="{{ $hour }}" class="checked:bg-rose-500">{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                

                <button class='text-rose-500 font-semibold pt-2'>Create Reservation</button>

                <input type="hidden" name="table_id" value="{{ $table_id }}">
            </form>
        @endif

        @if (isset($availableHours))
            <form action="{{ route('reservations.store')}}" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center bg-black/70 w-80 h-40 rounded-lg font-josefin">
                @csrf

                <p class="text-rose-500">{{ session('success') }}</p>

                <p class="text-white">The following times remain</p>
                
                <div>
                    <label for="start_time" class='text-white'>Select Time</label>
                    <select name="start_time" id="start_time" class="bg-black text-white rounded-lg focus:ring-rose-500 focus:border-rose-500">
                        @foreach($availableHours as $hour) 
                            <option value="{{ $hour }}" class="checked:bg-rose-500">{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>

                <button class='text-rose-500 font-semibold pt-2'>Create Reservation</button>

            </form>
        @endif
    @endif

    @if (session('failure'))
        <p class="text-white">{{ session('failure') }}</p>
        <a href="{{ route('guests-number') }}" class="text-green-300">Create a new reservation</a>
    @endif

  
    

</x-app-layout>