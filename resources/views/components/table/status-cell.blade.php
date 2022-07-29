@props([
    'status' => ''
])
@php
    $status = $status === "0" ? 'Active': 'Disabled';
    $color = ($status === "Active") ? 'green' : 'red'
@endphp
<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800">
    {{ $status }}
</span>

