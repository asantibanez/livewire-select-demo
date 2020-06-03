<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    @livewireStyles
</head>
<body class="bg-gray-200 p-6">

<div class="container mx-auto p-6 border-4 rounded-lg border-indigo-200 bg-indigo-100 space-y-6">

    <h1 class="text-3xl font-bold text-indigo-700">
        Your next adventure awaits!
    </h1>

    <p class="text-gray-700">
        Choose your ride for your upcoming journey. Let us worry about the gas and tolls. You just enjoy.
    </p>

    @if(request()->filled('name'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <div class="block sm:inline">Just relax and wait for your car</div>
            <div class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                </svg>
            </div>
        </div>
    @endif

    <form action="" method="get">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="col-span-1 sm:col-span-3">
                <label class="text-indigo-500 text-sm">
                    Name
                </label>
                <div class="mt-2">
                    <input
                        type="text"
                        class="p-2 border rounded w-full"
                        name="name"
                        value="{{ request('name') }}"
                        placeholder="Rolo Tomasi"
                    />
                </div>
                @if(request()->has('name') && !request()->filled('name'))
                    <div class="text-red-500 text-xs mt-2">
                        Must specify name
                    </div>
                @endif
            </div>

            <div class="col-span-1">
                <label class="text-indigo-500 text-sm">
                    City
                </label>
                <div class="mt-2">
                    <livewire:car-city-select
                        name="car_city_id"
                        placeholder="Starting from"
                        :value="request('car_city_id')"
                        :searchable="true"
                    />
                </div>
            </div>

            <div class="col-span-1">
                <label class="text-indigo-500 text-sm">
                    Brand
                </label>
                <div class="mt-2">
                    <livewire:car-brand-select
                        name="car_brand_id"
                        placeholder="Choose a Brand"
                        :value="request('car_brand_id')"
                        :depends-on="['car_city_id']"
                        :depends-on-values="['car_city_id' => request('car_city_id')]"
                        :wait-for-dependencies-to-show="true"
                    />
                </div>
            </div>

            <div class="col-span-1">
                <label class="text-indigo-500 text-sm">
                    Model
                </label>
                <div class="mt-2">
                    <livewire:car-model-select
                        name="car_model_id"
                        placeholder="Choose a City"
                        :value="request('car_model_id')"
                        :depends-on="['car_brand_id']"
                        :depends-on-values="['car_brand_id' => request('car_brand_id')]"
                        :wait-for-dependencies-to-show="true"
                    />
                </div>
            </div>

            <div class="flex space-x-2 mt-4">
                <button
                    type="submit"
                    class="border w-24 py-2 px-4 bg-indigo-700 text-white border-indigo-300 rounded-lg">
                    Confirm
                </button>
                <a
                    href="/"
                    class="block w-24 text-center border py-2 px-4 bg-white border-gray-300 rounded-lg">
                    Cancel
                </a>
            </div>
        </div>
    </form>

    @livewireScripts
    <script>
        window.livewire.on('focus-search', (data) => {
            document.getElementById(`${data.name}`).focus();
        });
    </script>
</body>
</html>
