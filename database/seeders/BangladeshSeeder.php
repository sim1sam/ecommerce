<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\City;

class BangladeshSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Bangladesh country (ID: 10)
        $bangladesh = Country::find(10);
        
        if (!$bangladesh) {
            $this->command->error('Bangladesh country not found!');
            return;
        }

        $this->command->info('Seeding Bangladesh states and cities...');

        // Bangladesh States and their Cities
        $statesData = [
            'Dhaka' => [
                'Dhaka', 'Gazipur', 'Narayanganj', 'Tangail', 'Kishoreganj', 'Manikganj', 'Munshiganj', 'Rajbari', 'Shariatpur', 'Faridpur', 'Gopalganj', 'Madaripur', 'Narsingdi'
            ],
            'Chittagong' => [
                'Chittagong', 'Cox\'s Bazar', 'Rangamati', 'Bandarban', 'Khagrachhari', 'Feni', 'Lakshmipur', 'Noakhali', 'Chandpur', 'Comilla', 'Brahmanbaria'
            ],
            'Rajshahi' => [
                'Rajshahi', 'Bogra', 'Joypurhat', 'Naogaon', 'Natore', 'Chapai Nawabganj', 'Pabna', 'Sirajganj'
            ],
            'Khulna' => [
                'Khulna', 'Bagerhat', 'Chuadanga', 'Jashore', 'Jhenaidah', 'Kushtia', 'Magura', 'Meherpur', 'Narail', 'Satkhira'
            ],
            'Barisal' => [
                'Barisal', 'Barguna', 'Bhola', 'Jhalokati', 'Patuakhali', 'Pirojpur'
            ],
            'Sylhet' => [
                'Sylhet', 'Habiganj', 'Moulvibazar', 'Sunamganj'
            ],
            'Rangpur' => [
                'Rangpur', 'Dinajpur', 'Gaibandha', 'Kurigram', 'Lalmonirhat', 'Nilphamari', 'Panchagarh', 'Thakurgaon'
            ],
            'Mymensingh' => [
                'Mymensingh', 'Jamalpur', 'Netrokona', 'Sherpur'
            ]
        ];

        $stateCount = 0;
        $cityCount = 0;

        foreach ($statesData as $stateName => $cities) {
            // Create state
            $state = CountryState::updateOrCreate(
                [
                    'country_id' => $bangladesh->id,
                    'name' => $stateName
                ],
                [
                    'slug' => strtolower(str_replace(' ', '-', $stateName)),
                    'status' => 1
                ]
            );

            $stateCount++;

            // Create cities for this state
            foreach ($cities as $cityName) {
                City::updateOrCreate(
                    [
                        'country_state_id' => $state->id,
                        'name' => $cityName
                    ],
                    [
                        'slug' => strtolower(str_replace([' ', '\''], ['-', ''], $cityName)),
                        'status' => 1
                    ]
                );
                $cityCount++;
            }

            $this->command->info("✓ {$stateName} state with " . count($cities) . " cities");
        }

        $this->command->info("\n🎉 Bangladesh seeding completed!");
        $this->command->info("📊 Statistics:");
        $this->command->info("   • States: {$stateCount}");
        $this->command->info("   • Cities: {$cityCount}");
        $this->command->info("   • Country: Bangladesh (ID: {$bangladesh->id})");
    }
}