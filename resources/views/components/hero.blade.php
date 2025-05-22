<div class="h-auto" data-aos="zoom-in-up">
    <div class="bg relative h-auto overflow-hidden">
        <div class="overlay absolute top-0 left-0 h-full w-full z-20 bg-gradient-to-b from-[#795700]/10 to-[#1A1A1A]">
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
            <img src="{{ asset('image/gunungan.png') }}" alt="" data-aos="flip-right">
            <h1 class="font-batik text-[35px] text-[#EEC373] font-[200] my-2" data-aos="zoom-in-up">
                {{ $invitation->bride_name }} & {{ $invitation->groom_name }}
            </h1>
            <p class="text-[#F4DFBA] font-elsie text-center font-[300] text[15px] capitalize mt-3"
                data-aos="zoom-in-up">
                Kami akan menikah,<br>dan kami ingin Anda menjadi bagian dari hari istimewa kami!
            </p>

            <div class="countdown flex flex-row justify-center items-center gap-2 md:gap-4 mt-8" data-aos="zoom-in-up">
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
                <p class="font-elsie-s text-[#EEC373] text-[20px] font-[300]" data-aos="zoom-in-up">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('F, j') }}<sup>{{ \Carbon\Carbon::parse($invitation->event_date)->format('S') }}</sup>
                    {{ \Carbon\Carbon::parse($invitation->event_date)->format('Y') }}
                </p>
                <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=Rika+%26+Ilyas+Wedding&dates=20251212T090000/20251212T110000&details=Kami+mengundang+Anda+untuk+hadir+di+acara+pernikahan+kami&location=Lokasi+Pernikahan&sf=true&output=xml"
                    target="_blank"
                    class="bg-[#EEC373] hover:bg-[#B78C3C] py-2 px-4 rounded-3xl flex flex-row justify-center items-center cursor-pointer transition-colors duration-300 mt-4"
                    data-aos="zoom-in-up">
                    <i class="fas fa-calendar-alt me-2"></i>
                    <span class="font-elsie text-[13px] font-[400] text-[#232323]" style="letter-spacing: 0;">
                        Save the Date
                    </span>
                </a>
            </div>

        </div>
    </div>
    <div id="event-date" data-event-date="{{ $invitation->event_date }}"></div>
    <script>
        const eventDateEl = document.getElementById("event-date");
        const eventDateStr = eventDateEl.getAttribute("data-event-date") + "T00:00:00";
        const weddingDate = new Date(eventDateStr).getTime();

        const countdown = setInterval(() => {
            const now = new Date().getTime();
            const distance = weddingDate - now;

            if (distance < 0) {
                clearInterval(countdown);
                document.getElementById("days").innerText = "0";
                document.getElementById("hours").innerText = "0";
                document.getElementById("minutes").innerText = "0";
                document.getElementById("seconds").innerText = "0";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;
        }, 1000);
    </script>

</div>