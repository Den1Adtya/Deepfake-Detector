@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-[#39FF14]']) }}>
        {{ $status }}
    </div>
@endif
