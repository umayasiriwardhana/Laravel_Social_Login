<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Google To-Dos') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-[60vh]">
        <table class="min-w-full max-w-lg bg-gray-900 border border-gray-700 text-white">
            <thead>
                <tr class="bg-gray-800">
                    <th class="py-2 px-4 border-b border-gray-600 text-white">Task</th>
                    <th class="py-2 px-4 border-b border-gray-600 text-white">Status</th>
                    <th class="py-2 px-4 border-b border-gray-600 text-white">Due Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-6 px-4 text-white text-center" colspan="3">No to-dos found.</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
