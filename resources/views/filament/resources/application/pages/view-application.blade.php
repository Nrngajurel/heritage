@if ($record)
    <div class="p-5">
        <style>
            td {
                padding: 1rem 0;
            }
        </style>
        <center>
            <h1 class="text-3xl font-bold">Application Form</h1>
        </center>
        <div>
            <h2 class="text-xl font-semibold">Basic Information</h2>
            <table style="width: 100%">
                <tr>
                    <td>
                        <label class="block font-medium">Country</label>
                        <p class="mt-1">{{ $record['country'] }}</p>
                    </td>
                    <td>
                        <label class="block font-medium">Competition Name</label>
                        <p class="mt-1">{{ $record->competition?->name }}</p>
                    </td>
                    <td>
                        <label class="block font-medium">Full Name</label>
                        <p class="mt-1">{{ $record['first_name'] }} {{ $record['last_name'] }}</p>
                    </td>
                    <td>
                        <label class="block font-medium">Email</label>
                        <p class="mt-1">{{ $record['email'] }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="block font-medium">Phone</label>
                        <p class="mt-1">{{ $record['phone'] }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" style="padding-bottom: 0">Address</td>
                </tr>
                <tr>
                    <td>
                        <label class="block font-medium">Address Line 1</label>
                        <p class="mt-1">{{ $record['address']['address_line_1'] }}</p>
                    </td>
                    <td>
                        <label class="block font-medium">City</label>
                        <p class="mt-1">{{ $record['address']['city'] }}</p>
                    </td>
                    <td>
                        <label class="block font-medium">State</label>
                        <p class="mt-1">{{ $record['address']['state'] }}</p>
                    </td>
                    <td>
                        <label class="block font-medium">ZIP Code</label>
                        <p class="mt-1">{{ $record['address']['zip'] }}</p>
                    </td>

                </tr>
            </table>
        </div>

        <!-- Dynamic Meta Information -->

        <div class="mt-5">
            <h2 class="text-xl font-semibold">PERSONAL BACKGROUND</h2>
            <div>

                @foreach ($record['meta']['personal_background'] as $subKey => $subValue)
                    <div class="mt-2" style="min-width: 33%; display: inline-block">
                        <label class="block font-medium">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
                        <p class="mt-1 border-b-2 p-3">{!! nl2br($subValue) !!}</p>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="mt-5">
            <h2 class="text-xl font-semibold">OUTLOOK</h2>
            <div>
                @foreach ($record['meta']['outlook'] as $subKey => $subValue)
                    <div style="width: 100%; display: inline-block">
                        <label class="block font-medium">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
                        <p class="mt-1 border-b-2 p-3">{!! nl2br($subValue) !!}</p>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="mt-5">
            <h2 class="text-xl font-semibold">MORE</h2>
            <div>
                @foreach ($record['meta']['more'] as $subKey => $subValue)
                    <div style="min-width: 33%; display: inline-block">
                        <label class="block font-medium">{{ ucwords(str_replace('_', ' ', $subKey)) }}</label>
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
        <table style="width: 100%">

            <tr>
                <td class="mt-5">
                    <label class="block font-medium">HeadShot</label>
                    @isset($exportPdf)
                        <img  style="width:100%" src="{{ $record->getFirstMedia('headshot_photo')?->getPath() }}" />
                    @else
                        {{ $record->getFirstMedia('headshot_photo') }}
                    @endisset

                </td>
                <td class="mt-5">
                    <label class="block font-medium">Waist up photo</label>
                    @isset($exportPdf)
                        <img style="width:100%" src="{{ $record->getFirstMedia('waist_up_photo')?->getPath() }}" />
                    @else
                        {{ $record->getFirstMedia('waist_up_photo') }}
                    @endisset

                </td>
                <td class="mt-5">
                    <label class="block font-medium">Passport Copy</label>
                    @isset($exportPdf)
                        <img  style="width:100%" src="{{ $record->getFirstMedia('passport_copy')?->getPath() }}" />
                    @else
                        {{ $record->getFirstMedia('passport_copy') }}
                    @endisset

                </td>
            </tr>
        </table>

    </div>

@endif
