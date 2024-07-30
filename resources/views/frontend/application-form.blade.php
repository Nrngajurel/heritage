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

<body class="relative antialiased" x-data="application_form()" x-cloak>
    @php
        $start_date = \Carbon\Carbon::parse($event->form_end_date);
    @endphp
    <div x-show="loading"
        class="flex h-screen w-screen items-center justify-center overflow-hidden rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
        <div role="status">
            <svg aria-hidden="true" class="h-8 w-8 animate-spin fill-blue-600 text-gray-200 dark:text-gray-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div x-show="!loading"
        class="bg-dots-darker dark:bg-dots-lighter relative min-h-screen bg-gray-100 bg-center selection:bg-red-500 selection:text-white dark:bg-gray-900 sm:flex sm:items-center sm:justify-center">
        <div class="mx-auto w-full p-6 lg:p-8">
            <h1 class="text-center text-2xl font-bold">{{ $event->name }}</h1>
            <div class="text-center">Application Form</div>

            <div class="text-center text-sm">Form Close Date: {{ $start_date->format('m D Y') }} </div>
            <div class="mt-4 flex items-center justify-center space-x-4" x-data="timer({{ $start_date->timestamp * 1000 }})"
                x-init="init();">
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

            <div x-cloak class="mt-5 rounded-lg bg-white p-4">
                <form x-on:submit.prevent="submitApplication" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mx-auto w-full px-4 py-5">
                        <div class="grid grid-cols-3 gap-5" x-show.transition.in="step == 0">
                            <div class="col-span-3 md:col-span-1">
                                <x-select id="country" name="country" label="Select Your Country" placeholder="Select a country" :async-data="route('countryOptions')"
                                    option-label="country" option-value="code" hide-empty-message name="country"
                                    x-bind:class="{ 'border-red-500': errors.country }" required
                                    x-on:selected="selectCountry">
                                </x-select>
                                <p class="mt-2 text-xs text-red-600 dark:text-red-400" x-text="errors.country"></p>

                            </div>
                            <div class="col-span-3">
                                <x-label label="Select Competition" required />
                                <ul class="grid grid-cols-1 space-y-1 p-3 text-sm text-gray-700 dark:text-gray-200 md:grid-cols-2"
                                    aria-labelledby="dropdownHelperRadioButton">

                                    @foreach ($event->competitions as $competition)
                                        <li>
                                            <div class="flex rounded p-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <div class="flex h-5 items-center">
                                                    <input id="competition{{ $competition->id }}" name="competition_id"
                                                        type="radio" value="{{ $competition->id }}"
                                                        x-model="form.competition_id"
                                                        class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700">
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
                                <p class="mt-2 text-xs text-red-600 dark:text-red-400" x-text="errors.competition_id">
                                </p>
                            </div>
                        </div>
                        <div x-show.transition.in="step > 0">


                            <div x-show.transition="step != 'complete'">
                                <!-- Top Navigation -->
                                <div class="border-b-2 py-4">
                                    <div class="mb-1 text-xs font-bold uppercase leading-tight tracking-wide text-gray-500"
                                        x-text="`Step: ${step} of 6`"></div>
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                        <div class="flex-1">

                                            <div x-show="step === 1">
                                                <div class="text-lg font-bold leading-tight text-gray-700">Personal
                                                    Information
                                                </div>
                                            </div>
                                            <div x-show="step === 2">
                                                <div class="text-lg font-bold leading-tight text-gray-700">Personal
                                                    Background
                                                    & Vital Statistics</div>
                                            </div>
                                            <div x-show="step === 3">
                                                <div class="text-lg font-bold leading-tight text-gray-700">More about
                                                    you
                                                </div>
                                            </div>
                                            <div x-show="step === 4">
                                                <div class="text-lg font-bold leading-tight text-gray-700">Personal
                                                    Outlook
                                                </div>
                                            </div>
                                            <div x-show="step === 5">
                                                <div class="text-lg font-bold leading-tight text-gray-700">Personal
                                                    Statement
                                                </div>
                                            </div>
                                            <div x-show="step === 6">
                                                <div class="text-lg font-bold leading-tight text-gray-700">Verification
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center md:w-64">
                                            <div class="mr-2 w-full rounded-full bg-white">
                                                <div class="h-2 rounded-full bg-green-500 text-center text-xs leading-none text-white"
                                                    :style="'width: ' + parseInt(step / 6 * 100) + '%'"></div>
                                            </div>
                                            <div class="w-10 text-xs text-gray-600"
                                                x-text="parseInt(step / 6 * 100) +'%'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Top Navigation -->

                                <!-- Step Content -->
                                <div class="py-10">

                                    <div x-show.transition.in="step === 1">
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                                            <div class="col-span-2">
                                                <x-input id="first_name" name="first_name" placeholder="First Name"
                                                    label="First Name" x-model="form.first_name"
                                                    x-bind:class="{ 'border-red-500': errors.first_name }" required />

                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.first_name"></p>
                                            </div>
                                            <div class="col-span-2">
                                                <x-input id="last_name" name="last_name" placeholder="Last Name"
                                                    label="Last Name" x-model="form.last_name"
                                                    x-bind:class="{ 'border-red-500': errors.last_name }" required />
                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.last_name"></p>
                                            </div>

                                            <div class="col-span-2 md:col-span-1">
                                                <x-input id="address_line_1" name="address[address_line_1]"
                                                    placeholder="Address Line 1" label="Address Line 1"
                                                    x-model="form.address.address_line_1"
                                                    x-bind:class="{
                                                        'border-red-500': errors.address && errors.address
                                                            .address_line_1
                                                    }" />
                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.address && errors.address.address_line_1"></p>
                                            </div>
                                            <div class="col-span-2 md:col-span-1">
                                                <x-input id="city" name="address[city]" placeholder="City"
                                                    label="City" x-model="form.address.city"
                                                    x-bind:class="{ 'border-red-500': errors.address && errors.address.city }" />
                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.address && errors.address.city"></p>
                                            </div>
                                            <div class="col-span-2 md:col-span-1">
                                                <x-input id="state" name="address[state]" placeholder="State"
                                                    label="State" x-model="form.address.state"
                                                    x-bind:class="{ 'border-red-500': errors.address && errors.address.state }" />
                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.address && errors.address.state"></p>
                                            </div>
                                            <div class="col-span-2 md:col-span-1">
                                                <x-input id="zip_code" name="address[zip]" placeholder="Zip Code"
                                                    label="Zip Code" x-model="form.address.zip"
                                                    x-bind:class="{ 'border-red-500': errors.address && errors.address.zip }" />
                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.address && errors.address.zip"></p>
                                            </div>

                                            <div class="col-span-3 md:col-span-1">
                                                <x-input id="email" name="email" type="email"
                                                    placeholder="Email Address" label="Email" x-model="form.email"
                                                    x-bind:class="{ 'border-red-500': errors.email }" required />
                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.email"></p>
                                            </div>
                                            <div class="col-span-3 md:col-span-1">
                                                <x-input id="phone_number" name="phone" type="tel"
                                                    placeholder="Phone Number" label="Phone No"
                                                    x-bind:class="{ 'border-red-500': errors.phone }" required />
                                                <p class="mt-2 text-xs text-red-600 dark:text-red-400"
                                                    x-text="errors.phone"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show.transition.in="step === 2">
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-6">
                                            <div>
                                                <x-input type="date" id="date_of_birth"
                                                    name="meta[personal_background][date_of_birth]" placeholder=""
                                                    label="Date Of Birth"
                                                    x-model="form.meta.personal_background.date_of_birth" />
                                            </div>
                                            <div>
                                                <x-input id="age" name="meta[personal_background][age]"
                                                    label="Age" x-model="form.meta.personal_background.age" />
                                            </div>
                                            <div>
                                                <x-input id="height" name="meta[personal_background][height]"
                                                    label="Heights" x-model="form.meta.personal_background.height" />
                                            </div>
                                            <div>
                                                <x-input id="weight" name="meta[personal_background][weight]"
                                                    placeholder="kg" label="Weight"
                                                    x-model="form.meta.personal_background.weight" />
                                            </div>
                                            <div>
                                                <x-input id="dress_size" name="meta[personal_background][dress_size]"
                                                    label="Dress Size"
                                                    x-model="form.meta.personal_background.dress_size" />
                                            </div>
                                            <div>
                                                <x-input id="shoe_size" name="meta[personal_background][shoe_size]"
                                                    label="Shoe Size"
                                                    x-model="form.meta.personal_background.shoe_size" />
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <div>
                                                <x-input id="school_college_name"
                                                    name="meta[personal_background][Attended School/College Name]"
                                                    label="Attended School/College Name"
                                                    x-model="form.meta.personal_background['Attended School/College Name']" />
                                            </div>
                                            <div>
                                                <x-input id="awards_achievements"
                                                    name="meta[personal_background][List Awards or Achievements (Non Scholastic)]"
                                                    label="List Awards or Achievements (Non Scholastic)"
                                                    x-model="form.meta.personal_background['List Awards or Achievements (Non Scholastic)']" />
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <x-input id="degree_achievements"
                                                name="meta[personal_background][List Any Degree Attained, Scholarship & Achievement]"
                                                label="List Any Degree Attained, Scholarship & Achievement"
                                                x-model="form.meta.personal_background['List Any Degree Attained, Scholarship & Achievement']" />
                                        </div>

                                        <div class="mb-4">
                                            <x-textarea id="family_achievement"
                                                name="meta[personal_background][Tell us of Any Interesting Facts About Your Family or Their Achievement]"
                                                rows="3"
                                                x-model="form.meta.personal_background['Tell us of Any Interesting Facts About Your Family or Their Achievement']"
                                                label="Tell us of Any Interesting Facts About Your Family or Their Achievement" />
                                        </div>
                                    </div>
                                    <div x-show.transition.in="step === 3">
                                        <div class="mb-4">
                                            <x-textarea id="social_links" name="meta[more][social_links]"
                                                rows="4"
                                                x-model="form.meta.more.social_links"
                                                label="Are You on FB/Twitter/Instagram? Please provide links" />
                                        </div>

                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                                            <div class="mb-4">
                                                <x-input id="favorite_color" name="meta[more][favorite_color]"
                                                    label="Favorite Color"
                                                    x-model="form.meta.more.favorite_color" />
                                            </div>

                                            <div class="mb-4">
                                                <x-input id="favorite_food" name="meta[more][favorite_food]"
                                                    label="Your Favorite Food"
                                                    x-model="form.meta.more.favorite_food" />
                                            </div>
                                            <div class="mb-4">
                                                <x-input id="favorite_spot" name="meta[more][favorite_spot]"
                                                    label="Favourite Sports"
                                                    x-model="form.meta.more.favorite_spot" />
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show.transition.in="step === 4">

                                        <div class="grid grid-cols-1 gap-2 md:grid-cols-2">

                                            <div class="mb-4">
                                                <x-input id="hobbies" name="meta[outlook][hobbies]"
                                                    label="What are Your Hobbies"
                                                    x-model="form.meta.outlook.hobbies" />
                                            </div>

                                            <div class="mb-4">
                                                <x-input id="talent" name="meta[outlook][talent]" label="Talent"
                                                    x-model="form.meta.outlook.talent" />
                                            </div>

                                            <div class="mb-4">
                                                <x-input id="future_ambitions" name="meta[outlook][future_ambitions]"
                                                    label="Future Ambitions"
                                                    x-model="form.meta.outlook.future_ambitions" />
                                            </div>



                                            <div class="mb-4">
                                                <x-input id="awards" name="meta[outlook][awards]"
                                                    label="Any Title(s) or Award(s)?"
                                                    x-model="form.meta.outlook.awards" />
                                            </div>
                                            <div class="mb-4">
                                                <x-input id="trainings" name="meta[outlook][trainings]"
                                                    label="Do You Have Any Special Training in Music, Dance, Art etc.?"
                                                    x-model="form.meta.outlook['Do You Have Any Special Training in Music, Dance, Art etc.?']" />
                                            </div>

                                            <div class="mb-4">
                                                <x-input id="unusal_tings_you_have_done"
                                                    name="meta[outlook][Most unusual thing You have Done Ever?]"
                                                    label="Most unusual thing You have Done Ever?"
                                                    x-model="form.meta.outlook['Most unusual thing You have Done Ever?']" />
                                            </div>
                                            <div class="mb-4">
                                                <x-input id="what_person_would_you_like_to_meet"
                                                    name="meta[outlook][What Person Would You Like To Meet And Why?]"
                                                    label="What Person Would You Like To Meet And Why?"
                                                    x-model="form.meta.outlook['What Person Would You Like To Meet And Why?']" />
                                            </div>
                                            <div class="mb-4">
                                                <x-input id="describe_the_moment_in_your_life"
                                                    name="meta[outlook][Describe the Moment in Your Life You Are Most Proud of?]"
                                                    label="Describe the Moment in Your Life You Are Most Proud of?"
                                                    x-model="form.meta.outlook['Describe the Moment in Your Life You Are Most Proud of?']" />
                                            </div>
                                            <div class="mb-4">
                                                <x-input id="list_all_of _the_countries_you_have_travelled_to"
                                                    name="meta[outlook][List all of the countries you have travelled to?]"
                                                    label="List all of the countries you have travelled to?"
                                                    x-model="form.meta.outlook['List all of the countries you have travelled to?']" />
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show.transition.in="step === 5">
                                        <div class="mb-4">

                                            <x-textarea id="support_explanation" name="meta[personal_statement]"
                                                x-model="form.meta.personal_statement" rows="4"
                                                label="Please give below any other Intersting information about Yourself, which has not been stated
                                                by preceding questions. Remember that this information may be used for press release &
                                                television commentary as well as background material for the judges" />
                                        </div>
                                    </div>
                                    <div x-show.transition.in="step === 6">
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                                            <div class="my-2 rounded bg-white p-5">

                                                <div x-data="{ photoName: null, photoPreview: null }"
                                                    class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                                                    <!-- Photo File Input -->
                                                    <input id="headshot_photo" name="headshot_photo" type="file" class="hidden"
                                                        x-ref="photo"
                                                        accept="image/png, image/gif, image/jpeg"
                                                        x-on:change="
                                                                    photoName = $refs.photo.files[0].name;
                                                                    const reader = new FileReader();
                                                                    reader.onload = (e) => {
                                                                        photoPreview = e.target.result;
                                                                    };
                                                                    reader.readAsDataURL($refs.photo.files[0]);
                                                                    form.headshot_photo = $refs.photo.files[0];
                                                            ">

                                                    <label
                                                        class="mb-2 block text-center text-sm font-bold text-gray-700"
                                                        for="headshot_photo">
                                                        Upload Your Current Professional Full Length Colour Headshot
                                                        (Maximum
                                                        Size 1 MB)
                                                        <span class="text-red-600"> </span>
                                                    </label>

                                                    <div class="text-center">
                                                        <!-- Current Profile Photo -->
                                                        <div class="mt-2" x-show="! photoPreview">
                                                            <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
                                                                class="m-auto h-40 shadow">
                                                        </div>
                                                        <!-- New Profile Photo Preview -->
                                                        <div class="mt-2" x-show="photoPreview"
                                                            style="display: none;">
                                                            <span class="m-auto block h-40 shadow"
                                                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                                                photoPreview + '\');'"
                                                                style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                            </span>
                                                        </div>
                                                        <button type="button"
                                                            class="focus:shadow-outline-blue ml-3 mt-2 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-400 focus:outline-none active:bg-gray-50 active:text-gray-800"
                                                            x-on:click.prevent="$refs.photo.click()">
                                                            Select New Photo
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="my-2 rounded bg-white p-5">

                                                <div x-data="{ photoName: null, photoPreview: null }"
                                                    class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                                                    <!-- Photo File Input -->
                                                    <input id="waist_up_photo" name="waist_up_photo" type="file" class="hidden"
                                                        x-ref="photo"
                                                        accept="image/png, image/gif, image/jpeg"
                                                        x-on:change="
                                                                        photoName = $refs.photo.files[0].name;
                                                                        const reader = new FileReader();
                                                                        reader.onload = (e) => {
                                                                            photoPreview = e.target.result;
                                                                        };
                                                                        reader.readAsDataURL($refs.photo.files[0]);
                                                                        form.waist_up_photo = $refs.photo.files[0];
                                                                ">

                                                    <label
                                                        class="mb-2 block text-center text-sm font-bold text-gray-700"
                                                        for="waist_up_photo">
                                                       Upload Your Passport Size Photo Colour (Maximum Size 1 MB)
                                                        <span class="text-red-600"> </span>
                                                    </label>

                                                    <div class="text-center">
                                                        <!-- Current Profile Photo -->
                                                        <div class="mt-2" x-show="! photoPreview">
                                                            <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
                                                                class="m-auto h-40 shadow">
                                                        </div>
                                                        <!-- New Profile Photo Preview -->
                                                        <div class="mt-2" x-show="photoPreview"
                                                            style="display: none;">
                                                            <span class="m-auto block h-40 shadow"
                                                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                                                photoPreview + '\');'"
                                                                style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                            </span>
                                                        </div>
                                                        <button type="button"
                                                            class="focus:shadow-outline-blue ml-3 mt-2 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-400 focus:outline-none active:bg-gray-50 active:text-gray-800"
                                                            x-on:click.prevent="$refs.photo.click()">
                                                            Select New Photo
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="my-2 rounded bg-white p-5">

                                                <div x-data="{ photoName: null, photoPreview: null }"
                                                    class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                                                    <!-- Photo File Input -->
                                                    <input id="passport_copy" name="passport_copy" type="file" class="hidden"
                                                        x-ref="photo"
                                                        accept="image/png, image/gif, image/jpeg"
                                                        x-on:change="
                                                                photoName = $refs.photo.files[0].name;
                                                                const reader = new FileReader();
                                                                reader.onload = (e) => {
                                                                    photoPreview = e.target.result;
                                                                };
                                                                reader.readAsDataURL($refs.photo.files[0]);
                                                                form.passport_copy = $refs.photo.files[0];
                                                        ">

                                                    <label
                                                        class="mb-2 block text-center text-sm font-bold text-gray-700"
                                                        for="passport_copy">
                                                         Upload Your Passport Copy (Data Page Only) (Maximum Size 1 MB)
                                                         <span
                                                            class="text-red-600"> </span>
                                                    </label>

                                                    <div class="text-center">
                                                        <!-- Current Profile Photo -->
                                                        <div class="mt-2" x-show="! photoPreview">
                                                            <img src="https://images.unsplash.com/photo-1531316282956-d38457be0993?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80"
                                                                class="m-auto h-40 shadow">
                                                        </div>
                                                        <!-- New Profile Photo Preview -->
                                                        <div class="mt-2" x-show="photoPreview"
                                                            style="display: none;">
                                                            <span class="m-auto block h-40 shadow"
                                                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                                                photoPreview + '\');'"
                                                                style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                            </span>
                                                        </div>
                                                        <button type="button"
                                                            class="focus:shadow-outline-blue ml-3 mt-2 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:text-gray-500 focus:border-blue-400 focus:outline-none active:bg-gray-50 active:text-gray-800"
                                                            x-on:click.prevent="$refs.photo.click()">
                                                            Select New Photo
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>





                                        <div class="mb-4">
                                            <x-checkbox id="terms_acceptance_a" name="acceptance-checkbox"
                                                value="Yes"
                                                label=" I hereby agree that the information provided above is true and accurate and would like to included in this year's Pageant of Heritage" />
                                        </div>
                                        <div class="mb-4">
                                            <x-checkbox id="terms_acceptance_b" name="acceptance-checkbox"
                                                value="Yes"
                                                label="I hereby agree to be bound by the terms and conditions stated in the eligibility criteria for the Pageant of Heritage." />
                                        </div>
                                        <div class="mb-4">
                                            <x-checkbox id="terms_acceptance_c" name="acceptance-checkbox"
                                                value="Yes"
                                                label="Terms of Conditions( https://mrsheritageinternational.com/repertoire/)" />
                                        </div>
                                        <div class="mb-4">
                                            <x-checkbox id="terms_acceptance_d" name="acceptance-checkbox"
                                                value="Yes"
                                                label="I have read and agree to follow: https://mrsheritageinternational.com/repertoire/" />
                                        </div>
                                    </div>
                                </div>
                                <!-- /Step Content -->
                            </div>

                        </div>
                        <div x-show.transition="step === 'complete'">
                            <div class="flex items-center justify-center rounded-lg bg-white p-10 shadow">
                                <div>
                                    <svg class="mx-auto mb-4 h-20 w-20 text-green-500" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <h2 class="mb-4 text-center text-2xl font-bold text-gray-800">Application
                                        Submitted
                                        Success
                                    </h2>
                                    <div class="mb-8 text-gray-600">
                                        Thank you. We have sent you an email to <span x-text="form.email"></span>
                                        about status of the application
                                    </div>
                                    <button type="button" @click="window.location.reload()"
                                        class="mx-auto block w-40 rounded-lg border bg-white px-5 py-2 text-center font-medium text-gray-600 shadow-sm hover:bg-gray-100 focus:outline-none">Back
                                        to home</button>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="w-1/2">
                                <button type="button" x-show="step > 1" @click="previousStep()"
                                    class="w-32 rounded-lg border bg-white px-5 py-2 text-center font-medium text-gray-600 shadow-sm hover:bg-gray-100 focus:outline-none">Previous</button>
                            </div>
                            <div class="w-1/2 text-right">
                                <button type="button" x-show="step < 6" @click="nextStep()"
                                    class="w-32 rounded-lg border border-transparent bg-blue-500 px-5 py-2 text-center font-medium text-white shadow-sm hover:bg-blue-600 focus:outline-none"
                                    x-text="step == 0?'Apply Now': 'Next'"></button>
                                <button type="submit" x-show="step === 6"
                                    class="w-32 rounded-lg border border-transparent bg-blue-500 px-5 py-2 text-center font-medium text-white shadow-sm hover:bg-blue-600 focus:outline-none">Complete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @livewireScripts
    <wireui:scripts />
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.3.2/build/js/intlTelInput.min.js"></script>
    <script>
        const phone_number = document.querySelector("#phone_number");
        const iti = window.intlTelInput(phone_number, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.3.2/build/js/utils.js",
            initialCountry: "sg",
        });
    </script>

    <script>
        function application_form() {
            return {
                step: 0,
                loading: false,
                csrfToken: "{{ csrf_token() }}",
                form: {
                    competition_id: '',
                    country: '',
                    first_name: '',
                    last_name: '',
                    address: {
                        address_line_1: '',
                        city: '',
                        state: '',
                        zip: ''
                    },
                    email: '',
                    phone: '',
                    meta: {
                        personal_background: {
                            date_of_birth: '',
                            age: '',
                            height: '',
                            weight: '',
                            dress_size: '',
                            shoe_size: '',
                            'Attended School/College Name': '',
                            'List Awards or Achievements (Non Scholastic)': '',
                            'List Any Degree Attained, Scholarship & Achievement': '',
                            'Tell us of Any Interesting Facts About Your Family or Their Achievement': ''
                        },
                        more: {
                            social_links: '',
                            favorite_color: '',
                            favorite_food: '',
                            favorite_spot: ''
                        },
                        outlook: {
                            hobbies: '',
                            talent: '',
                            future_ambitions: '',
                            awards: '',
                            trainings: '',
                            'Most unusual thing You have Done Ever?': '',
                            'What Person Would You Like To Meet And Why?': '',
                            'Describe the Moment in Your Life You Are Most Proud of?': '',
                            'List all of the countries you have travelled to?': ''
                        },
                        personal_statement: ''
                    },
                    headshot_photo: null,
                    waist_up_photo: null,
                    passport_copy: null
                },
                errors: {},
                validateEmail(email) {
                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return re.test(String(email).toLowerCase());
                },

                validateStep(step) {
                    let isValid = true;
                    switch (step) {
                        case 0:
                            if (!this.form.competition_id) {
                                this.errors.competition_id = 'Please Select Competition first';
                                isValid = false;
                            }
                            if (!this.form.country) {
                                this.errors.country = 'Country is required.';
                                isValid = false;
                            }
                            break;
                        case 1:
                            this.form.phone= iti.getNumber();
                            if (!this.form.first_name) {
                                this.errors.first_name = 'First name is required.';
                                isValid = false;
                            }
                            if (!this.form.last_name) {
                                this.errors.last_name = 'Last name is required.';
                                isValid = false;
                            }
                            this.errors.address = {};
                            if (!this.form.address.address_line_1) {
                                this.errors.address.address_line_1 = 'Address line 1 is required.';
                                isValid = false;
                            }
                            if (!this.form.address.city) {
                                this.errors.address.city = 'City is required.';
                                isValid = false;
                            }
                            if (!this.form.address.state) {
                                this.errors.address.state = 'State is required.';
                                isValid = false;
                            }
                            if (!this.form.address.zip) {
                                this.errors.address.zip = 'Zip code is required.';
                                isValid = false;
                            }
                            if (!this.form.email) {
                                this.errors.email = 'Email is required.';
                                isValid = false;
                            } else if (!this.validateEmail(this.form.email)) {
                                this.errors.email = 'Invalid email format.';
                                isValid = false;
                            }
                            // email should  email

                            if (!this.form.phone) {
                                this.errors.phone = 'Phone number is required.';
                                isValid = false;
                            }
                            break;
                        case 2:
                            if (!this.form.meta.personal_background.date_of_birth) {
                                this.errors.date_of_birth = 'Date of birth is required.';
                                isValid = false;
                            }
                            if (!this.form.meta.personal_background.age) {
                                this.errors.age = 'Age is required.';
                                isValid = false;
                            }
                            if (!this.form.meta.personal_background.height) {
                                this.errors.height = 'Height is required.';
                                isValid = false;
                            }
                            if (!this.form.meta.personal_background.weight) {
                                this.errors.weight = 'Weight is required.';
                                isValid = false;
                            }
                            if (!this.form.meta.personal_background.dress_size) {
                                this.errors.dress_size = 'Dress size is required.';
                                isValid = false;
                            }
                            if (!this.form.meta.personal_background.shoe_size) {
                                this.errors.shoe_size = 'Shoe size is required.';
                                isValid = false;
                            }
                            break;
                        case 6:
                            var checkboxes = document.querySelectorAll('input[name="acceptance-checkbox"]');
                            var allChecked = Array.from(checkboxes).every(function(checkbox) {
                                return checkbox.checked;
                            });
                            if (!allChecked) {
                                alert('You should accept all the checkobox');
                            }
                            break;
                        default:
                            break;
                    }
                    return isValid;
                },
                selectCountry(event) {
                    if (event.detail) {

                        this.form.country = event.detail.country;
                    }
                },

                nextStep() {
                    this.errors = {}; // Reset errors
                    if (this.validateStep(this.step)) {
                        this.step++;
                    }
                },

                previousStep() {
                    if (this.step > 1) {
                        this.step--;
                    }
                },
                submitApplication() {

                    this.errors = {}; // Reset errors before validation
                    const formData = new FormData();
                    const appendData = (data, parentKey = '') => {
                        for (let key in data) {
                            if (data.hasOwnProperty(key)) {
                                const propKey = parentKey ? `${parentKey}[${key}]` : key;
                                if (typeof data[key] === 'object' && data[key] !== null && !(data[
                                        key] instanceof File)) {
                                    appendData(data[key], propKey);
                                } else {
                                    formData.append(propKey, data[key]);
                                }
                            }
                        }
                    };

                    appendData(this.form);
                    var self = this;
                    this.loading = true;
                    // Send the form data to the server using Axios
                    axios.post('/application-form', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': this.csrfToken
                            }
                        })
                        .then(response => {
                            self.step = 'complete';
                            alert('Application submitted successfully!');
                            self.loading = false;
                            // Handle successful response
                        })
                        .catch(error => {
                            console.error('Error submitting application:', error);
                            alert('There was an error submitting your application.');
                            self.loading = false;
                            // Handle error response
                        });

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
