<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Kiri: Form --}}
        <form wire:submit.prevent="submit" class="space-y-6 col-span-2">
            {{ $this->form }}

            <x-filament::button type="submit">
                Kirim
            </x-filament::button>
        </form>

        {{-- Kanan: Emulator --}}
        <div class="shadow rounded-lg p-4 relative col-span-1">
            <div
                class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[600px] w-[300px]">
                <!-- Tombol samping kiri -->
                <div
                    class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[3.8px] top-[72px] rounded-s-lg">
                </div>
                <div
                    class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[3.8px] top-[124px] rounded-s-lg">
                </div>
                <div
                    class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[3.8px] top-[178px] rounded-s-lg">
                </div>
                <!-- Tombol samping kanan -->
                <div
                    class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -end-[3.2px] top-[142px] rounded-e-lg">
                </div>
                <!-- Area layar -->
                <div class="flex flex-row justify-center items-center w-full h-full">
                    <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-gray-800">
                        @php
                            $slug = auth()->user()->invitation?->slug ?? null;
                        @endphp

                        @if ($slug)
                            <iframe src="{{ route('invitation.show', ['slug' => $slug]) }}"
                                class="w-[375px] h-[812px] border-none"
                                style="transform: scale(0.7253); transform-origin: top left;"
                                title="Emulator Preview"></iframe>
                        @else
                            <div class="text-red-500">Slug undangan belum tersedia.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>