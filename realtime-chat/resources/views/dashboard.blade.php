<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h1 class="text-3xl font-bold mb-2">
                    Welcome 👋
                </h1>

                <p class="text-gray-600">
                    Hai {{ Auth::user()->name }}, selamat datang di aplikasi chat realtime.
                </p>
            </div>

            <!-- Menu Card -->
            <div class="grid md:grid-cols-3 gap-6 mb-6">

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Mulai Chat</h3>
                    <p class="text-gray-600 mb-4">
                        Kirim pesan realtime dengan user lain.
                    </p>

                    <a href="#chat-box"
                       class="bg-blue-500 text-white px-4 py-2 rounded">
                        Buka Chat
                    </a>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Profile</h3>
                    <p class="text-gray-600">
                        Kelola akun pengguna.
                    </p>
                </div>

                <div class="bg-green-500 text-white shadow rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Group Chat</h3>
                    <p>
                        Buat dan gabung ke percakapan realtime.
                    </p>
                </div>

            </div>

            <!-- Chat Section -->
            <div id="chat-box" class="bg-white shadow rounded-lg p-6">
                @include('chat')
            </div>

        </div>
    </div>
</x-app-layout>