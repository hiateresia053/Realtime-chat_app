<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-emerald-100 py-10 px-6">

    <div class="max-w-6xl mx-auto">

        {{-- Welcome Card --}}
        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                Welcome 👋
            </h1>

            <p class="text-gray-600 text-lg">
                Haiii, 😊 {{ Auth::user()->name }}.
                Selamat datang di aplikasi chat <span class="font-semibold text-green-600">NgobrolYuk</span>.
            </p>
        </div>


        {{-- Menu Card --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Mulai Chat --}}
            <div class="bg-white rounded-3xl p-8 shadow hover:shadow-xl transition">
                <div class="text-5xl mb-4">💬</div>

                <h2 class="text-3xl font-semibold mb-3">
                    Mulai Chat
                </h2>

                <p class="text-gray-500 mb-6">
                    Masuk ke halaman percakapan dan mulai mengirim pesan.
                </p>

                <a href="{{ route('chat') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl inline-block">
                    Buka Chat
                </a>
            </div>


            {{-- Profile --}}
            <div class="bg-white rounded-3xl p-8 shadow hover:shadow-xl transition">
                <div class="text-5xl mb-4">👤</div>

                <h2 class="text-3xl font-semibold mb-3">
                    Profile
                </h2>

                <p class="text-gray-500 mb-6">
                    Kelola akun dan data profile pengguna.
                </p>

                <a href="{{ route('profile.edit') }}"
                   class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl inline-block">
                    Edit Profile
                </a>
            </div>


            {{-- Group Chat --}}
            <div class="bg-green-500 text-white rounded-3xl p-8 shadow hover:shadow-xl transition">
                <div class="text-5xl mb-4">👥</div>

                <h2 class="text-3xl font-semibold mb-3">
                    Group Chat
                </h2>

                <p class="opacity-90 mb-6">
                    Buat dan gabung ke group chat realtime.
                </p>

                <a href="{{ route('chat') }}"
                   class="bg-white text-green-600 font-semibold px-6 py-3 rounded-xl inline-block">
                    Buka Group
                </a>
            </div>

        </div>


        {{-- Logout --}}
        <div class="bg-white rounded-3xl shadow mt-8 p-8 w-full md:w-1/3">

            <div class="text-5xl mb-4">🚪</div>

            <h2 class="text-3xl font-semibold mb-2">
                Logout
            </h2>

            <p class="text-gray-500 mb-6">
                See you later...
            </p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl">
                    Logout
                </button>
            </form>

        </div>

    </div>
</div>
</x-app-layout>