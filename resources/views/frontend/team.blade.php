@extends('layouts.frontend-new')

@section('content')
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .team-member-card {
            transition: all 0.3s ease;
        }

        .team-member-card:hover {
            transform: translateY(-5px);
        }

        .team-member-card:hover .member-image {
            transform: scale(1.05);
        }

        .team-member-card:hover .overlay {
            opacity: 1;
        }

        .social-link {
            @apply text-gold/60 hover:text-gold transition-colors duration-300;
        }

        .pageant-card {
            background: rgba(17, 24, 39, 0.2);
            backdrop-filter: blur(10px);
        }

        .profile-image {
            width: 400px;
            height: 500px;
            object-fit: cover;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .member-image {
            height: 400px;
            object-fit: cover;
        }
    </style>

    <!-- Banner Section -->
    <div class="relative overflow-hidden bg-gradient-to-b from-gray-900 to-gray-800 pb-12 pt-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 text-center">
                <h1 class="pageant-heading">
                    Meet Our Team
                </h1>
                <p class="text-gold/80 mx-auto mb-4 max-w-3xl text-xl font-light">
                    The dedicated individuals behind Heritage Pageants
                </p>
            </div>
        </div>
        <!-- Decorative elements -->
        <div class="absolute left-1/2 top-1/2 h-full w-full max-w-7xl -translate-x-1/2 -translate-y-1/2">
            <div class="sparkle absolute left-1/4 top-1/4"></div>
            <div class="sparkle absolute right-1/4 top-3/4" style="animation-delay: 0.5s"></div>
            <div class="sparkle absolute left-1/2 top-1/2" style="animation-delay: 1s"></div>
        </div>
    </div>

    <!-- Leadership Section -->
    <div class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="space-y-24">
                <!-- Santosh Sapkota -->
                <div class="group relative overflow-hidden rounded-2xl p-8 transition-all duration-500">
                    <div class="relative z-10 flex items-center gap-12">
                        <div class="flex-1">
                            <h2 class="text-gold mb-4 text-4xl font-bold">Santosh Sapkota</h2>
                            <h3 class="text-gold/80 mb-6 text-2xl">Founder / Chairman</h3>
                            <div class="mb-8 flex space-x-4">
                                <a href="https://www.facebook.com/Santo.17sapkota" target="_blank" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/>
                                    </svg>
                                </a>
                                <a href="https://www.instagram.com/santoshsapkota_/" target="_blank" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2.2c3.2,0,3.6,0,4.9,0.1c3.3,0.1,4.8,1.7,4.9,4.9c0.1,1.3,0.1,1.6,0.1,4.8c0,3.2,0,3.6-0.1,4.8c-0.1,3.2-1.7,4.8-4.9,4.9c-1.3,0.1-1.6,0.1-4.9,0.1c-3.2,0-3.6,0-4.8-0.1c-3.3-0.1-4.8-1.7-4.9-4.9c-0.1-1.3-0.1-1.6-0.1-4.8c0-3.2,0-3.6,0.1-4.8c0.1-3.2,1.7-4.8,4.9-4.9C8.4,2.2,8.8,2.2,12,2.2z M12,0C8.7,0,8.3,0,7.1,0.1c-4.4,0.2-6.8,2.6-7,7C0,8.3,0,8.7,0,12s0,3.7,0.1,4.9c0.2,4.4,2.6,6.8,7,7C8.3,24,8.7,24,12,24s3.7,0,4.9-0.1c4.4-0.2,6.8-2.6,7-7C24,15.7,24,15.3,24,12s0-3.7-0.1-4.9c-0.2-4.4,2.6-6.8,7-7C15.7,0,15.3,0,12,0z M12,5.8c-3.4,0-6.2,2.8-6.2,6.2s2.8,6.2,6.2,6.2s6.2-2.8,6.2-6.2S15.4,5.8,12,5.8z M12,16c-2.2,0-4-1.8-4-4s1.8-4,4-4s4,1.8,4,4S14.2,16,12,16z"/>
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/in/eplanet/" target="_blank" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M9,17H6.5v-7H9V17z M7.7,8.7c-0.8,0-1.4-0.7-1.4-1.4c0-0.8,0.6-1.4,1.4-1.4c0.8,0,1.4,0.6,1.4,1.4C9.1,8.1,8.5,8.7,7.7,8.7z M18,17h-2.4v-3.8c0-1.1,0-2.5-1.5-2.5s-1.8,1.2-1.8,2.5V17h-2.4v-7h2.3v1h0c0.4-0.7,1.3-1.5,2.7-1.5c2.9,0,3.4,1.9,3.4,4.3V17z"/>
                                    </svg>
                                </a>
                                <a href="http://+9779851057260" target="_blank" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.6,6.2c-1.5-1.5-3.4-2.3-5.6-2.3c-4.3,0-7.9,3.5-7.9,7.9c0,1.4,0.4,2.8,1.1,4l-1.2,4.3l4.4-1.2c1.2,0.6,2.5,1,3.8,1h0c4.3,0,7.9-3.5,7.9-7.9C20,9.7,19.1,7.7,17.6,6.2z M12,18.7h0c-1.2,0-2.3-0.3-3.3-0.9l-0.2-0.1l-2.4,0.6l0.6-2.3l-0.1-0.2c-0.7-1.1-1-2.3-1-3.6c0-3.6,3-6.6,6.6-6.6c1.8,0,3.4,0.7,4.7,1.9c1.2,1.2,1.9,2.9,1.9,4.7C18.7,15.7,15.7,18.7,12,18.7z M15.9,13.5c-0.2-0.1-1.2-0.6-1.4-0.7c-0.2-0.1-0.3-0.1-0.4,0.1c-0.1,0.2-0.4,0.7-0.5,0.8c-0.1,0.1-0.2,0.1-0.4,0c-0.2-0.1-0.8-0.3-1.6-1c-0.6-0.5-1-1.2-1.1-1.4c-0.1-0.2,0-0.3,0.1-0.4c0.1-0.1,0.2-0.2,0.3-0.3c0.1-0.1,0.1-0.2,0.2-0.3c0.1-0.1,0-0.2,0-0.3c0-0.1-0.4-1-0.6-1.4c-0.2-0.4-0.3-0.3-0.4-0.3c-0.1,0-0.3,0-0.4,0c-0.1,0-0.3,0.1-0.5,0.3c-0.2,0.2-0.6,0.6-0.6,1.5c0,0.9,0.6,1.7,0.7,1.8c0.1,0.1,1.4,2.1,3.3,2.9c0.5,0.2,0.8,0.3,1.1,0.4c0.5,0.1,0.9,0.1,1.2,0.1c0.4-0.1,1.2-0.5,1.3-0.9c0.2-0.5,0.2-0.9,0.1-1C16.3,13.7,16.1,13.6,15.9,13.5z"/>
                                    </svg>
                                </a>
                            </div>
                            <p class="mb-6 text-lg text-gray-300">The man with plans and the vision to execute them effectively, Mr. Santosh Sapkota currently holds the position of chairman and event director for E-planet Pvt. Ltd, the official organizer of the international pageant miss heritage international. In 15 years of span of time Mr. Santosh sapkota now is the country director for more than 30 numbers of international beauty pageants for nepal, india and singapore also the chairman of international pageant called pageants of heritage and the recipient of various international awards.</p>
                            
                            <h3 class="text-gold mb-4 text-xl font-semibold">Chairman Holds the positions:</h3>
                            <ul class="mb-6 list-inside list-disc space-y-2 text-gray-300">
                                <li>HERITAGE PAGEANTS (Pageantofheritage) – Founder/ Chairman/ Event Director</li>
                                <li>Eplanet Private Limited – Singapore – Founder/Chairman</li>
                                <li>Eplanet Private Limited – Nepal – Founder/Chairman</li>
                                <li>Eplanet Travels & Tours – Nepal – Founder/Chairman</li>
                                <li>Sanjivani Community Hospital – Nepal – Founder/Director</li>
                                <li>Event Planet INC. – USA – Co-Founder / Director</li>
                                <li>Eplanet Enterprises – Nepal – PROPRIETOR</li>
                                <li>We for All (Non Profitable Organization) – Founder/ Chairman</li>
                            </ul>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="/assets/images/team/chairman_santosh_sapkota.png" 
                                 alt="Santosh Sapkota" 
                                 class="profile-image"
                                 loading="lazy"
                                 >
                        </div>
                    </div>
                </div>

                <!-- SUSAN SANFURNI KOH -->
                <div class="group relative overflow-hidden rounded-2xl p-8 transition-all duration-500">
                    <div class="relative z-10 flex items-center gap-12">
                        <div class="flex-shrink-0">
                            <img src="/assets/images/team/director_susan.jpeg" 
                                 alt="Susan Koh" 
                                 class="profile-image"
                                 loading="lazy"
                                 >
                        </div>
                        <div class="flex-1">
                            <h2 class="text-gold mb-4 text-4xl font-bold">SUSAN SANFURNI KOH</h2>
                            <h3 class="text-gold/80 mb-6 text-2xl">Director</h3>
                            <div class="mb-8 flex space-x-4">
                                <a href="https://www.facebook.com/profile.php?id=61553774173217" target="_blank" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/>
                                    </svg>
                                </a>
                                <a href="https://www.instagram.com/susankoh666/" target="_blank" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2.2c3.2,0,3.6,0,4.9,0.1c3.3,0.1,4.8,1.7,4.9,4.9c0.1,1.3,0.1,1.6,0.1,4.8c0,3.2,0,3.6-0.1,4.8c-0.1,3.2-1.7,4.8-4.9,4.9c-1.3,0.1-1.6,0.1-4.9,0.1c-3.2,0-3.6,0-4.8-0.1c-3.3-0.1-4.8-1.7-4.9-4.9c-0.1-1.3-0.1-1.6-0.1-4.8c0-3.2,0-3.6,0.1-4.8c0.1-3.2,1.7-4.8,4.9-4.9C8.4,2.2,8.8,2.2,12,2.2z M12,0C8.7,0,8.3,0,7.1,0.1c-4.4,0.2-6.8,2.6-7,7C0,8.3,0,8.7,0,12s0,3.7,0.1,4.9c0.2,4.4,2.6,6.8,7,7C8.3,24,8.7,24,12,24s3.7,0,4.9-0.1c4.4-0.2,6.8-2.6,7-7C24,15.7,24,15.3,24,12s0-3.7-0.1-4.9c-0.2-4.4,2.6-6.8,7-7C15.7,0,15.3,0,12,0z M12,5.8c-3.4,0-6.2,2.8-6.2,6.2s2.8,6.2,6.2,6.2s6.2-2.8,6.2-6.2S15.4,5.8,12,5.8z M12,16c-2.2,0-4-1.8-4-4s1.8-4,4-4s4,1.8,4,4S14.2,16,12,16z"/>
                                    </svg>
                                </a>
                            </div>
                            <p class="mb-4 text-lg text-gray-300">A highly motivated and experienced entrepreneur. Had successfully owned and established F & B outlets, fashion and construction businesses in Singapore. She is constantly seeking for new challenges which will utilize her meticulous attention to detail, friendly and professional manner.</p>
                            <p class="text-lg text-gray-300">Eplanet Pte Ltd – Founder Director<br>Heritage Pageants<br>International Pageant Director</p>
                        </div>
                    </div>
                </div>

                <!-- Culvin Mavunga -->
                <div class="group relative overflow-hidden rounded-2xl p-8 transition-all duration-500">
                    <div class="relative z-10 flex items-center gap-12">
                        <div class="flex-1">
                            <h2 class="text-gold mb-4 text-4xl font-bold">Culvin Mavunga</h2>
                            <h3 class="text-gold/80 mb-6 text-2xl">President</h3>
                            <div class="mb-8 flex space-x-4">
                                <a href="#" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/>
                                    </svg>
                                </a>
                                <a href="#" class="social-link">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2.2c3.2,0,3.6,0,4.9,0.1c3.3,0.1,4.8,1.7,4.9,4.9c0.1,1.3,0.1,1.6,0.1,4.8c0,3.2,0,3.6-0.1,4.8c-0.1,3.2-1.7,4.8-4.9,4.9c-1.3,0.1-1.6,0.1-4.9,0.1c-3.2,0-3.6,0-4.8-0.1c-3.3-0.1-4.8-1.7-4.9-4.9c-0.1-1.3-0.1-1.6-0.1-4.8c0-3.2,0-3.6,0.1-4.8c0.1-3.2,1.7-4.8,4.9-4.9C8.4,2.2,8.8,2.2,12,2.2z M12,0C8.7,0,8.3,0,7.1,0.1c-4.4,0.2-6.8,2.6-7,7C0,8.3,0,8.7,0,12s0,3.7,0.1,4.9c0.2,4.4,2.6,6.8,7,7C8.3,24,8.7,24,12,24s3.7,0,4.9-0.1c4.4-0.2,6.8-2.6,7-7C24,15.7,24,15.3,24,12s0-3.7-0.1-4.9c-0.2-4.4,2.6-6.8,7-7C15.7,0,15.3,0,12,0z M12,5.8c-3.4,0-6.2,2.8-6.2,6.2s2.8,6.2,6.2,6.2s6.2-2.8,6.2-6.2S15.4,5.8,12,5.8z M12,16c-2.2,0-4-1.8-4-4s1.8-4,4-4s4,1.8,4,4S14.2,16,12,16z"/>
                                    </svg>
                                </a>
                            </div>
                            <p class="mb-4 text-lg text-gray-300">Mister Mavunga, the man with vision and plans full of energy and enthusiasm, determined to execute his plans to make things happen in an effective way. As the founding President of Heritage Pageants, Mister Culvin has played a role of guardian to nurture and bring up Heritage Pageants to this level with his knowledge, experience and dedication.</p>
                            <p class="text-lg text-gray-300">About President<br>Heritage Pageants President<br>& International Relation<br>CEO- Sipiti Media, Zimbabwe<br>Founding President- Fashion League</p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="/assets/images/team/president_culvin.jpeg" 
                                 alt="Culvin Mavunga" 
                                 class="profile-image"
                                 loading="lazy"
                                 >
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Members Grid -->
            @php
                $teamMembers = [
                    [
                        'name' => 'Santosh Sapkota',
                        'position' => 'Founder/Chairman/CEO',
                        'image' => '/assets/images/team/chairman_santosh_sapkota.png',
                        'social' => [
                            'facebook' => 'https://www.facebook.com/Santo.17sapkota',
                            'instagram' => 'https://www.instagram.com/santoshsapkota_/',
                            'linkedin' => 'https://www.linkedin.com/in/eplanet/'
                        ]
                    ],
                    [
                        'name' => 'Susan Koh',
                        'position' => 'International Event Director',
                        'image' => '/assets/images/team/director_susan.jpeg',
                        'social' => [
                            'facebook' => 'https://www.facebook.com/profile.php?id=61553774173217',
                            'instagram' => 'https://www.instagram.com/susankoh666/'
                        ]
                    ],
                    [
                        'name' => 'Culvin Mavunga',
                        'position' => 'President',
                        'image' => '/assets/images/team/president_culvin.jpeg',
                        'social' => [
                            'facebook' => '#',
                            'instagram' => '#'
                        ]
                    ],
                    [
                        'name' => 'Durga Bishural',
                        'position' => 'Director',
                        'image' => '/assets/images/team/director_durga.jpeg',
                        'social' => [
                            'facebook' => '#',
                            'instagram' => '#'
                        ]
                    ]
                ];
            @endphp

            <div class="mt-24">
                <h2 class="text-gold mb-12 text-center text-3xl font-bold">Team Members</h2>
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($teamMembers as $member)
                    <div class="group relative overflow-hidden rounded-2xl bg-gray-800/20 backdrop-blur-sm transition-all duration-300">
                        <div class="relative overflow-hidden">
                            <img src="{{ $member['image'] }}" 
                                 alt="{{ $member['name'] }}" 
                                 loading="lazy"
                                 class="member-image w-full object-cover transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                            <div class="absolute bottom-0 left-0 right-0 translate-y-4 p-6 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                <div class="flex justify-center space-x-4">
                                    @if(isset($member['social']['facebook']))
                                    <a href="{{ $member['social']['facebook'] }}" target="_blank" class="social-link">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    @if(isset($member['social']['instagram']))
                                    <a href="{{ $member['social']['instagram'] }}" target="_blank" class="social-link">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12,2.2c3.2,0,3.6,0,4.9,0.1c3.3,0.1,4.8,1.7,4.9,4.9c0.1,1.3,0.1,1.6,0.1,4.8c0,3.2,0,3.6-0.1,4.8c-0.1,3.2-1.7,4.8-4.9,4.9c-1.3,0.1-1.6,0.1-4.9,0.1c-3.2,0-3.6,0-4.8-0.1c-3.3-0.1-4.8-1.7-4.9-4.9c-0.1-1.3-0.1-1.6-0.1-4.8c0-3.2,0-3.6,0.1-4.8c0.1-3.2,1.7-4.8,4.9-4.9C8.4,2.2,8.8,2.2,12,2.2z M12,0C8.7,0,8.3,0,7.1,0.1c-4.4,0.2-6.8,2.6-7,7C0,8.3,0,8.7,0,12s0,3.7,0.1,4.9c0.2,4.4,2.6,6.8,7,7C8.3,24,8.7,24,12,24s3.7,0,4.9-0.1c4.4-0.2,6.8-2.6,7-7C24,15.7,24,15.3,24,12s0-3.7-0.1-4.9c-0.2-4.4,2.6-6.8,7-7C15.7,0,15.3,0,12,0z M12,5.8c-3.4,0-6.2,2.8-6.2,6.2s2.8,6.2,6.2,6.2s6.2-2.8,6.2-6.2S15.4,5.8,12,5.8z M12,16c-2.2,0-4-1.8-4-4s1.8-4,4-4s4,1.8,4,4S14.2,16,12,16z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    @if(isset($member['social']['linkedin']))
                                    <a href="{{ $member['social']['linkedin'] }}" target="_blank" class="social-link">
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M9,17H6.5v-7H9V17z M7.7,8.7c-0.8,0-1.4-0.7-1.4-1.4c0-0.8,0.6-1.4,1.4-1.4c0.8,0,1.4,0.6,1.4,1.4C9.1,8.1,8.5,8.7,7.7,8.7z M18,17h-2.4v-3.8c0-1.1,0-2.5-1.5-2.5s-1.8,1.2-1.8,2.5V17h-2.4v-7h2.3v1h0c0.4-0.7,1.3-1.5,2.7-1.5c2.9,0,3.4,1.9,3.4,4.3V17z"/>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-gold mb-2 text-2xl font-bold">Santosh Sapkota</h3>
                            <p class="text-gold/60 text-lg">Founder/Chairman/CEO</p>
                        </div>
                    </div>
                    @endforeach

                    
                </div>
            </div>
        </div>
    </div>
@endsection