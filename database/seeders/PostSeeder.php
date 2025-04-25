<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Attach posts to the first user

        $titlesAndContents = [
            ['AI in Education', 'Artificial Intelligence is revolutionizing how students learn and interact with educational platforms.'],
            ['Benefits of Meditation', 'Meditation helps reduce stress and increase mental clarity.'],
            ['Top 5 Programming Languages in 2025', 'From Python to Rust, we explore the most in-demand languages.'],
            ['Healthy Eating Tips', 'Discover how to balance your diet and maintain good nutrition.'],
            ['The Future of Space Travel', 'SpaceX and NASA are making commercial space trips a reality.'],
            ['Home Workout Routines', 'Stay fit with easy exercises you can do at home.'],
            ['Best Books of the Year', 'A curated list of must-read books for all genres.'],
            ['Starting a Business Online', 'Learn how to launch your own e-commerce brand.'],
            ['Traveling to Japan', 'Experience the culture, food, and hidden gems of Japan.'],
            ['Mental Health Awareness', 'Why it’s important to talk about mental health openly.'],
            ['How to Brew Better Coffee', 'Tips and tools to make the perfect cup at home.'],
            ['Learning a New Language', 'Effective strategies for mastering a foreign language.'],
            ['Tech Gadgets You’ll Love', 'A review of the latest must-have devices.'],
            ['Cybersecurity Tips', 'Protect your personal data in the digital world.'],
            ['Creative Writing Hacks', 'Unleash your imagination with these writing exercises.'],
        ];

        foreach ($titlesAndContents as $item) {
            Post::create([
                'title'   => $item[0],
                'content' => $item[1],
                'image'   => 'default.png',
                'user_id' => $user->id,
            ]);
        }
    }
}