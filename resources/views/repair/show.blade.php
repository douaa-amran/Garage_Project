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
        <div class="w-full flex justify-start">
            <a href="{{ route('clients.show', $repair->clientId) }}"><i class="fa-solid fa-arrow-left"
                    style="color: #2e2e2e;"></i></a>
        </div>
        @if (auth()->user()->role == 'Admin')
            <div class="container mx-auto my-8 p-7 border rounded-xl shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-9 gap-y-4">
                    <div class="flex items-center">
                        @if ($repair->status == 'Complete')
                            <i class="fa-solid fa-circle-check mr-6" style="color: #828a98"></i>
                        @endif
                        @if ($repair->status == 'In Progress')
                            <i class="fa-solid fa-bars-progress mr-6" style="color: #828a98"></i>
                        @endif
                        @if ($repair->status == 'Pending')
                            <i class="fa-solid fa-spinner mr-6" style="color: #828a98"></i>
                        @endif
                        <p>{{ $repair->status }}</p>
                    </div>
                    <div>
                        <div class="flex">
                            <i class="fa-solid fa-circle-info mr-6 mt-1" style="color: #828a98"></i>
                            <p class="font-bold mr-3" style="color: #828a98">Description: </p><br>
                        </div>
                        <p class="ml-10">{{ $repair->description }}</p>
                    </div>

                    <div>
                        <div class="flex">
                            <i class="fa-solid fa-user mr-6 mt-1" style="color: #828a98"></i>
                            <p class="font-bold mr-3" style="color: #828a98">Client Notes: </p><br>
                        </div>
                        <p class="ml-10">{{ $repair->clientNotes }}</p>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-hourglass-start mr-4" style="color: #828a98"></i>
                        <p class="font-bold mr-3" style="color: #828a98">Start Date: </p>
                        <p>{{ $repair->startDate }}</p>
                    </div>
                    <div>
                        <div class="flex">
                            <i class="fa-solid fa-toolbox mr-6 mt-1" style="color: #828a98"></i>
                            <p class="font-bold mr-3" style="color: #828a98">Mechanic Notes: </p><br>
                        </div>
                        <p class="ml-10">{{ $repair->mechanicNotes }}</p>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-hourglass-end mr-4" style="color: #828a98"></i>
                        <p class="font-bold mr-3" style="color: #828a98">End Date: </p>
                        <p>{{ $repair->endDate }}</p>
                    </div>
                </div>
            </div>

            <div class="p-4 mr-12 self-end">
                <a href={{ route('generate-pdf', $repair->id) }}><button type="button" data-modal-target="default-modal"
                        data-modal-toggle="default-modal"
                        class="py-3 px-4 inline-flex self-end items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-primaryBlack text-white hover:bg-black">
                        <i class="fa-solid fa-file-pdf fa-lg"></i>Export Invoice</button></a>
                <a href={{ route('invoices.create', $repair->id) }}><button type="button" data-modal-target="default-modal"
                        data-modal-toggle="default-modal"
                        class="py-3 px-4 inline-flex self-end items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-primaryBlack text-white hover:bg-black">
                        Add</button></a>
            </div>
        @endif

        <div class="p-4 border-t-2 border-gray-200 dark:border-gray-700">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    Spare Part</th>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    Quantity</th>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    Charges
                                </th>
                                <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                    Total</th>
                                <th scope="col"
                                    class="px-8 py-6 text-center text-xs font-medium text-gray-500 uppercase">
                                    Actions</th>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $spareparts[$invoice->sparepartId]->name ?? 'Unknown' }}</td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $invoice->quantity }}</td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $invoice->additionalCharges }}</td>
                                    <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $invoice->total }}</td>
                                    <td class="flex justify-center px-8 py-6 whitespace-nowrap gap-5">
                                        <a
                                            href="{{ route('invoices.edit', ['repair' => $repair->id, 'invoice' => $invoice->id]) }}"><button
                                                type="button"><i class="fa-solid fa-pen-to-square fa-lg"
                                                    style="color: #27a305;"></i></button></a>
                                        <form action="{{ route('invoices.destroy', ['invoice' => $invoice->id]) }}"
                                            method="POST" style="display: inline;">
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
