<x-app-layout>
    <div
        x-data="{
        open: false,
        deckId: null,
        deckName: '',
        confirmation: false,
        openCreate() {
            this.open = true;
            this.deckId = null;
            this.deckName = '';
        },
        openEdit(id, name) {
            this.open = true;
            this.deckId = id;
            this.deckName = name;
        },
        openConfirm(id){
            this.confirmation=true;
            this.deckId = id;
            this.open = true;
        }
    }">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$deck->name }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex justify-center items-center pt-4 pb-5">
                    <button class="hover:text-[#9ce4ff] transition-colors duration-100 text-gray-500" @click="openCreate()"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor" class="size-24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </button>
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

                @foreach($flashcards as $card)
                <div class="w-full flex flex-col justify-center items-center">
                    <hr class="border-t-2 border-gray-300 w-[60%] m-6">
                    <div class="flex flex-row justify-between">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 w-[300px] h-[200px] m-4 focus-within:ring-2 focus-within:ring-indigo-100 transition-all">
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-2">Przód</label>
                            <textarea
                                name="front[]"
                                class="w-full h-[120px] resize-none border-none p-0 focus:ring-0 text-gray-700 text-lg leading-relaxed placeholder:text-gray-300"
                                placeholder="Wpisz pytanie...">{{ $card->front }}</textarea>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 w-[300px] h-[200px] m-4 focus-within:ring-2 focus-within:ring-green-100 transition-all">
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-2">Tył</label>
                            <textarea
                                name="back[]"
                                class="w-full h-[120px] resize-none border-none p-0 focus:ring-0 text-gray-700 text-lg leading-relaxed placeholder:text-gray-300"
                                placeholder="Wpisz odpowiedź...">{{ $card->back }}</textarea>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>

    </div>


    </div>
</x-app-layout>