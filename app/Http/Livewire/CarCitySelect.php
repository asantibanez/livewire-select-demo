<?php

namespace App\Http\Livewire;

use App\CarCity;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class CarCitySelect extends LivewireSelect
{
    public function options($searchTerm = null) : Collection
    {
        return CarCity::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->orderBy('name')
            ->get()
            ->map(function (CarCity $carCity) {
                return [
                    'value' => $carCity->id,
                    'description' => $carCity->name,
                ];
            });
    }

    public function selectedOption($value = null)
    {
        $carCity = CarCity::find($value);

        return [
            'value' => optional($carCity)->id,
            'description' => optional($carCity)->name
        ];
    }
}
