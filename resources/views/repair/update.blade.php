@extends('admin.dashboard')

@section('content')
    <div class="flex flex-col justify-center items-center max-w-screen-md px-4 sm:px-6 md:max-w-screen-xl">
        <div class="w-full flex justify-start">
            <a href="{{ route('clients.index') }}"><i class="fa-solid fa-arrow-left" style="color: #2e2e2e;"></i></a>
        </div>

        <div class="w-full p-7">
            <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Hidden input for client ID -->
                <input type="hidden" name="clientId" value="{{ $repair->clientId }}">

                <div class="flex flex-col justify-center">
                    <div class="mb-5">
                        <label for="status"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="Pending" {{ $repair->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ $repair->status === 'In Progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="Completed" {{ $repair->status === 'Completed' ? 'selected' : '' }}>Completed
                            </option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-x-6">
                        <div class="mb-5">
                            <label for="startDate"
                                class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                            <input type="date" id="startDate" name="startDate"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                value="{{ $repair->startDate }}" required />
                        </div>

                        <div class="mb-5">
                            <label for="endDate"
                                class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                            <input type="date" id="endDate" name="endDate"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                value="{{ $repair->endDate }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-x-6">
                        <div class="mb-5">
                            <label for="mechanicId"
                                class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Mechanic</label>
                            <select id="mechanicId" name="mechanicId"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                @foreach ($mechanics as $mechanic)
                                    <option value="{{ $mechanic->id }}"
                                        {{ $repair->mechanicId == $mechanic->id ? 'selected' : '' }}>
                                        {{ $mechanic->firstName }} {{ $mechanic->lastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label for="vehicleId"
                                class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Vehicle</label>
                            <select id="vehicleId" name="vehicleId"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        {{ $repair->vehicleId == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->make }} - {{ $vehicle->model }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-5 col-span-2">
                        <label for="description"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea name="description" id="description" cols="30" rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>{{ $repair->description }}</textarea>
                    </div>

                    <div class="mb-5 col-span-2">
                        <label for="clientNotes"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Client Notes</label>
                        <textarea name="clientNotes" id="clientNotes" cols="30" rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>{{ $repair->clientNotes }}</textarea>
                    </div>

                    <div class="mb-5 col-span-2">
                        <label for="mechanicNotes"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Mechanic Notes</label>
                        <textarea name="mechanicNotes" id="mechanicNotes" cols="30" rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>{{ $repair->mechanicNotes }}</textarea>
                    </div>
                </div>

                <div class="grid mt-10 mb-4">
                    <button type="submit"
                        class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primaryBlack text-white hover:bg-black">Update
                        Repair</button>
                </div>
            </form>
        </div>
    </div>
@endsection
