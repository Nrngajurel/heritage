<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Application Form - Pageant Of Heritage </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.3.2/build/css/intlTelInput.css">
    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none;
        }

        [type="checkbox"] {
            box-sizing: border-box;
            padding: 0;
        }

        .form-checkbox,
        .form-radio {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            display: inline-block;
            vertical-align: middle;
            background-origin: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            flex-shrink: 0;
            color: currentColor;
            background-color: #fff;
            border-color: #e2e8f0;
            border-width: 1px;
            height: 1.4em;
            width: 1.4em;
        }

        .form-checkbox {
            border-radius: 0.25rem;
        }

        .form-radio {
            border-radius: 50%;
        }

        .form-checkbox:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        .form-radio:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="antialiased">
    @php
        $start_date = \Carbon\Carbon::parse($event->form_end_date);
    @endphp
    <div
        class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="p-6 w-full mx-auto lg:p-8">
            <h1 class="text-2xl text-center font-bold">{{ $event->name }}</h1>
            <div class="text-center">Application Form</div>

            <div class="text-sm text-center">Form Close Date: {{ $start_date->format('m D Y') }} </div>
            <div class="flex items-center justify-center space-x-4 mt-4" x-data="timer({{ $start_date->timestamp * 1000 }})"
                x-init="init();">
                <div class="flex flex-col items-center px-4">
                    <span x-text="time().days" class="text-4xl lg:text-5xl text-gray-200">00</span>
                    <span class="text-gray-400 mt-2">Days</span>
                </div>
                <span class="w-[1px] h-24 bg-gray-400"></span>
                <div class="flex flex-col items-center px-4">
                    <span x-text="time().hours" class="text-4xl lg:text-5xl text-gray-200">23</span>
                    <span class="text-gray-400 mt-2">Hours</span>
                </div>
                <span class="w-[1px] h-24 bg-gray-400"></span>
                <div class="flex flex-col items-center px-4">
                    <span x-text="time().minutes" class="text-4xl lg:text-5xl text-gray-200">59</span>
                    <span class="text-gray-400 mt-2">Minutes</span>
                </div>
                <span class="w-[1px] h-24 bg-gray-400"></span>
                <div class="flex flex-col items-center px-4">
                    <span x-text="time().seconds" class="text-4xl lg:text-5xl text-gray-200">28</span>
                    <span class="text-gray-400 mt-2">Seconds</span>
                </div>
            </div>




            <div x-data="app()" x-cloak class="bg-white rounded-lg p-4 mt-5">
                <div class="mb-4">



                    <div class="mb-4">
                        <h2 class="text-lg font-semibold">Select your preferred Competition</h2>
                    </div>
                    <button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio"
                        class="w-full border flex justify-between hover:bg-gray-100 items-center text-left bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                        type="button">

                        <div class=" flex p-2 rounded  dark:hover:bg-gray-600">
                            <div class="ms-2 text-sm">
                                <div class="font-medium text-gray-900 dark:text-gray-300">
                                    <div class="text-sm">Selected Competition</div>
                                    <div>MRS HERITAGE INTERNATIONAL</div>
                                    <p id="competition" class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                        A prestigious pageant celebrating married women who exemplify cultural
                                        heritage
                                        and global unity.</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </div>
                    </button>




                    <!-- Dropdown menu -->
                    <div id="dropdownHelperRadio"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 6119.5px, 0px);">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200 grid grid-cols-1 md:grid-cols-2"
                            aria-labelledby="dropdownHelperRadioButton">

                            @foreach ($event->competitions as $competition)
                                <li>
                                    <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <div class="flex items-center h-5">
                                            <input id="competition{{ $competition->id }}" name="competition"
                                                type="radio" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        </div>
                                        <div class="ms-2 text-sm">
                                            <label for="competition{{ $competition->id }}"
                                                class="font-medium text-gray-900 dark:text-gray-300">
                                                <div>{{ $competition->name }}</div>
                                                <p id="competition{{ $competition->id }}"
                                                    class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                                    {{ $competition->description }}</p>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="w-full mx-auto px-4 py-5">
                    <div x-show.transition="step === 'complete'">
                        <div class="bg-white rounded-lg p-10 flex items-center shadow justify-center">
                            <div>
                                <svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Registration Success</h2>
                                <div class="text-gray-600 mb-8">
                                    Thank you. We have sent you an email to demo@demo.test. Please click the link in the
                                    message to activate your account.
                                </div>
                                <button @click="step = 1"
                                    class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Back
                                    to home</button>
                            </div>
                        </div>
                    </div>

                    <div x-show.transition="step != 'complete'">
                        <!-- Top Navigation -->
                        <div class="border-b-2 py-4">
                            <div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight"
                                x-text="`Step: ${step} of 6`"></div>
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="flex-1">

                                    <div x-show="step === 1">
                                        <div class="text-lg font-bold text-gray-700 leading-tight"
                                            x-text="steps.personal_information"></div>
                                    </div>
                                    <div x-show="step === 2">
                                        <div class="text-lg font-bold text-gray-700 leading-tight"
                                            x-text="steps.background"></div>
                                    </div>
                                    <div x-show="step === 3">
                                        <div class="text-lg font-bold text-gray-700 leading-tight"
                                            x-text="steps.more_about"></div>
                                    </div>
                                    <div x-show="step === 4">
                                        <div class="text-lg font-bold text-gray-700 leading-tight"
                                            x-text="steps.personal_outook"></div>
                                    </div>
                                    <div x-show="step === 5">
                                        <div class="text-lg font-bold text-gray-700 leading-tight"
                                            x-text="steps.personal_statement"></div>
                                    </div>
                                    <div x-show="step === 6">
                                        <div class="text-lg font-bold text-gray-700 leading-tight"
                                            x-text="steps.verification"></div>
                                    </div>
                                </div>
                                <div class="flex items-center md:w-64">
                                    <div class="w-full bg-white rounded-full mr-2">
                                        <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                            :style="'width: ' + parseInt(step / 6 * 100) + '%'"></div>
                                    </div>
                                    <div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 6 * 100) +'%'">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Top Navigation -->

                        <!-- Step Content -->
                        <div class="py-10">
                            <div x-show.transition.in="step === 1">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <x-select label="Select Country" placeholder="Select a country" :async-data="route('countryOptions')"
                                        option-src="src" option-label="country" option-value="code"
                                        hide-empty-message name="country">
                                    </x-select>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>
                                        <x-input id="first_name" name="first_name" placeholder="First Name"
                                            label="First Name" />
                                    </div>
                                    <div>
                                        <x-input id="last_name" name="last_name" placeholder="Last Name"
                                            label="Last Name" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <x-input id="address_line_1" name="address[address_line_1]"
                                            placeholder="Address Line 1" label="Address Line 1" />
                                    </div>
                                    <div>
                                        <x-input id="city" name="address[city]" placeholder="City"
                                            label="City" />
                                    </div>
                                    <div>
                                        <x-input id="state" name="address[state]" placeholder="State"
                                            label="State" />
                                    </div>
                                    <div>
                                        <x-input id="zip_code" name="address[zip]" placeholder="Zip Code"
                                            label="Zip Code" />
                                    </div>
                                </div>



                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input id="email" name="email" type="email"
                                            placeholder="Email Address" label="Email" />
                                    </div>
                                    <div>
                                        <x-input id="phone_number" name="phone" type="tel"
                                            placeholder="Phone Number" label="Phone No" />
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 2">
                                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                                    <div>
                                        <x-input type="date" id="date_of_birth" name="date_of_birth"
                                            placeholder="" label="Date Of Birth" />
                                    </div>
                                    <div>
                                        <x-input id="age" name="meta[personal_background][age]"
                                            label="Age" />
                                    </div>
                                    <div>
                                        <x-input id="height" name="meta[personal_background][height]"
                                            label="Heights" />
                                    </div>
                                    <div>
                                        <x-input id="weight" name="meta[personal_background][weight]"
                                            placeholder="kg" label="Weight" />
                                    </div>
                                    <div>
                                        <x-input id="dress_size" name="meta[personal_background][dress_size]"
                                            label="Dress Size" />
                                    </div>
                                    <div>
                                        <x-input id="shoe_size" name="meta[personal_background][shoe_size]"
                                            label="Shoe Size" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input id="school_college_name"
                                            name="meta[personal_background][Attended School/College Name]"
                                            label="Attended School/College Name" />
                                    </div>
                                    <div>
                                        <x-input id="awards_achievements"
                                            name="meta[personal_background][List Awards or Achievements (Non Scholastic)]"
                                            label="List Awards or Achievements (Non Scholastic)" />
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <x-input id="degree_achievements"
                                        name="meta[personal_background][List Any Degree Attained, Scholarship & Achievement]"
                                        label="List Any Degree Attained, Scholarship & Achievement" />
                                </div>

                                <div class="mb-4">
                                    <x-textarea id="family_achievement"
                                        name="meta[personal_background][Tell us of Any Interesting Facts About Your Family or Their Achievement]"
                                        rows="3"
                                        label="Tell us of Any Interesting Facts About Your Family or Their Achievement" />
                                </div>
                            </div>
                            <div x-show.transition.in="step === 3">
                                <div class="mb-4">
                                    <x-textarea id="social_links" name="meta[more][social_links]" rows="4"
                                        label="Are You on FB/Twitter/Instagram? Please provide links" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                    <div class="mb-4">
                                        <x-input id="favorite_color" name="meta[more][favorite_color]"
                                            label="Favorite Color" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input id="favorite_food" name="meta[more][favorite_food]"
                                            label="Your Favorite Food" />
                                    </div>
                                    <div class="mb-4">
                                        <x-input id="favorite_spot" name="meta[more][favorite_spot]"
                                            label="Favourite Sports" />
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 4">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

                                    <div class="mb-4">
                                        <x-input id="hobbies" name="meta[outlook][hobbies]"
                                            label="What are Your Hobbies" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input id="talent" name="meta[outlook][talent]" label="Talent" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input id="future_ambitions" name="meta[outlook][future_ambitions]"
                                            label="Future Ambitions" />
                                    </div>



                                    <div class="mb-4">
                                        <x-input id="awards" name="meta[outlook][awards]"
                                            label="Any Title(s) or Award(s)?" />
                                    </div>
                                    <div class="mb-4">
                                        <x-input id="trainings" name="meta[outlook][trainings]"
                                            label="Do You Have Any Special Training in Music, Dance, Art etc.?" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input id="unusal_tings_you_have_done"
                                            name="meta[outlook][Most unusual thing You have Done Ever?]"
                                            label="Most unusual thing You have Done Ever?" />
                                    </div>
                                    <div class="mb-4">
                                        <x-input id="unusal_tings_you_have_done"
                                            name="meta[outlook][What Person Would You Like To Meet And Why?]"
                                            label="What Person Would You Like To Meet And Why?" />
                                    </div>
                                    <div class="mb-4">
                                        <x-input id="unusal_tings_you_have_done"
                                            name="meta[outlook][Describe the Moment in Your Life You Are Most Proud of?]"
                                            label="Describe the Moment in Your Life You Are Most Proud of?" />
                                    </div>
                                    <div class="mb-4">
                                        <x-input id="unusal_tings_you_have_done"
                                            name="meta[outlook][List all of the countries you have travelled to?]"
                                            label="List all of the countries you have travelled to?" />
                                    </div>
                                </div>
                            </div>
                            <div x-show.transition.in="step === 5">
                                <div class="mb-4">

                                    <x-textarea id="support_explanation" name="meta[personal_statement]"
                                        rows="4"
                                        label="Please give below any other Intersting information about Yourself, which has not been stated
                            by preceding questions. Remember that this information may be used for press release &
                            television commentary as well as background material for the judges" />
                                </div>
                            </div>
                            <div x-show.transition.in="step === 6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                    <div class="bg-white p-5 rounded my-2">

                                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                                            <!-- Photo File Input -->
                                            <input name="headshot_upload" type="file" class="hidden"
                                                x-ref="photo"
                                                x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                                ">

                                            <label class="block text-gray-700 text-sm font-bold mb-2 text-center"
                                                for="photo">
                                                Upload Your Current Professional Full Length Colour Headshot (Maximum
                                                Size 1 MB)
                                                <span class="text-red-600"> </span>
                                            </label>

                                            <div class="text-center">
                                                <!-- Current Profile Photo -->
                                                <div class="mt-2" x-show="! photoPreview">
                                                    <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
                                                        class="h-40 m-auto  shadow">
                                                </div>
                                                <!-- New Profile Photo Preview -->
                                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                                    <span class="block h-40 m-auto shadow"
                                                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                                        photoPreview + '\');'"
                                                        style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                    </span>
                                                </div>
                                                <button type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3"
                                                    x-on:click.prevent="$refs.photo.click()">
                                                    Select New Photo
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="bg-white p-5 rounded my-2">

                                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                                            <!-- Photo File Input -->
                                            <input name="waist_up_photo_upload" type="file" class="hidden"
                                                x-ref="photo"
                                                x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                                ">

                                            <label class="block text-gray-700 text-sm font-bold mb-2 text-center"
                                                for="photo">
                                                Upload Your Passport Copy (Data Page Only) (Maximum Size 1 MB) <span
                                                    class="text-red-600"> </span>
                                            </label>

                                            <div class="text-center">
                                                <!-- Current Profile Photo -->
                                                <div class="mt-2" x-show="! photoPreview">
                                                    <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
                                                        class="h-40 m-auto  shadow">
                                                </div>
                                                <!-- New Profile Photo Preview -->
                                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                                    <span class="block h-40 m-auto shadow"
                                                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                                        photoPreview + '\');'"
                                                        style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                    </span>
                                                </div>
                                                <button type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3"
                                                    x-on:click.prevent="$refs.photo.click()">
                                                    Select New Photo
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="bg-white p-5 rounded my-2">

                                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                                            <!-- Photo File Input -->
                                            <input name="passport_copy_upload" type="file" class="hidden"
                                                x-ref="photo"
                                                x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                                ">

                                            <label class="block text-gray-700 text-sm font-bold mb-2 text-center"
                                                for="photo">
                                                Upload Your Passport Size Photo Colour (Maximum Size 1 MB) <span
                                                    class="text-red-600"> </span>
                                            </label>

                                            <div class="text-center">
                                                <!-- Current Profile Photo -->
                                                <div class="mt-2" x-show="! photoPreview">
                                                    <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
                                                        class="h-40 m-auto  shadow">
                                                </div>
                                                <!-- New Profile Photo Preview -->
                                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                                    <span class="block h-40 m-auto shadow"
                                                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                                        photoPreview + '\');'"
                                                        style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                    </span>
                                                </div>
                                                <button type="button"
                                                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3"
                                                    x-on:click.prevent="$refs.photo.click()">
                                                    Select New Photo
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>





                                <div class="mb-4">
                                    <x-checkbox id="terms_acceptance" name="acceptance-checkbox" value="Yes"
                                        label=" I hereby agree that the information provided above is true and accurate and would like to included in this year's Pageant of Heritage" />
                                </div>
                                <div class="mb-4">
                                    <x-checkbox id="terms_acceptance" name="acceptance-checkbox" value="Yes"
                                        label="I hereby agree to be bound by the terms and conditions stated in the eligibility criteria for the Pageant of Heritage." />
                                </div>
                                <div class="mb-4">
                                    <x-checkbox id="terms_acceptance" name="acceptance-checkbox" value="Yes"
                                        label="Terms of Conditions( https://mrsheritageinternational.com/repertoire/)" />
                                </div>
                                <div class="mb-4">
                                    <x-checkbox id="terms_acceptance" name="acceptance-checkbox" value="Yes"
                                        label="I have read and agree to follow: https://mrsheritageinternational.com/repertoire/" />
                                </div>
                            </div>
                        </div>
                        <!-- /Step Content -->
                    </div>
                    <div class="flex justify-between">
                        <div class="w-1/2">
                            <button x-show="step > 1" @click="step--"
                                class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border">Previous</button>
                        </div>
                        <div class="w-1/2 text-right">
                            <button x-show="step < 6" @click="step++"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">Next</button>
                            <button @click="step = 'complete'" x-show="step === 6"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium">Complete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <wireui:scripts />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.3.2/build/js/intlTelInput.min.js"></script>
    <script>
        const phone_number = document.querySelector("#phone_number");
        window.intlTelInput(phone_number, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.3.2/build/js/utils.js",
            initialCountry: "sg",
        });
    </script>

    <script>
        function app() {
            return {
                step: 1,
                steps: {
                    personal_information: "Personal Information",
                    background: "Personal Background & Vital Statistics",
                    more_about: "More about you",
                    personal_outook: "Personal Outlook",
                    personal_statement: "Personal Statement",
                    verification: "Verification",
                }
            }
        }
    </script>
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
