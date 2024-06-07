@extends('admin.dashboard')

@section('content')
    <div class="p-4 flex justify-end">
        <div class="flex gap-2">
            <div class="flex items-center md:w-80 sm:w-64">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fa-solid fa-wrench" style="color: #6b7280;"></i>
                    </div>
                    <input type="text" id="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full ps-10 p-2.5"
                        placeholder="Search spare part..." required />
                    <button type="button" class="absolute inset-y-0 end-0 flex items-center pe-3">
                        <i class="fa-solid fa-magnifying-glass" style="color: #6b7280;"></i>
                    </button>
                </div>
            </div>
            <div>
                <a href={{ route('spareparts.create') }}><button type="button" data-modal-target="default-modal"
                        data-modal-toggle="default-modal"
                        class="py-3 px-4 inline-flex self-end items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-primaryBlack text-white hover:bg-black">
                        Add Spare Part</button></a>
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
                                Reference</th>
                            <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                Name</th>
                            <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                Price
                            </th>
                            <th scope="col" class="px-8 py-6 text-start text-xs font-medium text-gray-500 uppercase">
                                Stock</th>
                            <th scope="col" class="px-8 py-6 text-center text-xs font-medium text-gray-500 uppercase">
                                Actions</th>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($spareparts as $sparepart)
                            <tr>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $sparepart->reference }}</td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $sparepart->name }}</td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $sparepart->price }}</td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $sparepart->stock }}</td>
                                <td class="flex justify-center px-8 py-6 whitespace-nowrap gap-5">
                                    <a href="{{ route('spareparts.edit', $sparepart->id) }}"><button type="button"><i
                                                class="fa-solid fa-pen-to-square fa-lg"
                                                style="color: #27a305;"></i></button></a>
                                    <form action="{{ route('spareparts.destroy', $sparepart->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash fa-lg"
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
@endsection
