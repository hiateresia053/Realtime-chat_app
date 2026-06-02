<x-app-layout>
<div class="h-[calc(100vh-80px)] bg-gradient-to-br from-green-100 via-white to-emerald-100 p-6">
    <div class="max-w-7xl mx-auto h-full">
        <div class="backdrop-blur-lg bg-white/80 border border-white/40 rounded-3xl shadow-2xl h-full flex overflow-hidden">

            {{-- Sidebar --}}
            <div class="w-1/3 bg-white/70 border-r flex flex-col">

                <div class="p-5 border-b bg-green-500 text-white">
                    <h2 class="text-2xl font-bold">💬 Realtime Chat</h2>
                    <p class="text-sm opacity-90">Laravel Web Chat App</p>
                </div>

                <div class="flex-1 overflow-y-auto p-4">

                    <h3 class="text-gray-500 text-sm font-semibold uppercase mb-3">Users</h3>

                    @foreach($users as $user)
                    <a href="{{ route('chat.user', $user->id) }}"
                       class="flex items-center gap-3 p-4 mb-3 rounded-2xl bg-white shadow-sm hover:shadow-md hover:bg-green-50 transition duration-200">

                        {{-- Avatar --}}
                        <div class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center font-bold text-lg">
                            {{ strtoupper(substr($user->name,0,1)) }}
                        </div>

                        <div class="flex-1">
                            <div class="font-semibold text-gray-800">
                                {{ $user->name }}
                            </div>

                            <div class="text-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ $user->is_online ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                <span class="text-gray-500">
                                    {{ $user->is_online ? 'Online' : 'Offline' }}
                                </span>
                            </div>
                        </div>

                    </a>
                    @endforeach

                    {{-- Group --}}
                    <h3 class="text-gray-500 text-sm font-semibold uppercase mt-6 mb-3">Groups</h3>

                    @foreach($groups as $group)
                    <a href="{{ route('chat.group', $group->id) }}"
                       class="block p-4 rounded-2xl bg-emerald-100 hover:bg-emerald-200 transition mb-3 font-medium text-gray-700 shadow-sm">
                        👥 {{ $group->name }}
                    </a>
                    @endforeach

                </div>
            </div>

            {{-- Chat Area --}}
            <div class="w-2/3 flex flex-col">

                {{-- Header --}}
                <div class="p-5 border-b bg-white/70 backdrop-blur">
                    @if($selectedUser)
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-full bg-green-500 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr($selectedUser->name,0,1)) }}
                            </div>

                            <div>
                                <h2 class="font-bold text-lg">{{ $selectedUser->name }}</h2>
                                <p class="text-sm text-gray-500">
                                    {{ $selectedUser->is_online ? '🟢 Online' : '⚫ Offline' }}
                                </p>
                            </div>
                        </div>

                    @elseif($selectedGroup)
                        <h2 class="font-bold text-lg">
                            👥 {{ $selectedGroup->name }}
                        </h2>

                    @else
                        <h2 class="font-bold text-lg text-gray-400">
                            Pilih chat terlebih dahulu
                        </h2>
                    @endif
                </div>

                {{-- Messages --}}
                <div id="chat-box" class="flex-1 overflow-y-auto p-6 bg-gradient-to-b from-gray-50 to-green-50 space-y-4">

                    @forelse($messages as $message)

                    <div class="@if($message->sender_id == auth()->id()) text-right @endif">

                        <div class="inline-block px-5 py-3 rounded-2xl max-w-md shadow
                        @if($message->sender_id == auth()->id())
                            bg-green-500 text-white
                        @else
                            bg-white text-gray-800
                        @endif">

                            <div class="text-xs font-semibold mb-1 opacity-80">
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

                {{-- Input --}}
                @if($selectedUser || $selectedGroup)
                <div class="p-4 bg-white border-t">
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
                            placeholder="Tulis pesan..."
                            class="flex-1 border-0 rounded-full px-5 py-3 bg-gray-100 focus:ring-2 focus:ring-green-400"
                            required
                        >

                        <button
                            type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 rounded-full shadow-md transition">
                            ➤
                        </button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
</x-app-layout>

<script>
setInterval(() => {
    fetch('/heartbeat', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });
}, 30000);
</script>