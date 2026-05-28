<x-app-layout>
<div class="h-[calc(100vh-80px)] bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto h-full">
        <div class="bg-white rounded-2xl shadow h-full flex overflow-hidden">

            {{-- Sidebar --}}
            <div class="w-1/3 border-r bg-gray-50 flex flex-col">

                <div class="p-4 border-b">
                    <h2 class="text-xl font-bold">Realtime Chat</h2>
                </div>

                <div class="flex-1 overflow-y-auto p-4">

                    {{-- Users --}}
                    <h3 class="text-gray-500 font-semibold mb-3">Users</h3>

                    @foreach($users as $user)
<a href="{{ route('chat.user', $user->id) }}"
   class="block bg-white rounded-xl p-4 mb-3 shadow hover:bg-green-50">

    <div class="flex items-center justify-between">

        <div>
            <div class="font-semibold text-gray-800">
                {{ $user->name }}
            </div>

            <div class="text-sm text-gray-400">
                {{ $user->is_online ? 'Online' : 'Offline' }}
            </div>
        </div>

        <div class="w-3 h-3 rounded-full
            {{ $user->is_online ? 'bg-green-500' : 'bg-gray-400' }}">
        </div>

    </div>
</a>
@endforeach

                    {{-- Groups --}}
                    <h3 class="text-gray-500 font-semibold mt-6 mb-3">Groups</h3>

                    @foreach($groups as $group)
                        <a href="{{ route('chat.group', $group->id) }}"
                           class="block bg-green-100 rounded-xl p-4 mb-3 hover:bg-green-200">
                            👥 {{ $group->name }}
                        </a>
                    @endforeach

                </div>
            </div>

            {{-- Chat Area --}}
            <div class="w-2/3 flex flex-col">

                {{-- Header --}}
                <div class="p-4 border-b bg-white">
                    @if($selectedUser)
                        <h2 class="font-bold text-lg">
                            Chat dengan {{ $selectedUser->name }}
                        </h2>
                    @elseif($selectedGroup)
                        <h2 class="font-bold text-lg">
                            Group: {{ $selectedGroup->name }}
                        </h2>
                    @else
                        <h2 class="font-bold text-lg text-gray-400">
                            Pilih chat terlebih dahulu
                        </h2>
                    @endif
                </div>

                {{-- Messages --}}
                <div class="flex-1 overflow-y-auto p-6 bg-gray-100 space-y-4">

                    @forelse($messages as $message)

                        <div class="@if($message->sender_id == auth()->id()) text-right @endif">

                            <div class="inline-block px-4 py-3 rounded-2xl max-w-md
                                @if($message->sender_id == auth()->id())
                                    bg-green-500 text-white
                                @else
                                    bg-white shadow
                                @endif">

                                <div class="text-sm font-semibold mb-1">
                                    {{ $message->sender->name }}
                                </div>

                                <div>
                                    {{ $message->message }}
                                </div>
                            </div>

                        </div>

                    @empty

                        <div class="text-center text-gray-400 mt-10">
                            Belum ada pesan
                        </div>

                    @endforelse

                </div>

                {{-- Form Input --}}
                @if($selectedUser || $selectedGroup)
                <div class="border-t bg-white p-4">
                    <form action="{{ route('chat.send') }}" method="POST" class="flex gap-3">
                        @csrf

                        @if($selectedUser)
                            <input type="hidden" name="receiver_id" value="{{ $selectedUser->id }}">
                        @endif

                        @if($selectedGroup)
                            <input type="hidden" name="group_id" value="{{ $selectedGroup->id }}">
                        @endif

                        <input
                            type="text"
                            name="message"
                            placeholder="Ketik pesan..."
                            class="flex-1 border rounded-xl px-4 py-3 focus:outline-none focus:ring focus:ring-green-200"
                            required
                        >

                        <button
                            type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 rounded-xl"
                        >
                            Kirim
                        </button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
</x-app-layout>