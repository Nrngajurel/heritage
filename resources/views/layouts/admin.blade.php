<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @livewireStyles
</head>

<body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');
    setColors(color);" :class="{ 'dark': isDark }" @resize.window="watchScreen()" x-cloak>
        <div class="dark:bg-dark dark:text-light flex h-screen bg-gray-100 text-gray-900 antialiased">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="bg-red-darker fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white">
                Loading.....
            </div>

            <!-- Sidebar -->
            <!-- Backdrop -->
            <div x-show="isSidebarOpen" @click="isSidebarOpen = false"
                class="bg-red-darker fixed inset-0 z-10 lg:hidden" style="opacity: 0.5" aria-hidden="true"></div>

            <!-- Sidebar content -->
            <aside x-show="isSidebarOpen" x-transition:enter="transition-all transform duration-300 ease-in-out"
                x-transition:enter-start="-translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition-all transform duration-300 ease-in-out"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="-translate-x-full opacity-0" x-ref="sidebar"
                @keydown.escape="window.innerWidth <= 1024 ? isSidebarOpen = false : ''" tabindex="-1"
                class="dark:border-red-darker dark:bg-darker fixed inset-y-0 z-10 flex flex-shrink-0 overflow-hidden border-r bg-white focus:outline-none lg:static">
                <!-- Mini column -->
                <div class="dark:border-red-darker flex h-full flex-shrink-0 flex-col border-r px-2 py-4">
                    <!-- Brand -->
                    <div class="flex-shrink-0">
                        <a href="../index.html"
                            class="text-red-dark dark:text-light inline-block text-xl font-bold uppercase tracking-wider">
                            MH
                        </a>
                    </div>
                    <div class="flex flex-1 flex-col items-center justify-center space-y-4">
                        <!-- Notification button -->
                        <button @click="openNotificationsPanel"
                            class="text-red-lighter hover:text-red dark:hover:text-light dark:hover:bg-red-dark dark:bg-dark dark:focus:bg-red-dark focus:ring-red-darker rounded-full bg-red-50 p-2 transition-colors duration-200 hover:bg-red-100 focus:bg-red-100 focus:outline-none">
                            <span class="sr-only">Open Notification panel</span>
                            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>

                        <!-- Search button -->
                        <button @click="openSearchPanel"
                            class="text-red-lighter hover:text-red dark:hover:text-light dark:hover:bg-red-dark dark:bg-dark dark:focus:bg-red-dark focus:ring-red-darker rounded-full bg-red-50 p-2 transition-colors duration-200 hover:bg-red-100 focus:bg-red-100 focus:outline-none">
                            <span class="sr-only">Open search panel</span>
                            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>

                        <!-- Settings button -->
                        <button @click="openViewDetailPanel"
                            class="text-red-lighter hover:text-red dark:hover:text-light dark:hover:bg-red-dark dark:bg-dark dark:focus:bg-red-dark focus:ring-red-darker rounded-full bg-red-50 p-2 transition-colors duration-200 hover:bg-red-100 focus:bg-red-100 focus:outline-none">
                            <span class="sr-only">Open settings panel</span>
                            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    <!-- Mini column footer -->
                    <div class="relative flex flex-shrink-0 items-center justify-center">
                        <!-- User avatar button -->
                        <div class="" x-data="{ open: false }">
                            <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                class="block rounded-full transition-opacity duration-200 focus:outline-none focus:ring dark:opacity-75 dark:hover:opacity-100 dark:focus:opacity-100">
                                <span class="sr-only">User menu</span>
                                <img class="h-10 w-10 rounded-full" src="https://placehold.co/400"
                                    alt="Ahmed Kamel" />
                            </button>

                            <!-- User dropdown menu -->
                            <div x-show="open" x-ref="userMenu" x-transition:enter="transition-all transform ease-out"
                                x-transition:enter-start="-translate-y-1/2 opacity-0"
                                x-transition:enter-end="translate-y-0 opacity-100"
                                x-transition:leave="transition-all transform ease-in"
                                x-transition:leave-start="translate-y-0 opacity-100"
                                x-transition:leave-end="-translate-y-1/2 opacity-0" @click.away="open = false"
                                @keydown.escape="open = false"
                                class="dark:bg-dark absolute bottom-full left-5 mb-4 w-56 min-w-max rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                                <a wire:navigate href="{{ route('profile.show') }}" role="menuitem"
                                    class="dark:text-light dark:hover:bg-red block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100">
                                    Your Profile
                                </a>
                                <a href="#" role="menuitem"
                                    class="dark:text-light dark:hover:bg-red block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100">
                                    Settings
                                </a>
                                <a href="#" role="menuitem"
                                    class="dark:text-light dark:hover:bg-red block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar links -->
                <nav aria-label="Main"
                    class="w-64 flex-1 space-y-2 overflow-y-hidden px-2 py-4 hover:overflow-y-auto">

                    @php
                        $menus = [
                            [
                                'icon' => 'home',
                                'name' => 'Dashboard',
                                'link' => route('dashboard'),
                            ],
                            [
                                'icon' => 'calendar',
                                'name' => 'Events',
                                'link' => route('admin.events.index'),
                            ],
                            [
                                'icon' => 'users',
                                'name' => 'Applications',
                                'link' => route('admin.applications.index'),
                            ],
                            [
                                'icon' => 'users',
                                'name' => 'Participants',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'check-circle',
                                'name' => 'Approve Participants',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'thumbs-up',
                                'name' => 'Voting',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'file-text',
                                'name' => 'Posts',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'file',
                                'name' => 'Pages',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'image',
                                'name' => 'Slider',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'settings',
                                'name' => 'Settings',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'sliders',
                                'name' => 'Configuration',
                                'link' => '#',
                            ],
                            [
                                'icon' => 'more-horizontal',
                                'name' => 'More',
                                'link' => '#',
                            ],
                        ];
                    @endphp
                    @foreach ($menus as $menu)
                        <a wire:navigate href="{{ $menu['link'] }}"
                            class="dark:text-light dark:hover:bg-red flex items-center rounded-md p-2 text-gray-500 transition-colors hover:bg-red-100"
                            role="button" aria-haspopup="true"
                            :aria-expanded="(open || isActive) ? 'true' : 'false'">
                            <span aria-hidden="true">

                                <i data-feather="{{ $menu['icon'] }}"></i>
                            </span>
                            <span class="ml-2 text-sm"> {{ $menu['name'] }} </span>
                        </a>
                    @endforeach


                </nav>
            </aside>

            <!-- Sidebar button -->
            <div class="fixed right-10 top-5 z-50 flex items-center space-x-4 lg:hidden">
                <button @click="isSidebarOpen = !isSidebarOpen; $nextTick(() => { $refs.sidebar.focus() })"
                    class="text-red-lighter hover:text-red dark:hover:text-light dark:hover:bg-red-dark dark:bg-dark rounded-md bg-red-50 p-1 transition-colors duration-200 hover:bg-red-100 focus:outline-none focus:ring">
                    <span class="sr-only">Toggle main manu</span>
                    <span aria-hidden="true">
                        <svg x-show="!isSidebarOpen" class="h-8 w-8" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="isSidebarOpen" class="h-8 w-8" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </button>
            </div>

            <!-- Main content -->
            <main class="w-100 relative flex-1 overflow-hidden">
                <div
                    class="sticky h-[70px] border-b border-gray-100 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
                </div>
                <div class="p-2 md:p-5">

                    {{ $slot }}
                </div>

            </main>

            <!-- Panels -->

            <!-- Settings Panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                x-show="isViewDetailPanelOpen" @click="isViewDetailPanelOpen = false"
                class="bg-red-darker fixed inset-0 z-10" style="opacity: 0.5" aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                x-ref="settingsPanel" tabindex="-1" x-show="isViewDetailPanelOpen"
                @keydown.escape="isViewDetailPanelOpen = false"
                class="dark:bg-darker dark:text-light fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl focus:outline-none sm:max-w-md"
                aria-labelledby="settinsPanelLabel">
                <div class="absolute left-0 -translate-x-full transform p-2">
                    <!-- Close button -->
                    <button @click="isViewDetailPanelOpen = false"
                        class="rounded-md p-2 text-white focus:outline-none focus:ring">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Panel content -->
                <div class="flex h-screen flex-col">
                    <!-- Panel header -->
                    <div
                        class="dark:border-red-dark flex flex-shrink-0 flex-col items-center justify-center space-y-4 border-b px-4 py-8">
                        <span aria-hidden="true" class="dark:text-red text-gray-500">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
                        <h2 id="settinsPanelLabel" class="dark:text-light text-xl font-medium text-gray-500">Settings
                        </h2>
                    </div>
                    <!-- Content -->
                    <div class="flex-1 overflow-hidden hover:overflow-y-auto">
                        <!-- Theme -->
                        <div class="space-y-4 p-4 md:p-8">
                            <h6 class="dark:text-light text-lg font-medium text-gray-400">Mode</h6>
                            <div class="flex items-center space-x-8">
                                <!-- Light button -->
                                <button @click="setLightTheme"
                                    class="dark:border-red dark:hover:border-red-light focus:ring-red-lighter dark:focus:ring-offset-dark dark:focus:ring-red-dark flex items-center justify-center space-x-4 rounded-md border px-4 py-2 transition-colors hover:border-gray-900 hover:text-gray-900 focus:outline-none focus:ring focus:ring-offset-2 dark:hover:text-red-100"
                                    :class="{
                                        'border-gray-900 text-gray-900 dark:border-red-light dark:text-red-100': !
                                            isDark,
                                        'text-gray-500 dark:text-red-light': isDark
                                    }">
                                    <span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </span>
                                    <span>Light</span>
                                </button>

                                <!-- Dark button -->
                                <button @click="setDarkTheme"
                                    class="dark:border-red dark:hover:border-red-light focus:ring-red-lighter dark:focus:ring-offset-dark dark:focus:ring-red-dark flex items-center justify-center space-x-4 rounded-md border px-4 py-2 transition-colors hover:border-gray-900 hover:text-gray-900 focus:outline-none focus:ring focus:ring-offset-2 dark:hover:text-red-100"
                                    :class="{
                                        'border-gray-900 text-gray-900 dark:border-red-light dark:text-red-100': isDark,
                                        'text-gray-500 dark:text-red-light':
                                            !isDark
                                    }">
                                    <span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                        </svg>
                                    </span>
                                    <span>Dark</span>
                                </button>
                            </div>
                        </div>

                        <!-- Colors -->
                        <div class="space-y-4 p-4 md:p-8">
                            <h6 class="dark:text-light text-lg font-medium text-gray-400">Colors</h6>
                            <div>
                                <button @click="setColors('cyan')" class="h-10 w-10 rounded-full"
                                    style="background-color: var(--color-cyan)"></button>
                                <button @click="setColors('teal')" class="h-10 w-10 rounded-full"
                                    style="background-color: var(--color-teal)"></button>
                                <button @click="setColors('green')" class="h-10 w-10 rounded-full"
                                    style="background-color: var(--color-green)"></button>
                                <button @click="setColors('fuchsia')" class="h-10 w-10 rounded-full"
                                    style="background-color: var(--color-fuchsia)"></button>
                                <button @click="setColors('blue')" class="h-10 w-10 rounded-full"
                                    style="background-color: var(--color-blue)"></button>
                                <button @click="setColors('violet')" class="h-10 w-10 rounded-full"
                                    style="background-color: var(--color-violet)"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Notification panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                x-show="isNotificationsPanelOpen" @click="isNotificationsPanelOpen = false"
                class="bg-red-darker fixed inset-0 z-10" style="opacity: 0.5" aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-ref="notificationsPanel" x-show="isNotificationsPanelOpen"
                @keydown.escape="isNotificationsPanelOpen = false" tabindex="-1"
                aria-labelledby="notificationPanelLabel"
                class="dark:bg-darker dark:text-light fixed inset-y-0 z-20 w-full max-w-xs bg-white focus:outline-none sm:max-w-md">
                <div class="absolute right-0 translate-x-full transform p-2">
                    <!-- Close button -->
                    <button @click="isNotificationsPanelOpen = false"
                        class="rounded-md p-2 text-white focus:outline-none focus:ring">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex h-screen flex-col" x-data="{ activeTabe: 'action' }">
                    <!-- Panel header -->
                    <div class="flex-shrink-0">
                        <div class="dark:border-red-darker flex items-center justify-between border-b px-4 pt-4">
                            <h2 id="notificationPanelLabel" class="pb-4 font-semibold">Notifications</h2>
                            <div class="space-x-2">
                                <button @click.prevent="activeTabe = 'action'"
                                    class="translate-y-px transform border-b px-px pb-4 transition-all duration-200 focus:outline-none"
                                    :class="{
                                        'border-red-dark dark:border-red': activeTabe ==
                                            'action',
                                        'border-transparent': activeTabe != 'action'
                                    }">
                                    Action
                                </button>
                                <button @click.prevent="activeTabe = 'user'"
                                    class="translate-y-px transform border-b px-px pb-4 transition-all duration-200 focus:outline-none"
                                    :class="{
                                        'border-red-dark dark:border-red': activeTabe ==
                                            'user',
                                        'border-transparent': activeTabe != 'user'
                                    }">
                                    User
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Panel content (tabs) -->
                    <div class="flex-1 overflow-y-hidden pt-4 hover:overflow-y-auto">
                        <!-- Action tab -->
                        <div class="space-y-4" x-show.transition.in="activeTabe == 'action'">
                            <p class="px-4">Action tab content</p>
                            <!--  -->
                            <!-- Action tab content -->
                            <!--  -->
                        </div>

                        <!-- User tab -->
                        <div class="space-y-4" x-show.transition.in="activeTabe == 'user'">
                            <p class="px-4">User tab content</p>
                            <!--  -->
                            <!-- User tab content -->
                            <!--  -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- Search panel -->
            <!-- Backdrop -->
            <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="isSearchPanelOpen"
                @click="isSearchPanelOpen = false" class="bg-red-darker fixed inset-0 z-10" style="opacity: 0.5"
                aria-hidden="ture"></div>
            <!-- Panel -->
            <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-show="isSearchPanelOpen" @keydown.escape="isSearchPanelOpen = false"
                class="dark:bg-darker dark:text-light fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl focus:outline-none sm:max-w-md">
                <div class="absolute right-0 translate-x-full transform p-2">
                    <!-- Close button -->
                    <button @click="isSearchPanelOpen = false"
                        class="rounded-md p-2 text-white focus:outline-none focus:ring">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <h2 class="sr-only">Search panel</h2>
                <!-- Panel content -->
                <div class="flex h-screen flex-col">
                    <!-- Panel header (Search input) -->
                    <div
                        class="dark:border-red-darker dark:focus-within:text-light relative flex-shrink-0 border-b px-4 py-8 text-gray-400 focus-within:text-gray-700">
                        <span class="absolute inset-y-0 inline-flex items-center px-4">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input x-ref="searchInput" type="text"
                            class="dark:bg-dark dark:text-light w-full rounded-full border py-2 pl-10 pr-4 focus:outline-none focus:ring dark:border-transparent"
                            placeholder="Search..." />
                    </div>

                    <!-- Panel content (Search result) -->
                    <div class="h flex-1 space-y-4 overflow-y-hidden px-4 pb-4 hover:overflow-y-auto">
                        <h3 class="dark:text-light py-2 text-sm font-semibold text-gray-600">History</h3>
                        <p class="px=4">Search resault</p>
                        <!--  -->
                        <!-- Search content -->
                        <!--  -->
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        feather.replace();
    </script>

    @stack('modals')
<wireui:scripts />
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" data-navigate-once></script>
    <script src="{{asset('admin.js')}}" data-navigate-once></script>
</body>

</html>
