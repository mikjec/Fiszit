@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#9ce4ff] focus:ring-[#9ce4ff] rounded-md shadow-sm']) }}>