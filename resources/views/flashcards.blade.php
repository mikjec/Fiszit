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
            <div class="flex flex-row justify-between items-center">
                <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
                    {{$deck->name }}
                </h2>
                <form method="POST" action="{{ route('decks.share.generate', $deck) }}">
                    @csrf

                    <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                        Udostępnij
                    </button>
                </form>
                @if ($deck->share_token)
                <input
                    type="text"
                    readonly
                    value="{{ route('decks.share', $deck->share_token) }}"
                    class="w-full border rounded px-3 py-2">
                @endif

                <a href="{{ route('decks.learn',['deck'=>$deck->id]) }}"
                    class="flex items-center gap-2 px-4 py-3 bg-[#9cf] text-white font-semibold rounded-full shadow-[0_4px_14px_0_rgba(79,70,229,0.39)] transition-all hover:bg-[#88c3ff] hover:shadow-indigo-500/50 hover:-translate-y-0.5 active:scale-95">
                    <span>Rozpocznij</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full flex justify-center items-center pt-4 pb-5">
                    <form action="{{ route('flashcards.store',[ 'deck' => $deck->id]) }}" method="post">
                        @csrf
                        @method('post')
                        <button class="hover:text-[#9ce4ff] transition-colors duration-100 text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.7" stroke="currentColor" class="size-24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </form>
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
                    <div class="flex flex-col lg:flex-row justify-between"
                        x-data="{
                                async saveData(component, field) {
                                    if (component.value === component.original) return;

                                    component.saving = true;
                                    component.error = null;

                                    try {   
                                        console.log(component.value, field)
                                        const response = await fetch('{{ route('flashcards.update', ['flashcard'=>$card->id,'deck' => $deck->id]) }}', {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json'
                                            },
                                            // Dynamicznie ustawiamy klucz: front lub back
                                            body: JSON.stringify({ [field]: component.value })
                                        });

                                        if (!response.ok) throw new Error();
                                        component.original = component.value;
                                    } catch (e) {
                                        component.error = 'Błąd zapisu';
                                    } finally {
                                        component.saving = false;
                                    }
                                }
                            }">
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 px-4 py-4 w-[300px] h-[200px] m-4 focus-within:ring-2 focus-within:ring-indigo-100 transition-all"

                            x-data="{
                                        value: @js($card->front),
                                        original: @js($card->front),
                                        saving: false,
                                        error: null,
                            }">
                            <div class="flex flex-row justify-between items-center">
                                <label class="block font-semibold text-gray-400 uppercase">
                                    Przód
                                </label>
                                <form action="{{ route('flashcards.destroy', ['flashcard'=>$card->id,'deck' => $deck->id]) }}" method='post'>
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-gray-500 hover:text-red-500 p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            <textarea
                                class="w-full h-[120px] resize-none border-none p-0 focus:ring-0 text-gray-700 leading-relaxed placeholder:text-gray-300 text-[0.8rem] md:text-[1.1rem]"
                                placeholder="Wpisz pytanie..."
                                x-model="value"
                                @blur="saveData($data, 'front')"></textarea>

                            <div class="mt-1 text-xs text-gray-400">
                                <div role="status" x-show='saving' class="">
                                    <svg aria-hidden="true" class="text-neutral-tertiary animate-spin fill-[#9ce4ff] w-[1.2rem]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span x-show="error" class="text-red-500" x-text="error"></span>
                            </div>
                        </div>


                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 w-[300px] h-[200px] m-4 focus-within:ring-2 focus-within:ring-green-100 transition-all"
                            x-data="{
                                        value: @js($card->back),
                                        original: @js($card->back),
                                        saving: false,
                                        error: null,
                            }">
                            <label class="block font-semibold text-gray-400 uppercase mb-2">Tył</label>
                            <textarea
                                name="back[]"
                                class="w-full h-[120px] resize-none border-none p-0 focus:ring-0 text-gray-700 leading-relaxed placeholder:text-gray-300"
                                placeholder="Wpisz odpowiedź..."
                                x-model="value"
                                @blur='saveData($data, "back")'></textarea>

                            <div class="mt-1 text-xs text-gray-400">
                                <div role="status" x-show='saving' class="">
                                    <svg aria-hidden="true" class="text-neutral-tertiary animate-spin fill-[#9ce4ff] w-[1.2rem]" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span x-show="error" class="text-red-500" x-text="error"></span>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>



    </div>


    </div>
</x-app-layout>