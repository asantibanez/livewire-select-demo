<?php

namespace App\Http\Livewire;

use App\CarModel;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class CarModelSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return CarModel::query()
            ->when($this->hasDependency('car_brand_id'), function ($query) {
                $query->where('car_brand_id', $this->getDependingValue('car_brand_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->get()
            ->map(function (CarModel $carModel) {
                return [
                    'value' => $carModel->id,
                    'description' => $carModel->name,
                ];
            });
    }

    public function selectedOption($value)
    {
        $carModel = CarModel::find($value);

        return [
            'title' => optional($carModel)->name,
        ];
    }
}
