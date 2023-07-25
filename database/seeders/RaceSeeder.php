<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Race;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Race::insert([
            [
                'id'                    => Str::uuid(),
                'name'                  => 'Triathlon Dar Bouazza',
                'description'           => 'Le Triathlon Dar Bouazza est un événement sportif qui se déroule à Dar Bouazza, Casablanca, Maroc. Il s\'agit d\'un triathlon de distance olympique (1,5 km de natation, 40 km de vélo et 10 km de course à pied) qui se déroule sur 3 jours.',
                'images'                => \App\Helpers::addMediaFromUrlToCollection(new Race(), 'https://static.lematin.ma/files/lematin/images/articles/2017/09/Triathlon-.jpg', 'local_files')->file_name,
                'date'                  => '2023-10-10',
                'slug'                  => 'triathlon-dar-bouazza-casablanca',
                'race_location_id'      => 1,
                'category_id'           => 3, // Assuming 'Triathlon' category has an ID of 3
                'start_registration'    => date('Y-m-d', strtotime('+1 day')),
                'end_registration'      => date('Y-m-d', strtotime('+30 day')),
                'registration_deadline' => date('Y-m-d', strtotime('+30 day')),
                'number_of_racers'      => 100,
                'elevation_gain'        => 100,
                'number_of_days'        => 3,
                'price'                 => 1000,
                'discount_price'        => 800,
                'social_media'          => json_encode([
                    ['name' => 'Facebook', 'value' => 'https://www.facebook.com/triathlondarabouazza'],
                    ['name' => 'Instagram', 'value' => 'https://www.instagram.com/triathlondarabouazza'],
                ]),
                'sponsors' => json_encode([
                    ['name' => 'ABC Company', 'image' => 'https://example.com/images/abc.png', 'link' => 'https://www.abc.com'],
                    ['name' => 'XYZ Corporation', 'image' => 'https://example.com/images/xyz.png', 'link' => 'https://www.xyz.com'],
                ]),
                'course' => json_encode([
                    'name' => [
                        'name' => 'Swim',
                        'distance' => 1.5, // Swimming distance in km
                        'nature' => 'Ocean', // Nature of the swimming course
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, vitae aliquam nisl nunc eget nunc. Sed vitae nisl eget nisl aliquam ultricies. Sed vitae nisl eget nisl aliquam ultricies.', // Description of the swimming course
                    ],
                    'name' => [
                        'name' => 'Bike',
                        'distance' => 40, // Cycling distance in km
                        'type' => 'Roulant', // Type of cycling course
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, vitae aliquam nisl nunc eget nunc. Sed vitae nisl eget nisl aliquam ultricies. Sed vitae nisl eget nisl aliquam ultricies.', // Description of the swimming course
                    ],
                    'name' => [
                        'name' => 'Run',
                        'distance' => 10, // Running distance in km
                        'type' => 'Valloné', // Type of running course
                        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, vitae aliquam nisl nunc eget nunc. Sed vitae nisl eget nisl aliquam ultricies. Sed vitae nisl eget nisl aliquam ultricies.', // Description of the swimming course
                    ],
                ]),
                'features' => json_encode([
                    'Tshirt',
                    'Sac',
                    'Médaille du finisher',
                    'Résultats',
                    'Prix',
                    'Ravitaillement pendant la course',
                    'Ravitaillement post-course',
                ]),
                'options'  => null,
                'calendar' => json_encode([
                    [
                        'date'   => '14/07',
                        'events' => [
                            [
                                'start_time' => '18h00',
                                'end_time'   => '20h00',
                                'activity'   => 'Pasta Party',
                            ],
                        ],
                    ],
                    [
                        'date'   => '15/07',
                        'events' => [
                            [
                                'start_time' => '07h00',
                                'end_time'   => '09h00',
                                'activity'   => 'Accueil des participants',
                            ],
                            [
                                'start_time' => '09h00',
                                'end_time'   => '16h00',
                                'activity'   => 'Épreuves',
                            ],
                            [
                                'start_time' => '16h00',
                                'end_time'   => '16h00',
                                'activity'   => 'Fin des épreuves',
                            ],
                        ],
                    ],
                    [
                        'date'   => '16/07',
                        'events' => [
                            [
                                'start_time' => '10h00',
                                'end_time'   => '11h00',
                                'activity'   => 'Remise des prix',
                            ],
                            [
                                'start_time' => '11h00',
                                'end_time'   => '12h00',
                                'activity'   => 'Clôture',
                            ],
                        ],
                    ],
                ]),
                'status' => true,
            ],
            // Add more races if needed...
        ]);
        
    }
}
