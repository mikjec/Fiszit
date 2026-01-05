<x-guest-layout>
    <h1 class="text-2xl font-bold mb-6 flex justify-center">{{ $deck->name }}</h1>

    <div class="py-12 flex flex-col justify-center items-center">
        @foreach($deck->flashcards as $card)
        <div class="card-box w-[200px] h-[300px] md:w-[300px] md:h-[400px] m-8" x-data="{ flipped: false }" @click="flipped = !flipped">
            <div class="learning-card" :class="{ 'flipped': flipped }">

                <div class="question-card p-4">
                    <span class="text-[1rem] md:text-[1.3rem]">{{ $card->front }}</span>
                    <span class="absolute bottom-0 right-0 p-4 text-[#f6f6f6] font-semibold">Odpowiedź >></span>
                </div>

                <div class="answer-card p-4">
                    <span class="text-[1rem] md:text-[1.3rem]">{{ $card->back }}</span>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</x-guest-layout>