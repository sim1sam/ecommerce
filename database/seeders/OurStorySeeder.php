<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomPage;

class OurStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if Our Story page already exists
        $existingPage = CustomPage::where('slug', 'our-story')->first();
        
        if (!$existingPage) {
            CustomPage::create([
                'page_name' => 'Our Story',
                'slug' => 'our-story',
                'description' => '<h2>Rooted in Heritage, Crafted for Today</h2>
<p>Our journey began with a heartfelt desire to reconnect with our roots and celebrate the timeless artistry of South Asian jewellery.</p>
<p>Growing up, jewellery was never just an accessory - it was part of our culture, our celebrations, and our everyday lives. Each piece carried meaning: a grandmother\'s bangle, a mother\'s necklace, a gift marking life\'s milestones. These heirlooms reminded us of who we are and the stories woven into our traditions.</p>
<p>With this inspiration, we created a brand that honours the beauty of our heritage while embracing the style of today. Every design in our collection is rooted in traditional craftsmanship, reimagined for the modern wearer who values both culture and convenience. From delicate details to bold statement pieces, our jewellery is made to be cherished every day, not just on special occasions.</p>
<p>At its core, our mission is about more than jewellery. It\'s about carrying forward the richness of tradition, sharing the beauty of our culture, and making it easy to embrace pieces that feel meaningful and personal. Each design is created with love, so you can wear it with pride and carry a little piece of your story wherever you go.</p>',
                'status' => 1,
            ]);
            
            $this->command->info('Our Story custom page created successfully!');
        } else {
            $this->command->info('Our Story custom page already exists.');
        }
    }
}
