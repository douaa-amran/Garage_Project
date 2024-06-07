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
    <div class="flex flex-col justify-center items-center max-w-screen-md px-4 sm:px-6 md:max-w-screen-xl">
        @if (auth()->user()->role == "Admin")
        <div class="w-full flex justify-start">
            <a href={{ route('clients.index') }}><i class="fa-solid fa-arrow-left" style="color: #2e2e2e;"></i></a>
        </div>

        <div class="container mx-auto my-8 p-7 border rounded-xl shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-9 gap-y-4">
                <div class="flex items-center">
                    <i class="fa-solid fa-user mr-6" style="color: #828a98"></i>
                    <p>{{ $client->firstName }} {{ $client->lastName }}</p>
                </div>
                <div class="flex items-center">
                    <i class="fa-solid fa-envelope mr-6" style="color: #828a98"></i>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="flex items-center">
                    <i class="fa-solid fa-address-card mr-6" style="color: #828a98"></i>
                    <p>{{ $client->cin }}</p>
                </div>
                <div class="flex items-center">
                    <i class="fa-solid fa-phone mr-6" style="color: #828a98"></i>
                    <p>{{ $client->phoneNumber }}</p>
                </div>
                <div class="flex items-center">
                    <i class="fa-solid fa-location-dot mr-6" style="color: #828a98"></i>
                    <p>{{ $client->address }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="p-4 self-end">
            <a href={{ route('repairs.create', $client->id) }}><button type="button" data-modal-target="default-modal"
                    data-modal-toggle="default-modal"
                    class="py-3 px-4 inline-flex self-end items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-primaryBlack text-white hover:bg-black">
                    Add Repair</button></a>
        </div>

        <div class="p-4 border-t-2 border-gray-200 dark:border-gray-700">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    Start Date</th>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    End Date</th>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    Description
                                </th>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    Client Notes</th>
                                <th scope="col"
                                    class="px-8 py-6 text-center text-xs font-medium text-gray-500 uppercase">
                                    Actions</th>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($repairs as $repair)
                                <tr>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $repair->startDate }}</td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $repair->endDate }}</td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $repair->description }}</td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $repair->clientNotes }}</td>
                                    <td class="flex justify-center px-8 py-6 whitespace-nowrap gap-5">
                                        <a href="{{ route('repairs.invoices', $repair->id) }}"><button type="button"><i
                                                    class="fa-solid fa-circle-info fa-lg"
                                                    style="color : #6b7280"></i></button></a>
                                        <a href="{{ route('repairs.edit', $repair->id) }}"><button type="button"><i
                                                    class="fa-solid fa-pen-to-square fa-lg"
                                                    style="color: #27a305;"></i></button></a>
                                        <form action="{{ route('repairs.destroy', $repair->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i class="fa-solid fa-trash fa-lg"
                                                    style="color: #d01616;"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
