<?php

namespace App\Http\Livewire;

use App\CarBrand;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class CarBrandSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return CarBrand::query()
            ->when($this->hasDependency('car_city_id'), function ($query) {
                $query->where('car_city_id', $this->getDependingValue('car_city_id'));
            })
            ->get()
            ->map(function (CarBrand $carBrand) {
                return [
                    'value' => $carBrand->id,
                    'description' => $carBrand->name,
                ];
            });
    }

    public function selectedOption($value = null)
    {
        if ($value == null) {
            return null;
        }

        $carBrand = CarBrand::find($value);

        return [
            'title' => $carBrand->name,
        ];
    }
}
