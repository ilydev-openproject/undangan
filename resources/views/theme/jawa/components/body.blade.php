<div class="bg bg-[#1a1a1a] text-center py-4">
    <div class="px-2">
        <p class="font-elsie text-[18px] text-[#F4DFBA]" data-aos="zoom-in-up">Assalamualaikum
            Wr. Wb.</p>
        <p class="font-elsie text-[18px] text-[#F4DFBA]" data-aos="zoom-in-up">Untuk mengikuti
            Sunnah Rasul-Mu dalam
            rangka
            membentuk
            keluarga yang sakinah, mawaddah, warahmah.<br><br>Maka ijinkanlah kami menikahkannya. Ya Allah perkenankan
            kami
            merangkaikan kasih sayang yang kau ciptakan diantara putra-putri kami.</p>
        <div class="gate flex flex-row justify-center items-center gap-12 px-12 py-12" data-aos="zoom-in-up">
            @php
                $brideDefault = asset('image/foto/foto2.png');
                $groomDefault = asset('image/foto/foto1.png');

                if (method_exists($invitation, 'getFirstMedia')) {
                    $brideMedia = $invitation->getFirstMedia('bride_image');
                    $groomMedia = $invitation->getFirstMedia('groom_image');

                    $brideImage = $brideMedia ? $brideMedia->getUrl() : $brideDefault;
                    $groomImage = $groomMedia ? $groomMedia->getUrl() : $groomDefault;
                } else {
                    $brideImage = $brideDefault;
                    $groomImage = $groomDefault;
                }
            @endphp
            <div class="border-[#FFCC73] border-4 h-62 rounded-t-full overflow-hidden relative"
                data-aos="zoom-in-right">
                <div
                    class="overlay h-full w-full absolute top-0 left-0 bg-gradient-to-b from-[#F4DFBA]/20 to-[#232323]">
                </div>
                <img src="{{ $brideImage }}" class="h-full w-auto object-cover" alt="Bride Image">
            </div>
            <div class="border-[#FFCC73] border-4 h-62 rounded-t-full overflow-hidden relative" data-aos="zoom-in-left">
                <div
                    class="overlay h-full w-full absolute top-0 left-0 bg-gradient-to-b from-[#F4DFBA]/20 to-[#232323]">
                </div>
                <img src="{{ $groomImage }}" class="h-full w-auto object-cover" alt="Groom Image">
            </div>
        </div>
        <div class="mate">
            <div class="bride mb-2">
                <h2 class="font-elsie-s text-[30px] text-[#EEC373] mb-4" data-aos="zoom-in-up">
                    {{ $invitation->bride_name . ' ' . $invitation->bride_title }}
                </h2>
                <p class="font-elsie text-[18px] text-[#F4DFBA]" data-aos="zoom-in-up">Putri
                    {{ $invitation->bride_child_order }} dari Keluarga
                    <br>Bapak
                    {{ $invitation->brideFather?->is_deceased ? 'Alm. ' : '' }}{{ $invitation->brideFather?->name ?? '-' }}
                    dan Ibu
                    {{ $invitation->brideMother?->is_deceased ? 'Almh. ' : '' }}{{ $invitation->brideMother?->name ?? '-' }}
                </p>
                <a href="{{ $invitation->bride_link }}"
                    class="bg-[#EEC373] py-2 px-4 rounded-3xl flex flex-row justify-center items-center w-fit mx-auto mt-8"
                    target="_blank" data-aos="zoom-in-up">
                    <i class="fab fa-instagram me-1"></i>
                    <span class="font-elsie text-[15px]">{{"@" . $invitation->bride_ig_username }}</span>
                </a>
            </div>
            <div class="relative flex items-center py-2 px-16">
                <div class="flex-grow border-t border-[#EEC373]"></div>
                <i class="far fa-heart mx-4 text-[#EEC373]"></i>
                <div class="flex-grow border-t border-[#EEC373]"></div>
            </div>
            <div class="groom">
                <h2 class="font-elsie-s text-[30px] text-[#EEC373] mb-4" data-aos="zoom-in-up">
                    {{ $invitation->groom_name . ' ' . $invitation->groom_title }}
                </h2>
                <p class="font-elsie text-[18px] text-[#F4DFBA]" data-aos="zoom-in-up">Putra
                    {{ $invitation->groom_child_order }} dari Keluarga
                    <br>Bapak
                    {{ $invitation->groomFather?->is_deceased ? 'Alm. ' : '' }}{{ $invitation->groomFather?->name ?? '-' }}
                    dan Ibu
                    {{ $invitation->groomMother?->is_deceased ? 'Almh. ' : '' }}{{ $invitation->groomMother?->name ?? '-' }}
                </p>
                <a href="{{ $invitation->groom_link }}"
                    class="bg-[#EEC373] py-2 px-4 rounded-3xl flex flex-row justify-center items-center w-fit mx-auto mt-8"
                    target="_blank" data-aos="zoom-in-up">
                    <i class="fab fa-instagram me-1"></i>
                    <span class="font-elsie text-[15px]">{{"@" . $invitation->groom_ig_username }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="gunungankembar relative w-fit h-fit" data-aos="zoom-out">
        <img src="{{ asset('image/gunungankembar.png') }}" class="w-full relative -top-12 left-0.5 -translate-x-0.5"
            alt="">
    </div>
    <div class="px-4">
        <p class="font-elsie text-[#F4DFBA] text-[17px] capitalize" data-aos="zoom-in-up">Dengan memohon rahmat dan
            ridho Allah Subhanahu Wa
            Ta'ala,
            Kami mengundang Bapak/Ibu/Saudara/i, untuk menghadiri Resepsi Pernikahan kami. yang Insya Allah akan
            dilaksanakan pada :</p>
        @php
            $events = $invitation->event;

            $defaultEvents = collect([
                [
                    'name' => 'Akad Nikah',
                    'event_date' => '2023-12-10',
                    'waktu' => '09:00',
                    'end_time' => '11:00',
                    'location' => 'Rumah Mempelai Wanita - Jl. Lorem Ipsum No. 21',
                    'location_url' => '',
                ],
                [
                    'name' => 'Acara Resepsi',
                    'event_date' => '2023-12-10',
                    'waktu' => '10:00',
                    'end_time' => '13:00',
                    'location' => 'Rumah Mempelai Wanita - Jl. Lorem Ipsum No. 21',
                    'location_url' => '',
                ],
                [
                    'name' => 'Ngunduh Mantu',
                    'event_date' => '2023-12-11',
                    'waktu' => '10:00',
                    'end_time' => '13:00',
                    'location' => 'Rumah Mempelai Pria - Jl. Lorem Ipsum No. 21',
                    'location_url' => '',
                ],
            ]);

            $events = $events->isEmpty() ? $defaultEvents : $events;
        @endphp

        <div class="card-group mt-8" data-aos="zoom-in-up">
            @foreach ($events as $index => $e)
                <div class="card bg-[#252525] p-2 mx-2 mb-8 rounded-2xl"
                    data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                    <div class="relative flex items-center py-2 px-16">
                        <div class="flex-grow border-t border-[#EEC373]"></div>
                        <span class="font-elsie text-[18px] uppercase text-[#EEC373] mx-4">{{ $e['name'] }}</span>
                        <div class="flex-grow border-t border-[#EEC373]"></div>
                    </div>
                    <div class="p-4">
                        <div class="day flex flex-row justify-start items-center mb-2">
                            <i class="fas fa-calendar-alt text-[#EEC373] fa-lg me-4"></i>
                            <span class="text-[#EEC373] font-elsie text-[18px]">
                                {{ \Carbon\Carbon::parse($e['event_date'])->translatedFormat('l, j F Y') }}
                            </span>
                        </div>
                        <div class="time flex flex-row justify-start items-center mb-2">
                            <i class="far fa-clock text-[#EEC373] fa-lg me-4"></i>
                            <span class="text-[#EEC373] font-elsie text-[18px]">
                                {{ \Carbon\Carbon::parse($e['waktu'])->format('H.i') }} WIB
                            </span>
                        </div>
                        <div class="time flex flex-row justify-start items-center mb-2">
                            <i class="fas fa-map-marker-alt text-[#EEC373] fa-lg me-4"></i>
                            <span class="text-[#EEC373] font-elsie text-[18px] text-start">{{ $e['location'] }}</span>
                        </div>
                        @if (!empty($e['gmap_link']))
                            <a href="{{ $e['gmap_link'] }}"
                                class="flex flex-row justify-center items-center w-fit mx-auto mt-8 bg-[#EEC373] py-2 px-4 rounded-3xl">
                                <i class="fas fa-map-marker-alt fa-lg me-2"></i>
                                <span class="font-elsie text-[15px]">Kunjungi lokasi</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="gunungankembar relative w-fit h-fit" data-aos="zoom-out">
        <img src="{{ asset('image/gunungankembar.png') }}" class="w-full relative -top-24 left-0.5 -translate-x-0.5"
            alt="">
    </div>
    <h3 class="font-elsie-s text-[#eec373] text-[30px]" data-aos="zoom-in-up">Love Story</h3>

    @php
        // Asumsikan $invitation sudah di-passing dari controller
        $stories = $invitation->story()->orderBy('urutan')->get();

        $defaultStories = collect([
            [
                'title' => 'Perkenalan',
                'cerita' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, nihil?',
            ],
            [
                'title' => 'Khitbah',
                'cerita' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, nihil?',
            ],
            [
                'title' => 'Resepsi',
                'cerita' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, nihil?',
            ],
        ]);

        $stories = $stories->isEmpty() ? $defaultStories : $stories;
    @endphp

    <div class="milestone px-8 h-fit relative overflow-hidden" data-aos="zoom-in-up">
        @foreach ($stories as $index => $story)
            <div class="flex flex-row justify-center items-center my-8 relative">
                <i class="fab fa-gratipay fa-2x text-[#1a1a1a] mx-4 bg-[#1a1a1a]"></i>
                <div class="card text-start px-8 py-4 rounded-3xl" style="background-color: #1a1a1a;">
                    <span
                        class="text-sm font-semibold text-[18px] text-[#1a1a1a]">{{ $story['title'] ?? $story->title }}</span>
                    <p class="text-[14px] mt-4 text-[#1a1a1a]">{{ $story['cerita'] ?? $story->cerita }}</p>
                </div>
            </div>
            @if (!$loop->last)
                <div class="line" style="display: none;"></div>
            @endif
        @endforeach
    </div>


    <div class="gunungankembar relative w-fit h-fit z-10" data-aos="zoom-out">
        <img src="{{ asset('image/gunungankembar.png') }}" class="w-full relative -top-12 left-0.5 -translate-x-0.5"
            alt="">
    </div>
    <script>
        window.addEventListener('scroll', function () {
            const milestoneRows = document.querySelectorAll('.milestone > div:not(.line)');
            const triggerPoint = window.innerHeight / 2;
            const lines = document.querySelectorAll('.milestone .line');

            milestoneRows.forEach((row, index) => {
                const card = row.querySelector('.card');
                const icon = row.querySelector('i');
                const iconTop = icon.getBoundingClientRect().top;

                // Update card and icon colors based on icon position
                if (iconTop <= triggerPoint) {
                    card.style.backgroundColor = '#EEC373';
                    if (icon) {
                        icon.style.color = '#EEC373';
                    }
                } else {
                    card.style.backgroundColor = '#1a1a1a';
                    if (icon) {
                        icon.style.color = '#1a1a1a';
                    }
                }

                // Update line position and height to connect icons
                if (index < milestoneRows.length - 1) {
                    const currentIcon = row.querySelector('i');
                    const nextRow = milestoneRows[index + 1];
                    const nextIcon = nextRow.querySelector('i');
                    const line = lines[index];

                    if (currentIcon && nextIcon && line) {
                        const currentIconRect = currentIcon.getBoundingClientRect();
                        const nextIconRect = nextIcon.getBoundingClientRect();
                        const milestoneRect = document.querySelector('.milestone').getBoundingClientRect();

                        // Calculate from center of current icon
                        const startY = (currentIconRect.top + currentIconRect.height / 2) - milestoneRect.top;
                        const endY = (nextIconRect.top + nextIconRect.height / 2) - milestoneRect.top;
                        const maxHeight = endY - startY;

                        // Align line horizontally with the center of the icons
                        const iconCenterX = currentIconRect.left + (currentIconRect.width / 2) - milestoneRect.left;
                        line.style.left = `${iconCenterX}px`;
                        line.style.top = `${startY}px`;

                        // Dynamic line height based on scroll position
                        const nextIconTop = nextIcon.getBoundingClientRect().top;
                        let heightPercentage = 10;
                        if (nextIconTop > triggerPoint) {
                            // Calculate how close the next icon is to the trigger point
                            const distanceToTrigger = nextIconTop - triggerPoint;
                            const maxDistance = (window.innerHeight / 2) - 300;
                            heightPercentage = Math.max(0, 1 - distanceToTrigger / maxDistance);
                        } else {
                            heightPercentage = 1; // Full height when next icon reaches trigger point
                        }
                        const lineHeight = maxHeight * heightPercentage;
                        line.style.height = `${lineHeight}px`;
                        line.style.display = 'block';
                    }
                }
            });
        });
    </script>
</div>