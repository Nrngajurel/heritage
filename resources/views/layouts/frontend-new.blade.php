
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Something - Heritage Pageants</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/css/pageant.css', 'resources/js/app.js'])
</head>


<body class="min-h-screen bg-gray-900 text-gray-100 antialiased" >

    <div class="crown-bg fixed inset-0 opacity-10"></div>


    <!-- Navigation -->
    <nav class="border-gold/20 fixed z-50 w-full border-b bg-gray-900/95 backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex items-center">
                    <a href="/" class="pageant-heading text-xl font-bold">Heritage Pageants</a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="/" class="hover:text-gold text-gray-300 transition">Home</a>
                    <a href="/gallery" class="hover:text-gold text-gray-300 transition">Gallery</a>
                    <a href="/events" class="hover:text-gold text-gray-300 transition">Events</a>
                    <a href="/vote" class="text-gold font-semibold">Vote</a>
                    <a href="/contact" class="hover:text-gold text-gray-300 transition">Contact</a>
                </div>
            </div>
        </div>
    </nav>



    @yield('content')


<wireui:scripts />

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
