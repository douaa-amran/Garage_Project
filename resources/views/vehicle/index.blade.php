@php
    if (auth()->user()->role == 'Admin') {
        $page = 'admin.dashboard';
    } elseif (auth()->user()->role == 'Client') {
        $page = 'client.dashboard';
    } elseif (auth()->user()->role == 'Mechanic') {
        $page = 'mechanic.dashboard';
    }
@endphp

@extends($page)


@section('content')
    <div class="p-4 flex justify-end">
        <div class="flex gap-2">
            <div class="flex items-center md:w-80 sm:w-64">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fa-solid fa-car" style="color: #6b7280;"></i>
                    </div>
                    <form method="GET" action="{{ route('vehicles.index') }}" class="w-full">
                        <input type="text" name="search" id="search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5"
                            placeholder="Search vehicle..." value="{{ request('search') }}" required />
                        <button type="submit" class="absolute inset-y-0 end-0 flex items-center pe-3">
                            <i class="fa-solid fa-magnifying-glass" style="color: #6b7280;"></i>
                        </button>
                    </form>
                    
                </div>
            </div>
            <div>
                <a href={{ route('vehicles.create') }}><button type="button" data-modal-target="default-modal"
                        data-modal-toggle="default-modal"
                        class="py-3 px-4 inline-flex self-end items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-primaryBlack text-white hover:bg-black">
                        Add Vehicle</button></a>
            </div>
        </div>
    </div>
    <div class="p-4 border-t-2 border-gray-200 dark:border-gray-700">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                Make</th>
                            <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                Model</th>
                            <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                License Plate
                            </th>
                            <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                Vin</th>
                            <th scope="col" class="px-8 py-6 text-center text-xs font-medium text-gray-500 uppercase">
                                Actions</th>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $vehicle->make }}</td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $vehicle->model }}</td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $vehicle->license_plate }}</td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $vehicle->vin }}</td>
                                <td class="flex justify-center px-8 py-6 whitespace-nowrap gap-5">
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}"><button type="button"><i
                                                class="fa-solid fa-pen-to-square fa-lg"
                                                style="color: #27a305;"></i></button></a>
                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash fa-lg" style="color: #d01616;"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
