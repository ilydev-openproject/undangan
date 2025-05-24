<x-jawa.layout :invitation="$invitation">
    <section>
        <x-jawa.cover :guestName="$guestName" :invitation="$invitation"></x-jawa.cover>
        <x-jawa.hero :invitation="$invitation" />
        <x-jawa.body :invitation="$invitation"></x-jawa.body>
        <x-jawa.gallery :invitation="$invitation"></x-jawa.gallery>
        <x-jawa.comment :invitation="$invitation"></x-jawa.comment>
        <x-jawa.gift :invitation="$invitation"></x-jawa.gift>
    </section>
</x-jawa.layout>