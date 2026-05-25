<x-app-layout>
    <div class="h-[90vh] bg-gray-100 p-6">

        <div class="max-w-7xl mx-auto h-full bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="grid grid-cols-12 h-full">

                {{-- Sidebar --}}
                <div class="col-span-4 border-r bg-slate-50 p-5">

                    <h2 class="text-2xl font-bold mb-6">
                        💬 Realtime Chat
                    </h2>

                    <div class="space-y-3">
                        @foreach($users as $user)
                            <div class="bg-white p-4 rounded-xl shadow hover:bg-blue-50 cursor-pointer">

                                <div class="flex justify-between items-center">

                                    <div>
                                        <h3 class="font-semibold">
                                            {{ $user->name }}
                                        </h3>

                                        <p class="text-sm text-gray-400">
                                            Online
                                        </p>
                                    </div>

                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>

                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>

                {{-- Chat Area --}}
                <div class="col-span-8 flex flex-col">

                    <div class="p-5 border-b font-semibold text-lg">
                        Messages
                    </div>

                    <div class="flex-1 p-6 bg-gray-100 overflow-y-auto space-y-4">

                        @foreach($messages as $message)

                            <div class="bg-white rounded-xl p-4 shadow-sm">

                                <p class="font-semibold text-blue-600">
                                    {{ $message->sender->name ?? 'User' }}
                                </p>

                                <p class="text-gray-700 mt-2">
                                    {{ $message->message }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                    <div class="p-4 border-t bg-white">

                        <form action="{{ route('chat.send') }}" method="POST">
                            @csrf

                            <div class="flex gap-3">

                                <select
                                    name="receiver_id"
                                    class="border rounded-xl px-4 py-3"
                                    required
                                >
                                    <option value="">Pilih User</option>

                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>
                                    @endforeach

                                </select>

                                <input
                                    type="text"
                                    name="message"
                                    placeholder="Ketik pesan..."
                                    class="flex-1 border rounded-xl px-4 py-3"
                                    required
                                >

                                <button
                                    type="submit"
                                    class="bg-blue-500 text-white px-6 rounded-xl"
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