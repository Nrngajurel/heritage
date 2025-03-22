<div class="min-h-screen bg-gray-100 py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="space-y-6 p-6">
                <div class="mb-8 text-center">
                    <h1 class="text-2xl font-bold">{{ $event->name }}</h1>
                    <div>Application Form</div>
                    <div class="text-sm">Form Close Date: {{ $event->form_end_date->format('M d, Y') }}</div>
                </div>

                @if(config('app.debug'))
                    <div class="mb-4 rounded bg-gray-100 p-4">
                        <p class="font-mono text-sm">Current Form State:</p>
                        <pre>{{ json_encode($this->data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @dump($errors->all())
                @endif

                <form wire:submit.prevent="submit">
                    {{ $this->form }}
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
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
@endpush 