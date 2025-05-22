<div class="bg-[#1A1A1A]">
    <div class="card bg-[#252525] p-4 mx-8 rounded-2xl text-center flex flex-col justify-center items-center">
        <i class="fas fa-gift fa-4x text-[#EEC373]" data-aos="zoom-in-up"></i>
        <span class="text-[18px] font-elsie text-[#EEC373] my-4" data-aos="zoom-in-up">Kirim Hadiah</span>
        <p class="font-elsie text-[#F4DFBA] text-[15px]" data-aos="zoom-in-up">
            Doa Restu Anda merupakan karunia yang sangat berarti bagi kami. Namun jika memberi adalah ungkapan tanda
            kasih Anda, Anda dapat memberi kado secara cashless.
        </p>
        <!-- <button class="bg-[#EEC373] px-8 py-2 mt-8 rounded-3xl hover:bg-[#F4DFBA]" data-aos="zoom-in-up">
            <i class="fas fa-gift"></i>
            <span class="text-[16px] font-elsie">Kirim Gift</span>
        </button> -->
        <div class="cashles relative mt-12 w-full h-fit" x-data="{ copied: false }" data-aos="zoom-in-up">
            <div class="card w-full h-full">
                <img src="{{ asset('image/atm.png') }}" class="object-contain w-full h-full" alt="">
                <div
                    class="absolute top-[50%] left-[62%] -translate-x-[50%] -translate-y-[80%] flex flex-col justify-center items-start leading-4 text-[14px]">
                    <span x-ref="rekening" class="font-[300] font-atm text-white tracking-[2px]">066051050545545</span>
                    <span class="text-[#D9D9D9] text-shadow-lg font-atm">Rika Umami Rahayu</span>
                </div>
                <img src="{{ asset('image/bca.png') }}" class="absolute w-20 h-auto top-2 right-2" alt="">
                <button
                    @click="navigator.clipboard.writeText($refs.rekening.innerText);copied = true;setTimeout(() => copied = false, 2000);"
                    class="absolute bottom-2.5 left-2.5 bg-gray-50 hover:bg-gray-300 rounded-lg px-4 py-2 font-sans text-[12px] flex items-center gap-1 cursor-pointer">
                    <i class="far fa-copy"></i>
                    <span x-text="copied ? 'Copied' : 'Salin Rekening'"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="penutup p-8 text-center text-[#F4DFBA] font-elsie" data-aos="zoom-in-up">
        <p data-aos="zoom-in-up">Atas kehadiran dan Doa Restunya kami ucapkan terimakasih.</p>
        <p class="text-[18px] my-8" data-aos="zoom-in-up">Wassalamualaikum Wr. Wb.</p>
        <p data-aos="zoom-in-up">Kami Yang Berbahagia,<br>Keluarga Besar Kedua Mempelai
        </p>
        <h1 class="font-elsie-s text-[35px] text-[#EEC373] font-[200] my-2" data-aos="zoom-in-up">
            {{ $invitation->bride_name }} & {{ $invitation->groom_name }}</h1>
    </div>
    <div class="gunungankembar relative w-fit h-fit" data-aos="zoom-out">
        <img src="{{ asset('image/gunungankembar.png') }}" class="w-full relative -top-24 left-0.5 -translate-x-0.5"
            alt="">
    </div>
    <a href="" class="w-full flex flex-row justify-center items-center p-2 bg-black/10">
        <i class="fas fa-code text-[#EEC373] me-2"></i>
        <span class="text-[#EEC373] text-[12px]">Create by ilysmzb</span>
    </a>
</div>