<section>
    <div class="bg relative">
        <div
            class="overlay absolute top-0 left-0 min-h-screen h-full w-full z-20 bg-gradient-to-b from-[#795700]/10 to-[#130E00]">
        </div>
        <img src="{{ asset('image/foto/bg-1.jpeg') }}"
            class="absolute top-0 left-0.5 -translate-x-0.5 z-10 min-h-screen w-auto object-cover" alt="">
    </div>
    <div class="body relative z-20 flex flex-col justify-center items-center px-2 py-12">
        <img src="{{ asset('image/gunungan.png') }}" alt="">
        <h1 class="font-batik text-[35px] text-[#EEC373] font-[200] my-2">Rika & Ilyas</h1>
        <p class="text-[#F4DFBA] font-elsie text-center font-[300] text[15px] capitalize mt-3">
            Kami akan menikah,<br>dan kami ingin Anda menjadi bagian dari hari istimewa kami!
        </p>

        <div class="countdown flex flex-row justify-center items-center gap-2 md:gap-4 mt-8">
            <!-- Hari -->
            <div
                class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                <span id="days" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                <p class="text-xs md:text-sm text-[#EEC373]/80">Hari</p>
            </div>
            <!-- Jam -->
            <div
                class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                <span id="hours" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                <p class="text-xs md:text-sm text-[#EEC373]/80">Jam</p>
            </div>
            <!-- Menit -->
            <div
                class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                <span id="minutes" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                <p class="text-xs md:text-sm text-[#EEC373]/80">Menit</p>
            </div>
            <!-- Detik -->
            <div
                class="flex flex-col items-center justify-center w-16 md:w-20 lg:w-24 p-2 md:p-3 bg-white/10 rounded-lg border border-[#EEC373]">
                <span id="seconds" class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#EEC373]">--</span>
                <p class="text-xs md:text-sm text-[#EEC373]/80">Detik</p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tanggal dari props komponen
            const targetDate = new Date("{{ $eventDate ?? '2025-6-22 9:00:00' }}");

            function updateCountdown() {
                const now = new Date();
                const diff = targetDate - now;

                // Hitung hari, jam, menit, detik
                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                // Update tampilan
                document.getElementById('days').textContent = days;
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');

                // Jika waktu sudah habis
                if (diff < 0) {
                    clearInterval(countdownTimer);
                    document.querySelector('.countdown').innerHTML = '<div class="text-[#EEC373] text-lg">Acara telah dimulai!</div>';
                }
            }

            // Jalankan pertama kali
            updateCountdown();

            // Update setiap detik
            const countdownTimer = setInterval(updateCountdown, 1000);
        });
    </script>
    </div>
</section>