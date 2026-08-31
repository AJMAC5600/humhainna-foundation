<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Album;
use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Faq;
use App\Models\Feedback;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -----------------------------------------------------------------
        // Settings (every value appears in the admin content editor)
        // -----------------------------------------------------------------
        $settings = [
            'org_name' => 'Hum Hain Na Foundation',
            'org_short_name' => 'Hum Hain Na',
            'org_tagline' => 'Together We Rise — a community-driven NGO working at the grassroots across education, health, environment and relief.',
            'reg_number' => 'NGO-REG-2025-MH-00123 (sample — replace with your actual number)',
            'mission' => 'To mobilize volunteers and resources for transparent, measurable community upliftment.',
            'vision' => 'A society where no one is left behind — where every citizen participates in building a compassionate, sustainable future.',
            'story' => "Founded by a small group of friends who started with weekend food drives, the Foundation has grown into a structured volunteer network running education, health, environment and relief programs year-round. Milestones of our journey are listed on the Achievements page.",
            'core_values' => "Compassion — we lead with empathy in every action.\nIntegrity — full transparency in funds and fieldwork.\nService — community first, always.\nInclusion — everyone can contribute.",
            'address' => "Hum Hain Na Foundation\nCommunity Centre, 2nd Floor\nPune, Maharashtra — 411001",
            'phone' => '+91 98765 43210',
            'helpline' => '+91 90000 12345',
            'email' => 'contact@humhainna.org',
            'office_hours' => 'Mon–Sat, 10:00 AM – 6:00 PM',
            'map_link' => null,
            'upi_id' => 'humhainnafoundation@upi',
            'bank_account_name' => 'Hum Hain Na Foundation',
            'bank_account_number' => '0123456789012345',
            'bank_ifsc' => 'SBIN0123456',
            'bank_name_branch' => 'State Bank of India, Pune Main Branch',
            'tax_note_80g' => '80G Tax Exemption — all donations are 50% tax-deductible under section 80G of the Indian Income Tax Act. Receipts carry your PAN and are emailed automatically after payment is confirmed.',
            'fund_utilization_note' => 'We publish regular reports on how donations are used — education kits delivered, camps conducted, meals distributed. Transparency is our promise.',
            'social_facebook' => null,
            'social_instagram' => null,
            'social_twitter' => null,
            'social_youtube' => null,
            'social_linkedin' => null,
            'whatsapp_number' => '+919876543210',
            'signatory_name' => 'Amit Sharma',
            'signatory_designation' => 'Founder & President',
            'hero_title' => 'Together We Rise',
            'hero_subtitle' => 'Hum Hain Na Foundation works across education, health, environment and relief — powered by volunteers and transparent giving.',
            'footer_note' => '© '.now()->year.' Hum Hain Na Foundation. All rights reserved. Registered NGO.',
        ];
        foreach ($settings as $k => $v) {
            Setting::updateOrCreate(['key' => $k], ['value' => $v]);
        }
        \Illuminate\Support\Facades\Cache::forget('hhnf.settings');

        // -----------------------------------------------------------------
        // Users
        // -----------------------------------------------------------------
        $admin = User::firstOrCreate(
            ['email' => 'admin@hhnf.local'],
            ['name' => 'HHNF Admin', 'password' => Hash::make('password'), 'role' => 'admin', 'phone' => '9876543210']
        );

        $coord = User::firstOrCreate(
            ['email' => 'coordinator@hhnf.local'],
            ['name' => 'Volunteer Coordinator', 'password' => Hash::make('password'), 'role' => 'coordinator']
        );

        // Demo volunteer account (approved) — password: password
        $volUser = User::firstOrCreate(
            ['email' => 'demo.volunteer@example.com'],
            ['name' => 'Demo Volunteer', 'password' => Hash::make('password'), 'role' => 'volunteer', 'phone' => '9000011111']
        );

        // -----------------------------------------------------------------
        // Achievements — impact counters (SRD section 4)
        // -----------------------------------------------------------------
        foreach ([
            ['counter', 'People Helped', '5,000+', 'favorite', 0],
            ['counter', 'Events Conducted', '120+', 'event_available', 1],
            ['counter', 'Active Volunteers', '300+', 'groups', 2],
            ['counter', 'Years of Service', '8+', 'schedule', 3],
        ] as [$type, $title, $value, $icon, $order]) {
            Achievement::firstOrCreate(
                ['title' => $title, 'type' => $type],
                ['value' => $value, 'icon' => $icon, 'sort_order' => $order]
            );
        }

        Achievement::firstOrCreate(
            ['title' => 'Journey Started', 'type' => 'milestone'],
            ['date' => now()->subYears(8), 'description' => 'A small group began weekend food drives in the community.', 'sort_order' => 0]
        );
        Achievement::firstOrCreate(
            ['title' => 'Registered as an NGO', 'type' => 'milestone'],
            ['date' => now()->subYears(7), 'description' => 'Official registration under the Societies Registration Act.', 'sort_order' => 1]
        );
        Achievement::firstOrCreate(
            ['title' => '100th Education Drive', 'type' => 'milestone'],
            ['date' => now()->subYears(1), 'description' => 'Celebrated 100 weekend teaching drives across rural clusters.', 'sort_order' => 2]
        );

        // -----------------------------------------------------------------
        // Events — 3 upcoming, 2 past
        // -----------------------------------------------------------------
        $events = [
            ['Free Health Checkup Camp', 'health', now()->addWeeks(2), 'Upcoming free health camp with volunteer support, registration desk and crowd management.', 'upcoming'],
            ['Winter Blanket Distribution 2025', 'relief', now()->addWeeks(4), 'Clothing and blanket distribution for families affected by seasonal temperatures.', 'upcoming'],
            ['Tree Plantation — Urban Greens Drive', 'environment', now()->addMonth(), 'Planting 1,000 saplings across the city with school partnerships.', 'upcoming'],
            ['Back-to-School Kit Drive', 'education', now()->subMonth(), 'Distributed 500 school kits to children in rural hamlets. See the Gallery for photos.', 'completed'],
            ['Flood Relief — Distribution Round', 'relief', now()->subMonths(3), 'Packed and delivered relief boxes to 300+ families.', 'completed'],
        ];
        foreach ($events as [$title, $cat, $starts, $desc, $status]) {
            Event::firstOrCreate(
                ['title' => $title],
                [
                    'slug' => Str::slug($title).'-'.Str::random(4),
                    'category' => $cat,
                    'starts_at' => $starts,
                    'ends_at' => $starts->copy()->addHours(5),
                    'location' => 'Community Centre, Pune',
                    'description' => $desc,
                    'volunteers_required' => 12,
                    'volunteer_roles' => 'Registration, logistics, photography',
                    'registration_open' => $status === 'upcoming',
                    'status' => $status,
                ]
            );
        }

        // -----------------------------------------------------------------
        // Gallery — sample albums (covers are null; upload via gallery admin)
        // -----------------------------------------------------------------
        foreach ([
            ['Winter Blanket Distribution 2024', 'relief', now()->subMonths(2)],
            ['Education Drive — Teaching Camps', 'education', now()->subMonths(4)],
            ['Health Camp — Free Checkups', 'health', now()->subMonths(1)],
        ] as [$title, $cat, $date]) {
            Album::firstOrCreate(
                ['title' => $title],
                ['category' => $cat, 'date' => $date, 'description' => 'Photos from the '.$title.' campaign — volunteer action captured for transparency.']
            );
        }

        // -----------------------------------------------------------------
        // FAQs
        // -----------------------------------------------------------------
        foreach ([
            ['How do I become a volunteer?', "Fill out the \"Join as Volunteer\" form with your details and ID proof. Once a coordinator approves your application you receive a unique Volunteer ID and a downloadable ID card with a verification QR code."],
            ['How long is my volunteer ID valid?', "One year from the date of issue, renewable each year as long as you remain an active volunteer."],
            ['Are donations eligible for 80G tax deduction?', "Yes, if your PAN is entered at the time of donating. A receipt with your PAN and our 12A/80G details is emailed once payment is confirmed."],
            ['Where can I verify a certificate or ID card?', "Every certificate and ID card carries a QR code and a number. Scan the QR or enter the number on the Certificates & Verification page."],
            ['How is my personal data kept safe?', "ID proofs are stored privately, visible only to authorized administrators, never exposed publicly. See our Privacy Policy for details."],
        ] as $i => [$q, $a]) {
            Faq::firstOrCreate(
                ['question' => $q],
                ['answer' => $a, 'sort_order' => $i]
            );
        }

        // -----------------------------------------------------------------
        // Blog — one published, one draft
        // -----------------------------------------------------------------
        BlogPost::firstOrCreate(
            ['slug' => 'welcome-to-hum-hain-na-foundation'],
            [
                'title' => 'Welcome to Hum Hain Na Foundation',
                'excerpt' => 'An introduction to who we are and the change we\'ve begun together.',
                'content' => "This is a sample announcement. Replace it with your first real story from the field — an education drive, a health camp, a volunteer reflection — and publish it with a cover photo.\n\nStories like these help donors and partners see the on-ground reality behind the numbers.",
                'published_at' => now(),
            ]
        );

        // -----------------------------------------------------------------
        // Sample volunteer linked to demo user (approved)
        // -----------------------------------------------------------------
        $vol = \App\Models\Volunteer::firstOrCreate(
            ['email' => $volUser->email],
            [
                'user_id' => $volUser->id,
                'full_name' => $volUser->name,
                'mobile' => '9000011111',
                'gender' => 'other',
                'dob' => '2001-01-01',
                'blood_group' => 'O+',
                'address' => 'Sample address',
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'pincode' => '411001',
                'areas_of_interest' => ['education', 'environment'],
                'availability' => 'weekends',
                'status' => 'approved',
                'volunteer_id' => sprintf('HHNF-%d-00001', now()->year),
                'valid_from' => now(),
                'valid_till' => now()->addYear(),
                'hours_logged' => 12,
                'consent' => true,
            ]
        );

        // -----------------------------------------------------------------
        // Testimonial feedback (visible on homepage)
        // -----------------------------------------------------------------
        foreach ([
            ['Aarav S.', 'volunteer', 'volunteering', 5, 'Volunteering here is incredibly organized — I always know my role and the impact I\'m making.'],
            ['Neha M.', 'donor', 'donation', 5, 'The receipts arrived the next day and every update shows exactly where funds go. That trust matters.'],
            ['Rohit K.', 'partner', 'website', 4, 'Professional, transparent, genuinely community-led. Looking forward to collaborating again.'],
        ] as [$name, $type, $related, $rating, $comment]) {
            Feedback::firstOrCreate(
                ['name' => $name, 'comments' => $comment],
                ['contact' => '+91 90000 00000', 'person_type' => $type, 'related_to' => $related, 'rating' => $rating, 'testimonial_consent' => true, 'show_as_testimonial' => true]
            );
        }
    }
}
