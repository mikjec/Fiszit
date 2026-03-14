<footer class="bg-white border-t border-gray-200 mt-12 w-full">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">

            <div class="text-sm text-gray-400 flex flex-row gap-4">
                <a href="{{ route('dashboard') }}" class="hover:text-[#7ed9ff] transition-colors">Zestawy</a>
                <a href="/profile" class="hover:text-[#7ed9ff] transition-colors">Moje konto</a>
            </div>

            <div class="flex  text-sm font-medium text-gray-500 items-center">
                &copy; {{ date('Y') }} FiszIt! Wszystkie prawa zastrzeżone.
            </div>


            <div class="hidden md:flex items-center">
                <x-application-logo class="h-10 w-auto fill-current text-gray-800" />
            </div>

        </div>
    </div>
</footer>