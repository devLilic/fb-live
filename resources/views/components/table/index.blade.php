<table
    {{ $attributes->merge(['class' => 'divide-y divide-gray-200']) }}
>
    <thead class="bg-gray-50">
    <tr>
        {{ $header }}
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    {{ $slot }}
    </tbody>
</table>
