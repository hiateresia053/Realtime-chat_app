<x-app-layout>
    <div class="h-[90vh] bg-gray-100 p-6">

        <div class="max-w-7xl mx-auto h-full bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="grid grid-cols-12 h-full">

                <!-- Sidebar User -->
                <div class="col-span-4 border-r bg-slate-50 p-5">

                    <h2 class="text-2xl font-bold mb-6">
                        💬 Realtime Chat
                    </h2>

                    <div class="space-y-3">

                        @foreach($users as $user)

                            @if($user->id !== auth()->id())

                                <a
    href="{{ route('chat.user', $user->id) }}"
    class="block bg-white p-4 rounded-xl shadow-sm hover:bg-blue-50 cursor-pointer transition"
>
                                    <div class="flex items-center justify-between">

                                        <div>
                                            <h3 class="font-semibold text-gray-800">
                                                {{ $user->name }}
                                            </h3>

                                            <p class="text-sm text-gray-400">
    {{ $user->last_seen && $user->last_seen->gt(now()->subMinutes(2)) ? 'Online' : 'Offline' }}
</p>

<span
    class="w-3 h-3 rounded-full
    {{ $user->last_seen && $user->last_seen->gt(now()->subMinutes(2))
        ? 'bg-green-500'
        : 'bg-gray-400' }}">
</span>
                                    </div>

                                </a>

                            @endif

                        @endforeach

                    </div>
                </div>

                <!-- Chat Area -->
                <div class="col-span-8 flex flex-col">

                    <!-- Header -->
                    <div class="border-b px-6 py-4 bg-white font-semibold text-lg">
                        Messages
                    </div>

                    <!-- Message List -->
                    <div class="flex-1 overflow-y-auto p-6 bg-gray-100 space-y-4">

                        @foreach($messages as $message)

                            <div
                                class="{{ $message->sender_id === auth()->id() ? 'text-right' : 'text-left' }}"
                            >

                                <div
                                    class="inline-block px-4 py-3 rounded-2xl max-w-md
                                    {{ $message->sender_id === auth()->id()
                                        ? 'bg-blue-500 text-white'
                                        : 'bg-white text-gray-800 shadow-sm' }}"
                                >

                                    <p class="text-sm font-semibold mb-1">
                                        {{ $message->sender->name }}
                                    </p>

                                    <p>
                                        {{ $message->message }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    <!-- Form Input -->
                    <div class="p-4 bg-white border-t">

                        <form action="{{ route('chat.store') }}" method="POST">

                            @csrf

                            <div class="flex gap-3">

                                <input
                                    type="text"
                                    name="message"
                                    placeholder="Ketik pesan..."
                                    class="flex-1 border rounded-xl px-4 py-3 focus:outline-none"
                                    required
                                >

                                <button
                                    type="submit"
                                    class="bg-blue-500 text-white px-6 rounded-xl hover:bg-blue-600"
                                >
                                    Kirim
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>