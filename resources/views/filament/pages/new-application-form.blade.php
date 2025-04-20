<div class="min-h-screen py-0 md:py-12">

    @error('form')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror

    <!-- Submitting Overlay -->
    <div wire:loading.delay
    wire:target="submit"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80 backdrop-blur-md">
        <!-- Shimmering Gradient Ring -->
        <div class="relative">
            <div
                class="absolute inset-0 animate-pulse rounded-full bg-gradient-to-tr from-pink-500/20 via-purple-500/20 to-fuchsia-500/20 blur-xl">
            </div>

            <!-- Spinner & Text -->
            <div class="relative z-10 flex flex-col items-center space-y-6 px-6 py-10 text-white">
                <!-- Custom Spinner -->
                <div class="h-16 w-16 animate-spin rounded-full border-4 border-pink-500 border-t-transparent"></div>

                <!-- Elegant Heading -->
                <div class="text-center">
                    <h2 class="text-2xl font-semibold tracking-wider text-pink-300">Hold on, gorgeous ✨</h2>
                    <p class="mt-2 text-sm text-gray-300">We’re submitting your stunning application...</p>
                </div>
            </div>
        </div>
    </div>
    @if ($submitted)
        <div x-init="window.scrollTo(0, 0)">
            <div class="flex items-center justify-center rounded-lg bg-white p-10 shadow">
                <div>
                    <svg class="mx-auto mb-4 h-20 w-20 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2 class="mb-4 text-center text-2xl font-bold text-gray-800">Application
                        Submitted
                        Success
                    </h2>
                    <div class="mb-8 text-gray-600">
                        Thank you. We have sent you an email
                        about status of the application
                    </div>
                    <button type="button" @click="window.location.reload()"
                        class="mx-auto block w-40 rounded-lg border bg-white px-5 py-2 text-center font-medium text-gray-600 shadow-sm hover:bg-gray-100 focus:outline-none">Back
                        to home</button>
                </div>
            </div>
        </div>
    @else
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="space-y-6">

                    <form wire:submit.prevent="submit">
                        {{ $this->form }}
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- @push('scripts')
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
@endpush  --}}
