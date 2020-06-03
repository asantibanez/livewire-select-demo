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
            ->get()
            ->map(function (CarModel $carModel) {
                return [
                    'value' => $carModel->id,
                    'description' => $carModel->name,
                ];
            });
    }
}
