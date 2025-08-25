<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-white leading-tight">
            Upcoming Events
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg rounded-2xl overflow-hidden border border-blue-900">

                @if(count($events) > 0)
                    <table class="min-w-full divide-y divide-gray-700 text-white">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                    Event
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                    Start
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">
                                    End
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($events as $event)
                                <tr class="hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ $event['summary'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ \Carbon\Carbon::parse($event['start'])->format('Y-m-d H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        {{ \Carbon\Carbon::parse($event['end'])->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-white p-6 text-center">
                        No events found.
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
