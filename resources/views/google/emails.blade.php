<x-app-layout>
    {{-- Removed header slot to remove the "Latest Emails" headline --}}

    <div class="container mx-auto py-6 text-white">
        {{-- Removed h2 headline for Latest Emails --}}

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-900 border border-gray-700 text-white">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="py-2 px-4 border-b border-gray-600 text-white">From</th>
                        <th class="py-2 px-4 border-b border-gray-600 text-white">Subject</th>
                        <th class="py-2 px-4 border-b border-gray-600 text-white">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($emails as $email)
                        <tr class="border-b border-gray-700">
                            <td class="py-2 px-4">{{ $email['from'] ?? '-' }}</td>
                            <td class="py-2 px-4">{{ $email['subject'] ?? 'No Subject' }}</td>
                            <td class="py-2 px-4">{{ $email['date'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-white">No emails found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
