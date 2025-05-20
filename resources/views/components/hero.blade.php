<div class="h-auto">
    <div class="bg relative h-auto min-h-screen overflow-hidden">
        <div class="overlay absolute top-0 left-0 h-full w-full z-20 bg-gradient-to-b from-[#795700]/10 to-[#212529]">
        </div>
        <div class="bg-group">
            <img src="{{ asset('image/foto/bg-1.jpeg') }}"
                class="absolute top-0 left-0.5 -translate-x-0.5 z-10 h-full w-auto object-cover animate-fade-1 bg1"
                alt="">
            <img src="{{ asset('image/foto/bg-2.jpeg') }}"
                class="absolute top-0 left-0.5 -translate-x-0.5 z-10 h-full w-auto object-cover animate-fade-2 bg2"
                alt="">
            <img src="{{ asset('image/foto/bg-3.jpeg') }}"
                class="absolute top-0 left-0.5 -translate-x-0.5 z-10 h-full w-auto object-cover animate-fade-3 bg3"
                alt="">
            <img src="{{ asset('image/foto/bg-4.jpeg') }}"
                class="absolute top-0 left-0.5 -translate-x-0.5 z-10 h-full w-auto object-cover animate-fade-4 bg4"
                alt="">
        </div>
        <div class="body relative z-20 flex flex-col justify-center items-center px-2 py-12">
            <img src="{{ asset('image/gunungan.png') }}" alt="">
            <h1 class="font-batik text-[35px] text-[#EEC373] font-[200] my-2">Rika & ilyas</h1>
            <p class="text-[#F4DFBA] font-elsie text-center font-[300] text[15px] capitalize mt-3">
                Kami akan menikah,<br>dan kami ingin Anda menjadi bagian dari hari istimewa kami!
            </p>

            <div class="countdown flex flex-row justify-center items-center gap-2 md:gap-4 mt-8">
                <!-- Hari -->
                <div
                    class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                    <span id="days" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                    <p class="text-xs md:text-sm text-[#EEC373]/80 font-elsie">Hari</p>
                </div>
                <!-- Jam -->
                <div
                    class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                    <span id="hours" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                    <p class="text-xs md:text-sm text-[#EEC373]/80 font-elsie">Jam</p>
                </div>
                <!-- Menit -->
                <div
                    class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                    <span id="minutes" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                    <p class="text-xs md:text-sm text-[#EEC373]/80 font-elsie">Menit</p>
                </div>
                <!-- Detik -->
                <div
                    class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                    <span id="seconds" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                    <p class="text-xs md:text-sm text-[#EEC373]/80 font-elsie">Detik</p>
                </div>
            </div>
            <div class="savedate mt-8">
                <p class="font-elsie-s text-[#EEC373] text[20px] font-[300]">Desember, 12<sup>th</sup> 202x</p>
                <button"
                    class="bg-[#EEC373] hover:bg-[#B78C3C] py-2 px-4 rounded-3xl flex flex-row justify-center items-center cursor-pointer transition-colors duration-300 mt-4">
                    <i class="far fa-calendar me-2"></i>
                    <span class="font-elsie text-[13px] font-[400] text-[#232323]" style="letter-spacing: 0;">
                        Save the Date
                    </span>
                    </button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const targetDate = new Date("2024-12-25 19:00:00");
            let countdownTimer = null; // ⬅️ deklarasikan dulu agar tidak error

            function updateCountdown() {
                const now = new Date();
                const diff = targetDate - now;

                if (diff < 0) {
                    clearInterval(countdownTimer); // tidak error lagi karena sudah dideklarasi
                    document.querySelector('.countdown').innerHTML = '<div class="text-[#EEC373] text-lg">Acara telah dimulai!</div>';
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = days;
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            }

            // Jalankan pertama kali
            updateCountdown();

            // Set interval setelah deklarasi
            countdownTimer = setInterval(updateCountdown, 1000);
        });
    </script>

</div>