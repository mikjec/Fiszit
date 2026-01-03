<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel użytkownika') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1>{{ __("Moje zestawy") }}</h1>

                        <button class="hover:text-[#9ce4ff]" onClick="showAddWindow()"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg></button>
                    </div>
                    @if (session('success'))
                    <div x-data="{ show: true }"
                        x-show="show"
                        x-init="setTimeout(() => show = false, 3000)"
                        class="fixed top-5 right-5 z-[100] flex items-center p-4 mb-4 text-emerald-800 rounded-lg bg-emerald-50 border border-emerald-200 shadow-lg"
                        role="alert">

                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>

                        <span class="sr-only">Sukces</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>

                        <button type="button" @click="show = false" class="ms-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-100 inline-flex items-center justify-center h-8 w-8">
                            <span class="sr-only">Zamknij</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    @endif

                    <ul>
                        @foreach ($decks as $deck)
                        <li class="bg-gray-100 m-2 rounded-lg">
                            <div class="m-4 p-4">{{ $deck->name }}</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 backdrop-blur-md z-50 bg-black/30 w-screen h-screen flex flex-col justify-center items-center transition-all duration-200" id="addDeckWindow">
        <div class="relative max-w-md min-w-[300px] bg-white p-8 rounded-lg shadow-lg">
            <button class="absolute top-4 right-4 hover:text-gray-500" onClick="hideAddWindow()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <form action="{{ route('decks.store') }}" method="POST">

                @csrf
                @method('POST')

                <div>
                    <x-input-label for="deck_name" :value="__('Nazwa zestawu')" class="mb-4" />

                </div>

                <x-text-input id="deck_name" class="block mt-1 w-full"
                    type="text"
                    name="deck_name" required autocomplete="off" />

                <x-input-error :messages="$errors->get('deck_name')" class="mt-2" />

                <div class="w-full flex justify-end mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-3 bg-[#9ce4ff] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#83bfd5]  focus:bg-gray-700 active:bg-[#83bfd5] focus:outline-none focus:ring-2 focus:ring-[#9ce4ff] focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Utwórz') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addDeckWindow = document.getElementById('addDeckWindow');
        addDeckWindow.style.visibility = 'hidden';
        addDeckWindow.style.opacity = '0';

        function showAddWindow() {
            addDeckWindow.style.visibility = 'visible';
            addDeckWindow.style.opacity = '1';

        }

        function hideAddWindow() {
            addDeckWindow.style.visibility = 'hidden';
            addDeckWindow.style.opacity = '0';
        }
    </script>
</x-app-layout>