<x-layout>
    <section>
        <x-cover :invitation="$invitation"></x-cover>
        <x-hero :invitation="$invitation" />
        <x-body :invitation="$invitation"></x-body>
        <x-gallery :invitation="$invitation"></x-gallery>
        <x-comment :invitation="$invitation"></x-comment>
        <x-gift :invitation="$invitation"></x-gift>
    </section>
</x-layout>