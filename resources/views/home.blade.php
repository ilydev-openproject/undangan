<x-layout>
    <section>
        <x-cover></x-cover>
        <x-hero :eventDate="$eventDate ?? '2025-6-22 9:00:00'" />
        <x-body></x-body>
        <x-gallery></x-gallery>
        <x-comment></x-comment>
        <x-gift></x-gift>
    </section>
</x-layout>