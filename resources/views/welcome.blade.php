<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="z-10 p-6 text-right sm:fixed sm:top-0 sm:right-0">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="p-6 mx-auto max-w-7xl lg:p-8">

            <form wire:submit.prevent="submit" id="fluentform_2" class="space-y-4">
                <fieldset class="border-none m-0 p-0 bg-transparent shadow-none outline-none">
                    <legend class="sr-only">Application Form</legend>

                    <div class="mb-4">
                        <x-select label="Select Country" placeholder="Select a country" :async-data="route('countryOptions')"
                            src="`https://flagsapi.com/NE/flat/64.png`" option-label="country" option-value="code"
                            hide-empty-message>
                            <x-slot name="afterOptions" class="flex justify-center p-2"
                                x-show="displayOptions.length === 0">
                                <x-button
                                    x-on:click="close; $wireui.notify({ title: 'Not implemented yet', icon: 'info' })"
                                    primary flat full>
                                    <span x-html="`Create country <b>${search}</b>`"></span>
                                </x-button>
                            </x-slot>
                        </x-select>
                    </div>

                    <div class="mb-4">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownHelperRadioButton">
                            <li>
                                <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex items-center h-5">
                                        <input id="helper-radio-4" name="helper-radio" type="radio" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    </div>
                                    <div class="ms-2 text-sm">
                                        <label for="helper-radio-4"
                                            class="font-medium text-gray-900 dark:text-gray-300">
                                            <div>Individual</div>
                                            <p id="helper-radio-text-4"
                                                class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                                                helpful instruction goes over here.</p>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex items-center h-5">
                                        <input id="helper-radio-5" name="helper-radio" type="radio" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    </div>
                                    <div class="ms-2 text-sm">
                                        <label for="helper-radio-5"
                                            class="font-medium text-gray-900 dark:text-gray-300">
                                            <div>Company</div>
                                            <p id="helper-radio-text-5"
                                                class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                                                helpful instruction goes over here.</p>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex items-center h-5">
                                        <input id="helper-radio-6" name="helper-radio" type="radio" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    </div>
                                    <div class="ms-2 text-sm">
                                        <label for="helper-radio-6"
                                            class="font-medium text-gray-900 dark:text-gray-300">
                                            <div>Non profit</div>
                                            <p id="helper-radio-text-6"
                                                class="text-xs font-normal text-gray-500 dark:text-gray-300">Some
                                                helpful instruction goes over here.</p>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="space-y-2">
                            <x-radio id="mrs_heritage_international" name="input_radio"
                                value="MRS HERITAGE INTERNATIONAL" label="MRS HERITAGE INTERNATIONAL" checked />
                            <x-radio id="miss_heritage_international" name="input_radio"
                                value="MISS HERITAGE INTERNATIONAL" label="MISS HERITAGE INTERNATIONAL" />
                            <x-radio id="heritage_petite_international" name="input_radio"
                                value="HERITAGE PETITE INTERNATIONAL" label="HERITAGE PETITE INTERNATIONAL" />
                            <x-radio id="heritage_gold_international" name="input_radio"
                                value="HERITAGE GOLD INTERNATIONAL" label="HERITAGE GOLD INTERNATIONAL" />
                            <x-radio id="heritage_plus_international" name="input_radio"
                                value="HERITAGE PLUS INTERNATIONAL" label="HERITAGE PLUS INTERNATIONAL" />
                            <x-radio id="heritage_international" name="input_radio" value="HERITAGE INTERNATIONAL"
                                label="HERITAGE INTERNATIONAL" />
                            <x-radio id="heritage_gems_international" name="input_radio"
                                value="HERITAGE GEMS INTERNATIONAL" label="HERITAGE GEMS INTERNATIONAL" />
                            <x-radio id="miss_environment_international" name="input_radio"
                                value="MISS ENVIRONMENT INTERNATIONAL" label="MISS ENVIRONMENT INTERNATIONAL" />
                            <x-radio id="mister_heritage_international" name="input_radio"
                                value="MISTER HERITAGE INTERNATIONAL" label="MISTER HERITAGE INTERNATIONAL" />
                            <x-radio id="heritage_ambassador" name="input_radio" value="HERITAGE AMBASSADOR"
                                label="HERITAGE AMBASSADOR" />
                            <x-radio id="heritage_international_awards" name="input_radio"
                                value="HERITAGE INTERNATIONAL AWARDS" label="HERITAGE INTERNATIONAL AWARDS" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input id="first_name" name="names[first_name]" placeholder="First Name"
                                label="First Name" />
                        </div>
                        <div>
                            <x-input id="last_name" name="names[last_name]" placeholder="Last Name"
                                label="Last Name" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input id="address_line_1" name="address_4[address_line_1]"
                                placeholder="Address Line 1" label="Address Line 1" />
                        </div>
                        <div>
                            <x-input id="city" name="address_4[city]" placeholder="City" label="City" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input id="state" name="address_4[state]" placeholder="State" label="State" />
                        </div>
                        <div>
                            <x-input id="zip_code" name="address_4[zip]" placeholder="Zip Code" label="Zip Code" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-select id="country_address" name="address_4[country]" placeholder="Select Country"
                            label="Country" />
                    </div>

                    <div class="mb-4">
                        <h2 class="text-lg font-semibold">Contact Information</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input id="email" name="email" type="email" placeholder="Email Address"
                                label="Email" />
                        </div>
                        <div>
                            <x-input id="phone_number" name="numeric-field" type="number" placeholder="+"
                                label="Phone No With Country Code" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <h2 class="text-lg font-semibold">Personal Background &amp; Vital Statistics</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                        <div>
                            <x-input id="date_of_birth" name="datetime" placeholder="d/m/y" readonly
                                label="Date Of Birth" />
                        </div>
                        <div>
                            <x-input id="age" name="input_text_1" label="Age" />
                        </div>
                        <div>
                            <x-input id="heights" name="input_text_2" label="Heights" />
                        </div>
                        <div>
                            <x-input id="weight" name="input_text_3" placeholder="kg" label="Weight" />
                        </div>
                        <div>
                            <x-input id="dress_size" name="input_text_4" label="Dress Size" />
                        </div>
                        <div>
                            <x-input id="shoe_size" name="input_text_5" label="Shoe Size" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input id="school_college_name" name="input_text"
                                label="Attended School/College Name" />
                        </div>
                        <div>
                            <x-input id="awards_achievements" name="input_text_6"
                                label="List Awards or Achievements (Non Scholastic)" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input id="degree_achievements" name="input_text_7"
                            label="List Any Degree Attained, Scholarship &amp; Achievement" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="family_achievement" name="description" rows="3"
                            label="Tell us of Any Interesting Facts About Your Family or Their Achievement" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="brief_autobiography" name="description_1" rows="4"
                            label="Write a Brief Autobiography (Not more than 200 words)" />
                    </div>

                    <div class="mb-4">
                        <x-input id="interesting_facts" name="input_text_8"
                            label="List Interesting Fact About Yourself or Special Talents" />
                    </div>

                    <div class="mb-4">
                        <x-input id="greatest_strength" name="input_text_9" label="Your Greatest Strength" />
                    </div>

                    <div class="mb-4">
                        <x-input id="greatest_weakness" name="input_text_10" label="Your Greatest Weakness" />
                    </div>

                    <div class="mb-4">
                        <x-input id="favorite_food" name="input_text_11" label="Your Favorite Food" />
                    </div>

                    <div class="mb-4">
                        <x-input id="favorite_color" name="input_text_12" label="Favorite Color" />
                    </div>

                    <div class="mb-4">
                        <x-input id="favorite_outfit" name="input_text_13" label="Favorite Outfit" />
                    </div>

                    <div class="mb-4">
                        <x-input id="hobbies" name="input_text_14" label="What are Your Hobbies" />
                    </div>

                    <div class="mb-4">
                        <x-input id="feel_best" name="input_text_15" label="When do you Feel at Your Best" />
                    </div>

                    <div class="mb-4">
                        <x-input id="future_ambitions" name="input_text_16" label="Future Ambitions" />
                    </div>

                    <div class="mb-4">
                        <x-input id="career_ambitions" name="input_text_17" label="Career Ambitions" />
                    </div>

                    <div class="mb-4">
                        <x-input id="extra_curriculum" name="input_text_18"
                            label="Any Extra Curriculum Participation in School/College" />
                    </div>

                    <div class="mb-4">
                        <x-input id="pageant_reason" name="input_text_19"
                            label="Why do you want to be a part of This Pageant" />
                    </div>

                    <div class="mb-4">
                        <x-input id="heritage_definition" name="input_text_20"
                            label="Define Heritage in your own words" />
                    </div>

                    <div class="mb-4">
                        <x-input id="roles_model" name="input_text_21" label="Who is your role model" />
                    </div>

                    <div class="mb-4">
                        <x-input id="why_role_model" name="input_text_22" label="Why" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="unhappiness_reasons" name="description_2" rows="4"
                            label="What makes you Unhappy and How do you Overcome it" />
                    </div>

                    <div class="mb-4">
                        <x-input id="greatest_motivation" name="input_text_23" label="Your Greatest Motivation" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="charity_support" name="description_3" rows="4"
                            label="Are you or Your Family Support any Charity, Community Organization or NGO? If Yes, Give Detail" />
                    </div>

                    <div class="mb-4">
                        <x-input id="won_title_before" name="input_text_24"
                            label="Have you won any title/pageant before? If yes, Give detail" />
                    </div>

                    <div class="mb-4">
                        <x-input id="other_pageants_applied" name="input_text_25"
                            label="Have you applied for any other international pageant or about to apply for any?" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="pageant_expectation" name="description_4" rows="4"
                            label="What do you expect to achieve by participating in this pageant" />
                    </div>

                    <div class="mb-4">
                        <x-input id="last_pageant_participation" name="input_text_26"
                            label="Have you participated in any of our pageant previously? If Yes, Give Detail" />
                    </div>

                    <div class="mb-4">
                        <x-input id="year_of_pageant" name="input_text_27" label="Year" />
                    </div>

                    <div class="mb-4">
                        <x-input id="heard_about_pageant" name="input_text_28"
                            label="Where did you hear about our pageant" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="pageant_commitment" name="description_5" rows="4"
                            label="If you are selected to represent your country, how committed are you to this pageant?" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="participation_benefits" name="description_6" rows="4"
                            label="If selected, how would your participation in this pageant benefit your community/country?" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="representation_qualities" name="description_7" rows="4"
                            label="Tell us why you should be chosen to represent your country at this pageant" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="pageant_focus" name="description_8" rows="4"
                            label="If you could change one thing in the pageant industry what would that be and why" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="important_message" name="description_9" rows="4"
                            label="Anything you would like to tell us that you think is important" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="support_explanation" name="description_10" rows="4"
                            label="Would your family and friends support you, Give Details" />
                    </div>

                    <div class="mb-4">
                        <x-input type="file" id="headshot_upload" name="headshot_upload"
                            label="Upload Your Current Professional Full Length Colour Headshot (Maximum Size 1 MB)" />
                    </div>

                    <div class="mb-4">
                        <x-input type="file" id="waist_up_photo_upload" name="waist_up_photo_upload"
                            label="Upload Your Current Professional Photo Waist Up Colour (Maximum Size 1 MB)" />
                    </div>

                    <div class="mb-4">
                        <x-input type="file" id="passport_copy_upload" name="passport_copy_upload"
                            label="Upload Your Passport Copy (Data Page Only) (Maximum Size 1 MB)" />
                    </div>

                    <div class="mb-4">
                        <x-input type="file" id="passport_size_photo_upload" name="passport_size_photo_upload"
                            label="Upload Your Passport Size Photo Colour (Maximum Size 1 MB)" />
                    </div>

                    <div class="mb-4">
                        <x-input id="social_media_links" name="input_text_29"
                            label="Social Media Links (Instagram, Facebook, Twitter)" />
                    </div>

                    <div class="mb-4">
                        <x-textarea id="team_knowledge" name="description_11" rows="4"
                            label="How much do you know about our team, our pageant?" />
                    </div>

                    <div class="mb-4">
                        <x-checkbox id="terms_acceptance" name="acceptance-checkbox" value="Yes"
                            label="I acknowledge that I have read and understood all the terms and conditions. I agree to the Terms and Conditions" />
                    </div>

                    <div class="flex justify-end">
                        <x-button rounded="sm" primary label="Submit" />
                    </div>
                </fieldset>
            </form>



        </div>
    </div>

    <wireui:scripts />
    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
