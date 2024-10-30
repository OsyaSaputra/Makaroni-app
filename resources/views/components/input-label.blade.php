@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-black dark:text-gray-400']) }}>
    {{ $value ?? $slot }}
</label>
