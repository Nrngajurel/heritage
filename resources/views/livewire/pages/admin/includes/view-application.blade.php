<div>
    <x-modal name="viewDetailModal" maxWidth="">
        <x-card title="View Detail">
            @if ($application)
                <div class="p-5">
                    <div>
                        <h2 class="text-xl font-semibold">Basic Information</h2>
                        <div class="grid grid-cols-4 gap-2">
                            <div>
                                <label class="block font-medium">Country</label>
                                <p class="mt-1">{{ $application['country'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Full Name</label>
                                <p class="mt-1">{{ $application['first_name'] }} {{ $application['last_name'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Email</label>
                                <p class="mt-1">{{ $application['email'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Phone</label>
                                <p class="mt-1">{{ $application['phone'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mt-5">
                        <h2 class="text-xl font-semibold">Address</h2>
                        <div class="grid grid-cols-4 gap-2">
                            <div>
                                <label class="block font-medium">Address Line 1</label>
                                <p class="mt-1">{{ $application['address']['address_line_1'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">City</label>
                                <p class="mt-1">{{ $application['address']['city'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">State</label>
                                <p class="mt-1">{{ $application['address']['state'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">ZIP Code</label>
                                <p class="mt-1">{{ $application['address']['zip'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Meta Information -->

                    <div class="mt-5">
                        <h2 class="text-xl font-semibold">PERSONAL BACKGROUND</h2>
                        <div class="grid grid-cols-3 gap-2">

                            @foreach ($application['meta']['personal_background'] as $subKey => $subValue)
                                <div class="mt-2">
                                    <label
                                        class="block font-medium">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
                                    <p class="mt-1 border-b-2 p-3">{!! nl2br($subValue) !!}</p>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="mt-5">
                        <h2 class="text-xl font-semibold">OUTLOOK</h2>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ($application['meta']['outlook'] as $subKey => $subValue)
                                <div class="mt-2">
                                    <label
                                        class="block font-medium">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
                                    <p class="mt-1 border-b-2 p-3">{!! nl2br($subValue) !!}</p>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="mt-5">
                        <h2 class="text-xl font-semibold">MORE</h2>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ($application['meta']['more'] as $subKey => $subValue)
                                <div class="mt-2">
                                    <label
                                        class="block font-medium">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
                                    <p class="mt-1 border-b-2 p-3">{!! nl2br($subValue) !!}</p>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="mt-5">
                        <h2 class="text-xl font-semibold">PERSONAL STATEMENT</h2>


                        <div class="mt-2">
                            <label class="block font-medium">Personal Statement</label>
                            <p class="mt-1 border-b-2 p-3">{!! nl2br($application['meta']['personal_statement']) !!}</p>
                        </div>

                    </div>
                    <div class="grid grid-cols-3 gap-2">

                        <div class="mt-5">
                            <label class="block font-medium">HeadShot</label>
                            {{ $this->application->getFirstMedia('headshot_photo') }}

                        </div>
                        <div class="mt-5">
                            <label class="block font-medium">Waist up photo</label>
                            {{ $this->application->getFirstMedia('waist_up_photo') }}

                        </div>
                        <div class="mt-5">
                            <label class="block font-medium">Passport Copy</label>
                            {{ $this->application->getFirstMedia('passport_copy') }}

                        </div>
                    </div>

                </div>

            @endif
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />

                <x-button primary label="Approve" wire:click="approve" />
            </x-slot>
        </x-card>
    </x-modal>
</div>
