            @if ($record)
                <div class="p-5">
                    <div>
                        <h2 class="text-xl font-semibold">Basic Information</h2>
                        <div class="grid grid-cols-4 gap-2">
                            <div>
                                <label class="block font-medium">Country</label>
                                <p class="mt-1">{{ $record['country'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Competition Name</label>
                                <p class="mt-1">{{ $record->competition?->name }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Full Name</label>
                                <p class="mt-1">{{ $record['first_name'] }} {{ $record['last_name'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Email</label>
                                <p class="mt-1">{{ $record['email'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">Phone</label>
                                <p class="mt-1">{{ $record['phone'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mt-5">
                        <h2 class="text-xl font-semibold">Address</h2>
                        <div class="grid grid-cols-4 gap-2">
                            <div>
                                <label class="block font-medium">Address Line 1</label>
                                <p class="mt-1">{{ $record['address']['address_line_1'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">City</label>
                                <p class="mt-1">{{ $record['address']['city'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">State</label>
                                <p class="mt-1">{{ $record['address']['state'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium">ZIP Code</label>
                                <p class="mt-1">{{ $record['address']['zip'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Meta Information -->

                    <div class="mt-5">
                        <h2 class="text-xl font-semibold">PERSONAL BACKGROUND</h2>
                        <div class="grid grid-cols-3 gap-2">

                            @foreach ($record['meta']['personal_background'] as $subKey => $subValue)
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
                            @foreach ($record['meta']['outlook'] as $subKey => $subValue)
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
                            @foreach ($record['meta']['more'] as $subKey => $subValue)
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
                            <p class="mt-1 border-b-2 p-3">{!! nl2br($record['meta']['personal_statement']) !!}</p>
                        </div>

                    </div>
                    <div class="grid grid-cols-3 gap-2">

                        <div class="mt-5">
                            <label class="block font-medium">HeadShot</label>
                            {{ $this->record->getFirstMedia('headshot_photo') }}

                        </div>
                        <div class="mt-5">
                            <label class="block font-medium">Waist up photo</label>
                            {{ $this->record->getFirstMedia('waist_up_photo') }}

                        </div>
                        <div class="mt-5">
                            <label class="block font-medium">Passport Copy</label>
                            {{ $this->record->getFirstMedia('passport_copy') }}

                        </div>
                    </div>

                </div>

            @endif
