<?php

use App\CarBrand;
use App\CarCity;
use App\CarModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'Tesla' => [
                'Model S',
                'Model 3',
                'Model X',
            ],
            'Ford' => [
                'Focus',
                'Explorer',
            ],
            'Chevrolet' => [
                'Tahoe',
                'Suburban',
                'Camaro',
                'Cruze',
            ],
            'GMC' => [
                'Yukon',
                'Yukon XL'
            ],
            'Fiat' => [
                'Uno',
                '500',
            ],
            'Volvo' => [
                'S60',
                'S90',
                'V60',
                'V90',
            ],
            'Audi' => [
                'A3 Sedan',
                'S3 Sedan',
                'S4',
                'S5 Sportback',
            ],
            'Volkswagen' => [
                'Bettle',
                'Polo',
                'Jetta',
                'Golf',
            ],
        ];

        CarCity::create(['name' => 'Guayaquil']);
        CarCity::create(['name' => 'Los Ángeles']);
        CarCity::create(['name' => 'New York']);
        CarCity::create(['name' => 'London']);
        CarCity::create(['name' => 'Munich']);
        CarCity::create(['name' => 'Louisville']);
        CarCity::create(['name' => 'New Mexico']);
        CarCity::create(['name' => 'Paris']);
        CarCity::create(['name' => 'Oslo']);
        CarCity::create(['name' => 'Cairo']);
        CarCity::create(['name' => 'Laos']);

        CarCity::all()
            ->each(function (CarCity $carCity) use ($brands) {
                $randomBrands = collect(array_rand($brands, 3));

                $randomBrands->each(function ($brand) use ($carCity, $brands) {
                    $carBrand = CarBrand::create([
                        'name' => $brand,
                        'car_city_id' => $carCity->id,
                    ]);

                    collect($brands[$brand])->each(function ($model) use ($carBrand) {
                        CarModel::create([
                            'name' => $model,
                            'car_brand_id' => $carBrand
                        ]);
                    });
                });
            });
    }
}
