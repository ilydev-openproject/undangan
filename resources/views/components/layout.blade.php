<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fade-1 {
            5% {
                opacity: 1;
                z-index: 10;
                transform: scale(1);
            }

            20% {
                opacity: 1;
                transform: scale(1.1);
            }

            25% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }

            100% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }
        }

        @keyframes fade-2 {

            0%,
            20% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }

            25% {
                opacity: 1;
                z-index: 10;
                transform: scale(1);
            }

            45% {
                opacity: 1;
                transform: scale(1.1);
            }

            49% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }

            100% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }
        }

        @keyframes fade-3 {

            0%,
            40% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }

            50% {
                opacity: 1;
                z-index: 10;
                transform: scale(1);
            }

            70% {
                opacity: 1;
                transform: scale(1.1);
            }

            74% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }

            100% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }
        }

        @keyframes fade-4 {

            0%,
            70% {
                opacity: 0;
                z-index: 0;
                transform: scale(1.1);
            }

            75% {
                opacity: 1;
                z-index: 10;
                transform: scale(1);
            }

            98% {
                opacity: 1;
                transform: scale(1.2);
            }

            100% {
                opacity: 0;
                transform: scale(1.2);
            }


            /* start ulang fade-1 tanpa kedip */
        }

        .animate-fade-1 {
            animation: fade-1 50s linear infinite;
        }

        .animate-fade-2 {
            animation: fade-2 50s linear infinite;
        }

        .animate-fade-3 {
            animation: fade-3 50s linear infinite;
        }

        .animate-fade-4 {
            animation: fade-4 50s linear infinite;
        }
    </style>
</head>

<body>
    <div class="container max-w-lg bg-amber-200 mx-auto min-h-screen overflow-x-hidden">
        <header></header>
        <main>
            {{ $slot }}
        </main>
        <footer></footer>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>