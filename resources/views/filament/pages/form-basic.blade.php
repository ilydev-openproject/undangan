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
            <div class="mt-4 justify-self-center">
                @php
                    $invitation = auth()->user()->invitation;
                @endphp

                @if ($invitation && $invitation->slug)
                    <a href="{{ $invitation->slug . config('app.url') . '/invitation/'  }}" target="_blank"
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-700 flex flex-row justify-center items-center font-semibold text-sm gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>

                        Lihat Hasil
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-filament-panels::page>