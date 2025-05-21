<div class="bg-[#1A1A1A] h-fit py-8 px-4 w-full">
    <div class="heading text-center">
        <h3 class="font-elsie-s text-[#eec373] text-[30px]" data-aos="zoom-in-up">Wishes</h3>
        <p class="text-[#F4DFBA] font-elsie text-[18px] leading-[20px]" data-aos="zoom-in-up">Berikan ucapan
            terbaik<br>untuk kedua mempelai
        </p>
    </div>

    <form wire:submit.prevent="submit" class="max-w-md mx-auto bg-[#DED9CB] p-4 my-4 rounded-3xl" data-aos="zoom-in-up">
        <div class="heading flex flex-row justify-start items-center text-[#4B2800] py-2">
            <i class="fas fa-comments fa-lg me-2"></i>
            <span>Comment</span>
        </div>

        <div class="mb-5">
            <input type="text" wire:model.defer="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4B2800]/30 focus:border-[#4B2800]/30 block w-full p-2.5 "
                placeholder="Masukkan Nama">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <textarea wire:model.defer="message"
                class="bg-gray-50 border h-32 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4B2800]/30 focus:border-[#4B2800]/30 block w-full p-2.5 "
                placeholder="Ucapan"></textarea>
            @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <select wire:model.defer="attendance" ...
                class="bg-gray-50 border border-gray-300 text-[#4B2800] text-sm rounded-lg focus:ring-[#4B2800]/20 focus:border-[#4B2800]/20 block w-full p-2.5">
                <option value="">-- Pilih Kehadiran --</option>
                <option value="1">Hadir</option>
                <option value="0">Tidak Hadir</option>
            </select>
            @error('attendance') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
            class="text-white bg-[#4B2800] hover:bg-[#4B2800] focus:ring-4 focus:outline-none focus:ring-[#4B2800] font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>

    <div class="bg-[#DED9CB] p-4 my-4 rounded-3xl space-y-4 max-w-md mx-auto" data-aos="zoom-in-up">
        @forelse ($comments as $comment)
            <div class="mb-4 flex flex-row justify-start">
                <div class="bg-[#1B0E00] w-10 h-10 rounded-full flex flex-row items-center justify-center">
                    <span class="text-white">
                        {{ strtoupper(Str::substr($comment->name, 0, 1)) }}
                    </span>
                </div>
                <div class="detail ms-2">
                    <div class="name flex flex-row items-center">
                        <p class="font-semibold text-[#4B2800]">{{ ucwords($comment->name) }}
                        </p>
                        <div class="bg-[#4B2800]/20 ms-2 rounded-3xl px-2 flex flex-row items-center text-white">
                            <i
                                class="{{ $comment->kehadiran == 1 ? 'far fa-check-circle' : 'fas fa-times-circle' }} fa-xs me-[2px]"></i>
                            <span class="text-[10px]">
                                {{ $comment->kehadiran == 1 ? 'Hadir' : 'Tidak Hadir' }}
                            </span>
                        </div>
                    </div>
                    <p class="text-[10px] text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    <p class="text-black">{{ $comment->ucapan }}</p>
                </div>
            </div>
        @empty
            <span>Belum ada ucapan</span>
        @endforelse
    </div>
</div>