<div>
    <div x-data class="calendar">
        <div class="flex flex-col w-full px-10">
            <div class="flex justify-between mb-4">
                <button @click="month--; $wire.previousMonth()" <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="text-lg font-medium">
                    {{ $calendar[0]['date']->format('F Y') }}
                </span>
                <button @click="month++; $wire.nextMonth()" <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="w-full px-10 bg-blue-500 text-white grid grid-cols-7 gap-1">
            <div class="col-span-1 flex flex-col items-center justify-center p-2">
                <div class="text-sm font-medium uppercase">
                    Sunday
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center justify-center p-2">
                <div class="text-sm font-medium uppercase">
                    Monday
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center justify-center p-2">
                <div class="text-sm font-medium uppercase">
                    Tuesday
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center justify-center p-2">
                <div class="text-sm font-medium uppercase">
                    Wednesday
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center justify-center p-2">
                <div class="text-sm font-medium uppercase">
                    Thursday
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center justify-center p-2">
                <div class="text-sm font-medium uppercase">
                    Friday
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center justify-center p-2">
                <div class="text-sm font-medium uppercase">
                    Saturday
                </div>
            </div>
        </div>

        <div class="grid grid-cols-7 gap-1 border-collapse">
            @foreach ($calendar as $day)
                <div class="col-span-1 flex flex-col items-center justify-center p-4">
                    
                    <div class="font-bold @if ($day['date']->isToday()) bg-red-500 p-2 rounded-full text-white @endif">
                        {{ $day['date']->format('j') }}
                    </div> 
                
                    @foreach ($day['events'] as $event)
                        <div class="text-sm text-center mt-2">
                            <div class="text-red-400 font-bold">{{ $event->name }}</div>
                            <div class="text-red-400 font-bold">{{ $event->location->name }}</div>
                            {{-- <div class="text-gray-600">{{ $event->description }}</div> --}}
                            {{-- <div class="text-gray-600">{{ $event->location }}</div> --}}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
