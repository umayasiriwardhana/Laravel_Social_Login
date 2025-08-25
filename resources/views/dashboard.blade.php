<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Logged in card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You're logged in!
                </div>
            </div>

            <!-- Google Integration Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Google Calendar -->
                <a href="{{ route('google.calendar') }}"
                   class="bg-gray-800 hover:bg-indigo-700 p-6 rounded-xl border border-gray-700 hover:border-indigo-500 transition-all shadow-sm hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-white mb-2">Google Calendar Events</h3>
                    <p class="text-sm text-gray-300">View your upcoming events synced from your Google Calendar.</p>
                </a>

                <!-- Gmail -->
                <a href="{{ route('google.emails') }}"
                   class="bg-gray-800 hover:bg-pink-700 p-6 rounded-xl border border-gray-700 hover:border-pink-500 transition-all shadow-sm hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-white mb-2">Latest Emails</h3>
                    <p class="text-sm text-gray-300">Access your most recent Gmail messages directly here.</p>
                </a>

                <!-- Google Tasks -->
                <a href="{{ route('google.todos') }}"
                   class="bg-gray-800 hover:bg-green-700 p-6 rounded-xl border border-gray-700 hover:border-green-500 transition-all shadow-sm hover:shadow-lg">
                    <h3 class="text-lg font-semibold text-white mb-2">Google To-Dos</h3>
                    <p class="text-sm text-gray-300">Manage your Google Tasks and keep track of your to-dos.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
