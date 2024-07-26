<x-app-layout>
    @if (session('success'))
        @if ((!isset($availableTimes) || count($availableTimes) <= 0) && (!isset($remainingHours) || count($remainingHours) <= 0))
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-black/70 rounded-lg font-josefin">
                <p class="text-rose-500 text-center text-2xl p-4">All times are booked. Please choose another date or check back later.</p>
            </div>
        @else
            <form action="{{ route('reservations.store')}}" method="post" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col justify-center items-center bg-black/70 rounded-lg font-josefin p-8 text-center md:text-2xl lg:text-4xl">
                @csrf

                <p class="text-rose-500">{{ session('success') }}</p>

                <p class="text-slate-300 py-2 md:text-lg">{{ session('availability') }}</p>
                
                <div>
                    <label for="start_time" class='text-white'>Select Time</label>
                    <select name="start_time" id="start_time" class="bg-black text-white rounded-lg focus:ring-rose-500 focus:border-rose-500">
                        @if (isset($availableTimes) && count($availableTimes) > 0) 
                            @foreach($availableTimes as $hour) 
                                <option value="{{ $hour }}" class="checked:bg-rose-500">{{ $hour }}</option>
                            @endforeach
                        @elseif (isset($remainingHours) && count($remainingHours) > 0)
                            @foreach($remainingHours as $hour) 
                                <option value="{{ $hour }}" class="checked:bg-rose-500">{{ $hour }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <button class='text-rose-500 font-semibold pt-4'>Create Reservation</button>

                @if (isset($availableTimes) && count($availableTimes) > 0) 
                    <input type="hidden" name="table_id" value="{{ $table_id }}">
                @endif
            </form>
        @endif
    @endif

    @if (session('failure'))
        <p class="text-white">{{ session('failure') }}</p>
        <a href="{{ route('guests-number') }}" class="text-green-300">Create a new reservation</a>
    @endif
</x-app-layout>