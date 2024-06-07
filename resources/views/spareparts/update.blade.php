@extends('admin.dashboard')

@section('content')
    <div class="flex flex-col justify-center items-center max-w-screen-md px-4 sm:px-6 md:max-w-screen-xl">
        <div class="w-full flex justify-start">
            <a href="{{ route('spareparts.index') }}"><i class="fa-solid fa-arrow-left" style="color: #2e2e2e;"></i></a>
        </div>

        <div class="w-full p-7">
            <form action="{{ route('spareparts.update', $sparepart->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                    <div class="mb-5">
                        <label for="name"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" id="name" name="name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            placeholder="Spare part name" value="{{ $sparepart->name }}" required />
                    </div>

                    <div class="mb-5">
                        <label for="reference" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">
                            Reference</label>
                        <input type="text" id="reference" name="reference"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            placeholder="Spare part reference" value="{{ $sparepart->reference }}" required />
                    </div>

                    <div class="mb-5">
                        <label for="stock"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                        <input type="number" id="stock" name="stock"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $sparepart->stock }}"
                            required />
                    </div>

                    <div class="mb-5">
                        <label for="price"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" id="price" name="price" step="0.01"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $sparepart->price }}"
                            required />
                    </div>

                    <div class="mb-5">
                        <label for="supplier"
                            class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                        <select id="supplier" name="supplier"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                            @foreach ($suppliers as $supplier)
                                <option value={{$supplier->id}} @selected($sparepart->supplierId == $supplier->id)>{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid mt-10 mb-4">
                    <button type="submit"
                        class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primaryBlack text-white hover:bg-black">Update
                        Spare Part</button>
                </div>
            </form>

        </div>
    </div>
@endsection
