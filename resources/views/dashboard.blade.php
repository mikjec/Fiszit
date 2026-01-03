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
                {{ __('Panel użytkownika') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-4">
                            <h1>{{ __("Moje zestawy") }}</h1>

                            <button class="hover:text-[#9ce4ff] transition-colors duration-100" @click="openCreate()"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
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

                        <div>
                            @foreach ($decks as $deck)
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-100 p-4 m-4 rounded-lg flex flex-row justify-between items-center hover:bg-gray-200 transition-colors duration-200">
                                <a href="{{ route('flashcards.index', [$deck->id]) }}" class="cursor-pointer w-[90%]">
                                    {{ ($deck->name) }}
                                </a>
                                <div class="w-[10%] flex flex-row justify-end bg-red-400">
                                    <button @click="openEdit({{ $deck->id }}, '{{addslashes($deck->name)}}')" class="hover:text-[#00ff00] transition-colors duration-100 mr-3"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button @click="openConfirm({{ $deck->id}})" class="hover:text-[#ff0000] transition-colors duration-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div
                        x-show="open"
                        x-transition
                        @keydown.escape.window="open = false"
                        @click.self="open = false"
                        class="fixed inset-0 z-50 bg-black/30 backdrop-blur-md flex justify-center items-center">
                        <div class="bg-white p-8 rounded-lg shadow-lg min-w-[300px] relative">
                            <button
                                class="absolute top-4 right-4 hover:text-gray-500"
                                @click="open = false">✕</button>

                            <template x-if="!confirmation">
                                <div>
                                    <h2 class="text-lg font-semibold mb-4" x-text="deckId ? 'Edytuj zestaw' : 'Dodaj zestaw'"></h2>
                                    <form
                                        method="POST"
                                        :action="deckId ? `/decks/${deckId}` : '{{ route('decks.store') }}'">
                                        @csrf
                                        <template x-if="deckId">
                                            @method('PUT')
                                        </template>

                                        <x-input-label for="deck_name" :value="__('Nazwa zestawu')" class="mb-2" />
                                        <x-text-input
                                            id="deck_name"
                                            class="block w-full"
                                            type="text"
                                            name="deck_name"
                                            x-model="deckName"
                                            required
                                            autocomplete="off" />

                                        <div class="flex justify-end mt-6">
                                            <button type="submit" class="px-4 py-3 bg-[#9ce4ff] text-white rounded-md"
                                                x-text="deckId ? 'Zmień' : 'Utwórz'"></button>
                                        </div>
                                    </form>
                                </div>
                            </template>

                            <template x-if="confirmation">
                                <div>
                                    <p>Czy na pewno chcesz usunąć ten zestaw?</p>
                                    <div class="flex justify-end mt-6">
                                        <form :action="`/decks/${deckId}`" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" @click="open = false"
                                                class="px-4 py-3 bg-[#ff0000] text-white rounded-md mr-2">Usuń</button>
                                        </form>
                                        <button type="button" class="px-4 py-3 bg-[#9ce4ff] text-white rounded-md"
                                            @click="open = false">Anuluj</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>


                </div>
</x-app-layout>