<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            // Males
            [
                'name' => 'James Reyes',
                'email' => 'james.reyes@example.com',
                'age' => 25,
                'bio' => 'Adventure seeker and coffee lover. I enjoy hiking, photography, and exploring new places. Looking for someone to share unforgettable experiences with.',
            ],
            [
                'name' => 'Marco Santos',
                'email' => 'marco.santos@example.com',
                'age' => 28,
                'bio' => 'Chef by passion, engineer by profession. I cook on weekends and unwind with acoustic guitar. Fluent in sarcasm and dad jokes.',
            ],
            [
                'name' => 'Daniel Cruz',
                'email' => 'daniel.cruz@example.com',
                'age' => 30,
                'bio' => 'Bookworm and amateur astronomer. I believe every person has a story worth hearing. Let\'s talk about life over good food and better wine.',
            ],
            [
                'name' => 'Luis Fernandez',
                'email' => 'luis.fernandez@example.com',
                'age' => 23,
                'bio' => 'Fresh grad living independently for the first time. Gym rat on weekdays, beach bum on weekends. Still figuring out adulting but doing okay.',
            ],
            [
                'name' => 'Carlos Mendoza',
                'email' => 'carlos.mendoza@example.com',
                'age' => 32,
                'bio' => 'Architect with a love for minimalist design and maximalist travel. I have been to 14 countries and counting. Looking for a travel buddy and more.',
            ],
            // Females
            [
                'name' => 'Sofia Rivera',
                'email' => 'sofia.rivera@example.com',
                'age' => 24,
                'bio' => 'Teacher by day, painter by night. I find beauty in small moments and believe kindness is always in style. Loves cats, iced coffee, and sunsets.',
            ],
            [
                'name' => 'Isabella Torres',
                'email' => 'isabella.torres@example.com',
                'age' => 27,
                'bio' => 'Nurse with a big heart and an even bigger appetite. I work hard and play harder. Looking for someone genuine who is not afraid to be vulnerable.',
            ],
            [
                'name' => 'Camille Garcia',
                'email' => 'camille.garcia@example.com',
                'age' => 26,
                'bio' => 'Marketing creative who talks too fast when excited. Obsessed with K-dramas, matcha lattes, and spontaneous road trips. Swipe right if you love dogs.',
            ],
            [
                'name' => 'Natalie Lim',
                'email' => 'natalie.lim@example.com',
                'age' => 29,
                'bio' => 'Finance analyst who secretly wants to open a bakery someday. I bake when stressed and stress-eat what I bake. Looking for someone patient and sweet.',
            ],
            [
                'name' => 'Angela Villanueva',
                'email' => 'angela.villanueva@example.com',
                'age' => 22,
                'bio' => 'Nursing student and aspiring traveler. Currently surviving on coffee and determination. Dream date: street food tour followed by stargazing.',
            ],
        ];

        foreach ($samples as $sample) {
            $user = User::firstOrCreate(
                ['email' => $sample['email']],
                [
                    'name' => $sample['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            Profile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'age' => $sample['age'],
                    'bio' => $sample['bio'],
                ]
            );
        }
    }
}
