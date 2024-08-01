<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.3.2/build/css/intlTelInput.css">
    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="antialiased">

    @php
        $start_date = \Carbon\Carbon::parse($event->voting_start_date);
    @endphp
    <h1 class="text-center text-2xl font-bold">{{ $event->name }}</h1>
    <div class="text-center text-sm">Voting Start From: {{ $start_date->format('m D Y') }} </div>
    <div class="mt-4 flex items-center justify-center space-x-4" x-data="timer({{$start_date->timestamp*1000}})" x-init="init();">
        <div class="flex flex-col items-center px-4">
            <span x-text="time().days" class="text-4xl text-gray-200 lg:text-5xl">00</span>
            <span class="mt-2 text-gray-400">Days</span>
        </div>
        <span class="h-24 w-[1px] bg-gray-400"></span>
        <div class="flex flex-col items-center px-4">
            <span x-text="time().hours" class="text-4xl text-gray-200 lg:text-5xl">23</span>
            <span class="mt-2 text-gray-400">Hours</span>
        </div>
        <span class="h-24 w-[1px] bg-gray-400"></span>
        <div class="flex flex-col items-center px-4">
            <span x-text="time().minutes" class="text-4xl text-gray-200 lg:text-5xl">59</span>
            <span class="mt-2 text-gray-400">Minutes</span>
        </div>
        <span class="h-24 w-[1px] bg-gray-400"></span>
        <div class="flex flex-col items-center px-4">
            <span x-text="time().seconds" class="text-4xl text-gray-200 lg:text-5xl">28</span>
            <span class="mt-2 text-gray-400">Seconds</span>
        </div>
    </div>

    <!-- Extra Large Modal -->


    <div id="extralarge-modal" tabindex="-1"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 transition delay-150 ease-in-out md:inset-0">
        <div class="relative max-h-full w-full max-w-7xl">
            <!-- Modal content -->
            <div class="relative bg-white shadow dark:bg-gray-700">
                <!-- Modal header -->

                <button type="button"
                    class="fixed right-2 top-2 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="extralarge-modal">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <!-- Modal body -->
                <div class="">
                    <div class="flex">
                        <div class="w-1/2">


                            <div id="controls-carousel" class="relative w-full" data-carousel="static">
                                <!-- Carousel wrapper -->
                                <div class="relative h-56 overflow-hidden md:h-96">
                                    <!-- Item 1 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="https://mrsheritageinternational.com/wp-content/uploads/2023/08/WhatsApp-Image-2023-09-11-at-8.51.03-AM.jpeg"
                                            class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 2 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                                        <img src="https://mrsheritageinternational.com/wp-content/uploads/2023/08/WhatsApp-Image-2023-09-11-at-8.51.03-AM.jpeg"
                                            class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 3 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="https://mrsheritageinternational.com/wp-content/uploads/2023/08/WhatsApp-Image-2023-09-11-at-8.51.03-AM.jpeg"
                                            class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 4 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="https://mrsheritageinternational.com/wp-content/uploads/2023/08/WhatsApp-Image-2023-09-11-at-8.51.03-AM.jpeg"
                                            class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 5 -->
                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                        <img src="https://mrsheritageinternational.com/wp-content/uploads/2023/08/WhatsApp-Image-2023-09-11-at-8.51.03-AM.jpeg"
                                            class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2"
                                            alt="...">
                                    </div>
                                </div>
                                <!-- Slider controls -->
                                <button type="button"
                                    class="group absolute start-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
                                    data-carousel-prev>
                                    <span
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                                        <svg class="h-4 w-4 text-white dark:text-gray-800 rtl:rotate-180"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 1 1 5l4 4" />
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                <button type="button"
                                    class="group absolute end-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
                                    data-carousel-next>
                                    <span
                                        class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
                                        <svg class="h-4 w-4 text-white dark:text-gray-800 rtl:rotate-180"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </button>
                            </div>

                        </div>
                        <div class="w-1/2">

                        </div>

                    </div>
                </div>
                <!-- Modal footer -->

            </div>
        </div>
    </div>

    <div
        class="bg-dots-darker dark:bg-dots-lighter relative min-h-screen bg-gray-100 bg-center selection:bg-red-500 selection:text-white dark:bg-gray-900 sm:flex sm:items-center sm:justify-center">
        <div class="mx-auto w-full p-6 lg:p-8">

            <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <!-- First Card -->

                @foreach (range(0, 7) as $item)
                    <div class="overflow-hidden rounded-lg bg-white shadow-lg" data-modal-target="extralarge-modal"
                        data-modal-toggle="extralarge-modal">

                        <div class="relative">
                            <img src="https://mrsheritageinternational.com/wp-content/uploads/2023/08/WhatsApp-Image-2023-09-11-at-8.51.03-AM.jpeg"
                                alt="Cover Image" class="h-36 w-full object-cover">
                        </div>

                        <div class="-mt-20 flex items-center justify-center space-x-2">
                            <img src="https://mrsheritageinternational.com/wp-content/uploads/2023/08/Miss-Australia.jpg"
                                alt="Country Image" class="z-10 h-32 w-32 rounded-full object-cover shadow">
                            </svg>
                        </div>
                        <div class="p-4">
                            <div class="mt-2 text-lg font-semibold">
                                MISS HERITAGE AUSTRALIA
                            </div>
                            <div class="mt-1 text-red-500">
                                You Already Participated!
                            </div>
                            <div class="mt-4">
                                <div class="relative w-full rounded bg-gray-200">
                                    <div class="absolute left-0 top-0 h-full bg-gradient-to-r from-orange-400 to-red-500"
                                        style="width:0%;"></div>
                                    <div class="absolute left-0 top-0 flex h-full items-center justify-center text-sm text-white"
                                        style="width:0%;">
                                        0%
                                    </div>
                                </div>
                                <div class="mt-2 flex justify-between text-sm text-gray-600">
                                    <span>0%</span>
                                    <span>471 / 166.5k</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Second Card -->

            </div>




        </div>
    </div>

    <wireui:scripts />
    <script src="//unpkg.com/alpinejs" defer></script>

    <script>
        function timer(expiry) {
            return {
                expiry: expiry,
                remaining: null,
                init() {
                    this.setRemaining()
                    setInterval(() => {
                        this.setRemaining();
                    }, 1000);
                },
                setRemaining() {
                    const diff = this.expiry - new Date().getTime();
                    this.remaining = parseInt(diff / 1000);
                },
                days() {
                    return {
                        value: this.remaining / 86400,
                        remaining: this.remaining % 86400
                    };
                },
                hours() {
                    return {
                        value: this.days().remaining / 3600,
                        remaining: this.days().remaining % 3600
                    };
                },
                minutes() {
                    return {
                        value: this.hours().remaining / 60,
                        remaining: this.hours().remaining % 60
                    };
                },
                seconds() {
                    return {
                        value: this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time() {
                    return {
                        days: this.format(this.days().value),
                        hours: this.format(this.hours().value),
                        minutes: this.format(this.minutes().value),
                        seconds: this.format(this.seconds().value),
                    }
                },
            }
        }
    </script>
</body>

</html>
