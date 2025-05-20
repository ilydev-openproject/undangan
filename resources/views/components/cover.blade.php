<div x-data="{ 
        isOpen: false,
        playAudio() {
            this.$refs.audioPlayer.play().catch(error => {
                console.error('Gagal memutar audio:', error);
                alert('Silakan klik izinkan untuk memutar musik undangan');
            });
            this.isOpen = true;
        }
    }" x-init="
        document.body.classList.add('overflow-hidden');
        $watch('isOpen', value => {
            if (value) {
                document.body.classList.remove('overflow-hidden');
            } else {
                document.body.classList.add('overflow-hidden');
            }
        })
    " x-bind:class="{ 'translate-y-[-100vh]': isOpen }"
    class="fixed w-screen h-screen bg-[#212020] top-0 left-0 flex flex-col justify-center items-center transition-transform duration-1000 ease-in-out z-50">
    <img src="{{ asset('image/gunungan.png') }}" class="max-w-52" alt="">
    <h1
        class="font-batik text-[35px] text-[#EEC373] font-[200] animate-fade-in-scale animate-fade-in-scale-delay-[1s] my-2">
        Rika & ilyas
    </h1>
    <p class="font-elsie text-[#f4dfba] text-[15px] font-[100] mt-2">WE INVITE YOU TO CELEBRATE OUR WEDDING</p>
    <h2 class="font-elsie text-[#F4DFBA] font-[100]">Kepada yth: Bpk/Ibu/Saudara/i</h2>
    <div class="tamu my-4">
        <span class="font-elsie-s text-[#EEC373] text-[20px] font-[200]">Tamu Undangan</span>
    </div>

    <!-- Elemen Audio -->
    <audio x-ref="audioPlayer" src="{{ asset('audio/song.mp3') }}"
        x-init="try { $refs.audioPlayer.volume = 0.5; } catch(e) {}"></audio>

    <div class="open">
        <button @click="playAudio()"
            class="bg-[#EEC373] hover:bg-[#B78C3C] py-2 px-4 rounded-3xl flex flex-row justify-center items-center cursor-pointer transition-colors duration-300">
            <i class="fas fa-envelope-open me-2"></i>
            <span class="font-elsie text-[13px] font-[400] text-[#232323]" style="letter-spacing: 0;">
                Buka Undangan
            </span>
        </button>
    </div>
</div>