<div x-data="{
    isOpen: false,
    playAudio() {
        const scrollToTop = () => {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            if (currentScroll > 0) {
                // Kurangi scroll dengan easing (misal kurangi 1/10 jarak tiap frame)
                window.scrollTo(0, currentScroll - currentScroll / 1);
                requestAnimationFrame(scrollToTop);
            }
        };

        scrollToTop();
        this.$refs.audioPlayer.play().catch(error => {
            console.error('Gagal memutar audio:', error);
            alert('Silakan klik izinkan untuk memutar musik undangan');
        });
        this.isOpen = true;
    }
}" x-init="document.body.classList.add('overflow-hidden');
$watch('isOpen', value => {
    if (value) {
        document.body.classList.remove('overflow-hidden');
    } else {
        document.body.classList.add('overflow-hidden');
    }
})" x-bind:class="{ 'translate-y-[-100vh]': isOpen }"
    class="fixed left-0 top-0 z-50 flex h-screen w-screen flex-col items-center justify-center bg-[#212020] transition-transform duration-1000 ease-in-out">
    <img src="{{ asset('image/gunungan.png') }}" class="max-h-62 w-auto relative" alt="" data-aos="flip-left">
    <h1
        class="font-batik animate-fade-in-scale animate-fade-in-scale-delay-[1s] my-2 text-[35px] font-[200] text-[#EEC373]">
        {{ $invitation->bride_nickname }} & {{ $invitation->groom_nickname }}
    </h1>
    <p class="font-elsie mt-2 text-[15px] font-[100] text-[#f4dfba]" data-aos="zoom-in-up">WE INVITE YOU TO CELEBRATE
        OUR WEDDING</p>
    <h2 class="font-elsie font-[100] text-[#F4DFBA]" data-aos="zoom-in-up">Kepada yth: Bpk/Ibu/Saudara/i</h2>
    @if ($guestName)
        <div class="tamu my-4" data-aos="fade-up">
            <span class="font-elsie-s text-[20px] font-[200] text-[#EEC373]">{{ ucwords($guestName) }}</span>
        </div>
    @endif




    <!-- Elemen Audio -->
    <audio x-ref="audioPlayer" src="{{ asset('audio/song.mp3') }}"
        x-init="try { $refs.audioPlayer.volume = 0.5; } catch (e) {}"></audio>

    <div class="open">
        <button @click="playAudio()"
            class="flex cursor-pointer flex-row items-center justify-center rounded-3xl bg-[#EEC373] px-4 py-2 transition-colors duration-300 hover:bg-[#B78C3C]"
            data-aos="zoom-in-up">
            <i class="fas fa-envelope-open me-2"></i>
            <span class="font-elsie text-[13px] font-[400] text-[#232323]" style="letter-spacing: 0;">
                Buka Undangan
            </span>
        </button>
    </div>
</div>