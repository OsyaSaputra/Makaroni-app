@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-100 dark:bg-gray-200 rounded-md shadow-sm']) !!}>
