<div>
    @php
    $records = $records ?? [$record];
@endphp
@foreach ($records as $record)
@if ($record)
<div class="application-form">
    <style>
        /* DOMPDF-safe CSS */
        .application-form {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 10px;
            page-break-after: always;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .section {
            margin: 10px 0;
            page-break-inside: avoid;
        }

        .section h2 {
            font-size: 13px;
            font-weight: bold;
            color: #444;
            margin: 8px 0;
            padding-bottom: 4px;
            border-bottom: 1px solid #eee;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }

        .data-table td {
            padding: 6px 4px;
            vertical-align: top;
            border-bottom: 1px solid #f5f5f5;
        }

        .label {
            font-weight: bold;
            color: #666;
            display: block;
            margin-bottom: 2px;
        }

        .value {
            color: #222;
            word-break: break-word;
        }

        .photo-row {
            width: 100%;
            margin: 15px 0;
        }

        .photo-cell {
            width: 33.3%;
            text-align: center;
            padding: 5px;
        }

        .photo-cell img {
            max-width: 95%;
            height: auto;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        @media print {
            .application-form {
                padding: 0;
            }
            
            .section {
                margin: 8px 0;
            }
        }
    </style>

    <div class="header">
        <h1>Application Form</h1>
    </div>

    <!-- Basic Information -->
    <div class="section">
        <h2>Basic Information</h2>
        <table class="data-table">
            <tr>
                <td style="width: 25%">
                    <span class="label">Country</span>
                    <div class="value">{{ $record['country'] }}</div>
                </td>
                <td style="width: 25%">
                    <span class="label">Competition</span>
                    <div class="value">{{ $record->competition?->name }}</div>
                </td>
                <td style="width: 25%">
                    <span class="label">Full Name</span>
                    <div class="value">{{ $record['first_name'] }} {{ $record['last_name'] }}</div>
                </td>
                <td style="width: 25%">
                    <span class="label">Email</span>
                    <div class="value">{{ $record['email'] }}</div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span class="label">Phone</span>
                    <div class="value">{{ $record['phone'] }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Address -->
    <div class="section">
        <h2>Address</h2>
        <table class="data-table">
            <tr>
                <td style="width: 25%">
                    <span class="label">Address Line 1</span>
                    <div class="value">{{ $record['address']['address_line_1'] }}</div>
                </td>
                <td style="width: 25%">
                    <span class="label">City</span>
                    <div class="value">{{ $record['address']['city'] }}</div>
                </td>
                <td style="width: 25%">
                    <span class="label">State</span>
                    <div class="value">{{ $record['address']['state'] }}</div>
                </td>
                <td style="width: 25%">
                    <span class="label">ZIP Code</span>
                    <div class="value">{{ $record['address']['zip'] }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Dynamic Sections -->
    <div class="section">
        <h2>Personal Background</h2>
        <table class="data-table">
            @foreach ($record['meta']['personal_background'] as $subKey => $subValue)
            <tr>
                <td>
                    <span class="label">{{ ucwords(str_replace('_', ' ', $subKey)) }}</span>
                    <div class="value">{!! nl2br($subValue) !!}</div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <h2>Outlook</h2>
        <table class="data-table">
            @foreach ($record['meta']['outlook'] as $subKey => $subValue)
            <tr>
                <td>
                    <span class="label">{{ ucwords(str_replace('_', ' ', $subKey)) }}</span>
                    <div class="value">{!! nl2br($subValue) !!}</div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Documents -->
    <div class="section">
        <table class="photo-row">
            <tr>
                <td class="photo-cell">
                    <span class="label">Headshot</span>
                    @isset($exportPdf)
                        <img src="{{ $record->headshot_photo?\public_path(\Storage::url($record->headshot_photo)): $record->getFirstMedia('headshot_photo')?->getPath() }}">
                    @else
                        {{  $record->headshot_photo?\Storage::url($record->headshot_photo): $record->getFirstMedia('headshot_photo') }}
                    @endisset
                </td>
                <td class="photo-cell">
                    <span class="label">Waist-up Photo</span>
                    @isset($exportPdf)
                        <img src="{{ $record->waist_up_photo?public_path(\Storage::url($record->waist_up_photo)): $record->getFirstMedia('waist_up_photo')?->getPath() }}">
                    @else
                        {{ $record->waist_up_photo?\Storage::url($record->waist_up_photo): $record->getFirstMedia('waist_up_photo') }}
                    @endisset
                </td>
                <td class="photo-cell">
                    <span class="label">Passport Copy</span>
                    @isset($exportPdf)
                        <img src="{{ $record->passport_copy?public_path(\Storage::url($record->passport_copy)): $record->getFirstMedia('passport_copy')?->getPath() }}">
                    @else
                        {{ $record->passport_copy?\Storage::url($record->passport_copy): $record->getFirstMedia('passport_copy') }}
                    @endisset
                </td>
            </tr>
        </table>
    </div>
</div>
@endif
@endforeach
</div>