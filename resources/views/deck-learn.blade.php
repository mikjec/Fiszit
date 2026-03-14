<x-app-layout>
    <x-slot name="header">
        <div class="w-full h-full flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$deck->name }}
            </h2>
            <a href="{{ route('flashcards.index',['deck'=>$deck->id]) }}"
                class="flex items-center gap-2 px-8 py-3 bg-[#9cf] text-white font-semibold rounded-full shadow-[0_4px_14px_0_rgba(79,70,229,0.39)] transition-all hover:bg-[#88c3ff] hover:shadow-indigo-500/50 hover:-translate-y-0.5 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <span>Powrót</span>

            </a>
        </div>
    </x-slot>

    <div class="py-12 flex flex-col justify-center items-center">
        @foreach($flashcards as $card)
        <div class="card-box w-[200px] h-[300px] m-8" x-data="{ flipped: false }" @click="flipped = !flipped">
            <div class="learning-card" :class="{ 'flipped': flipped }">

                <div class="question-card p-4">
                    <span class="text-[1rem]">{{ $card->front }}</span>
                    <span class="absolute bottom-0 right-0 p-4 text-[#f6f6f6] font-semibold">Odpowiedź >></span>
                </div>

                <div class="answer-card p-4">
                    <span class="text-[1rem]">{{ $card->back }}</span>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>