<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            // Featured Members with full descriptions
            [
                'name' => 'Santosh Sapkota',
                'position' => 'Founder / Chairman',
                'image' => '/assets/images/team/chairman_santosh_sapkota.png',
                'description' => '<p>The man with plans and the vision to execute them effectively, Mr. Santosh Sapkota currently holds the position of chairman and event director for E-planet Pvt. Ltd, the official organizer of the international pageant miss heritage international. In 15 years of span of time Mr. Santosh sapkota now is the country director for more than 30 numbers of international beauty pageants for nepal, india and singapore also the chairman of international pageant called pageants of heritage and the recipient of various international awards.</p>
                
<h3>Chairman Holds the positions:</h3>
<ul>
<li>HERITAGE PAGEANTS (Pageantofheritage) – Founder/ Chairman/ Event Director</li>
<li>Eplanet Private Limited – Singapore – Founder/Chairman</li>
<li>Eplanet Private Limited – Nepal – Founder/Chairman</li>
<li>Eplanet Travels & Tours – Nepal – Founder/Chairman</li>
<li>Sanjivani Community Hospital – Nepal – Founder/Director</li>
<li>Event Planet INC. – USA – Co-Founder / Director</li>
<li>Eplanet Enterprises – Nepal – PROPRIETOR</li>
<li>We for All (Non Profitable Organization) – Founder/ Chairman</li>
</ul>',
                'facebook_url' => 'https://www.facebook.com/Santo.17sapkota',
                'instagram_url' => 'https://www.instagram.com/santoshsapkota_/',
                'linkedin_url' => 'https://www.linkedin.com/in/eplanet/',
                'whatsapp_url' => 'http://+9779851057260',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Susan Sanfurni Koh',
                'position' => 'Director',
                'image' => '/assets/images/team/director_susan.jpeg',
                'description' => '<p>A highly motivated and experienced entrepreneur. Had successfully owned and established F & B outlets, fashion and construction businesses in Singapore. She is constantly seeking for new challenges which will utilize her meticulous attention to detail, friendly and professional manner.</p>

<p><strong>Positions:</strong><br>
Eplanet Pte Ltd – Founder Director<br>
Heritage Pageants<br>
International Pageant Director</p>',
                'facebook_url' => 'https://www.facebook.com/profile.php?id=61553774173217',
                'instagram_url' => 'https://www.instagram.com/susankoh666/',
                'linkedin_url' => null,
                'whatsapp_url' => null,
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Culvin Mavunga',
                'position' => 'President',
                'image' => '/assets/images/team/president_culvin.jpeg',
                'description' => '<p>Mister Mavunga, the man with vision and plans full of energy and enthusiasm, determined to execute his plans to make things happen in an effective way. As the founding President of Heritage Pageants, Mister Culvin has played a role of guardian to nurture and bring up Heritage Pageants to this level with his knowledge, experience and dedication.</p>

<p><strong>About President</strong><br>
Heritage Pageants President<br>
& International Relation<br>
CEO- Sipiti Media, Zimbabwe<br>
Founding President- Fashion League</p>',
                'facebook_url' => '#',
                'instagram_url' => '#',
                'linkedin_url' => null,
                'whatsapp_url' => null,
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Durga Bishural',
                'position' => 'Asst. Coordinator',
                'image' => '/assets/images/team/director_durga.jpeg',
                'description' => null,
                'facebook_url' => '#',
                'instagram_url' => '#',
                'linkedin_url' => null,
                'whatsapp_url' => null,
                'is_featured' => false,
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}
