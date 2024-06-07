@php
    if(auth()->user()->role == "Admin"){
        $page = "admin.dashboard";
    }elseif (auth()->user()->role == "Client") {
        $page = "client.dashboard";
    }elseif (auth()->user()->role == "Mechanic") {
        $page = "mechanic.dashboard";
    }
@endphp

@extends($page)

@section('content')
    <div class="flex flex-col justify-center items-center max-w-screen-md px-4 sm:px-6 md:max-w-screen-xl">
        <div class="w-full flex justify-start">
            <a href={{ route('vehicles.index') }}><i class="fa-solid fa-arrow-left" style="color: #2e2e2e;"></i></a>
        </div>

        <div class="w-full p-7">
            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                    <div class="mb-5">
                        <label for="make"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Make</label>
                        <input type="text" id="make" name="make"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            value="{{ $vehicle->make }}"
                            placeholder="Brand name" required />
                    </div>

                    <div class="mb-5">
                        <label for="model" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">
                            Model</label>
                        <input type="text" id="model" name="model"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            value="{{ $vehicle->model }}"
                            placeholder="Vehicle model" required />
                    </div>

                    <div class="mb-5">
                        <label for="year"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                        <input type="text"  id="year" name="year"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            value="{{ $vehicle->year }}" 
                            required />
                    </div>

                    <div class="mb-5">
                        <label for="license_plate"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">License Plate</label>
                        <input type="text" id="license_plate" name="license_plate"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            value="{{ $vehicle->license_plate }}"
                            required />
                    </div>

                    <div class="mb-5">
                        <label for="vin"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">VIN</label>
                        <input type="text" id="vin" name="vin"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            value="{{ $vehicle->vin }}"
                            required />
                    </div>

                    <div class="mb-5">
                        <label for="fuel" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Fuel
                            Type</label>
                            <select id="fuel" name="fuelType" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                                <option value="Gasoline (Petrol)" {{ $vehicle->fuelType === 'Gasoline (Petrol)' ? 'selected' : '' }}>Gasoline (Petrol)</option>
                                <option value="Diesel" {{ $vehicle->fuelType === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Ethanol" {{ $vehicle->fuelType === 'Ethanol' ? 'selected' : '' }}>Ethanol</option>
                                <option value="Compressed Natural Gas (CNG)" {{ $vehicle->fuelType === 'Compressed Natural Gas (CNG)' ? 'selected' : '' }}>Compressed Natural Gas (CNG)</option>
                                <option value="Liquefied Petroleum Gas (LPG)" {{ $vehicle->fuelType === 'Liquefied Petroleum Gas (LPG)' ? 'selected' : '' }}>Liquefied Petroleum Gas (LPG)</option>
                            </select>
                    </div>

                    @if (auth()->user()->role == 'Admin')
                    <div class="mb-5">
                        <label for="cin"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Client CIN</label>
                        <input type="text" id="cin" name="cin" pattern="[A-Z][0-9]{6}"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            value="{{ $clientCIN }}"
                            placeholder="L000000" required />
                    </div>
                    @endif
                </div>

                <div class="grid mt-10 mb-4">
                    <button type="submit"
                        class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primaryBlack text-white hover:bg-blac">Update Vehicle</button>
                </div>
            </form>

        </div>
    </div>
@endsection
