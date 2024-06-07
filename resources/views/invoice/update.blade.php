@extends('admin.dashboard')

@section('content')
    <div class="flex flex-col justify-center items-center max-w-screen-md px-4 sm:px-6 md:max-w-screen-xl">
        <div class="w-full flex justify-start">
            <a href="{{ route('repairs.invoices', $repairId) }}"><i class="fa-solid fa-arrow-left" style="color: #2e2e2e;"></i></a>
        </div>

        <div class="w-full p-7">
            <form action="{{ route('invoices.update', ['repair' => $repairId, 'invoice' => $invoice->id]) }}" method="POST">
                @csrf
                @method('PUT') 

                <div class="flex flex-col justify-center">
                    <div class="mb-5">
                        <label for="sparepart" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Spare Parts</label>
                        <select id="sparepart" name="sparepartId" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            @foreach ($spareparts as $sparepart)
                                <option value="{{$sparepart->id}}" @if($sparepart->id == $invoice->sparepartId) selected @endif>{{$sparepart->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-x-6">
                        <div class="mb-5">
                            <label for="quantity" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="{{ $invoice->quantity }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                        </div>

                        <div class="mb-5">
                            <label for="additionalCharges" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Additional Charges</label>
                            <input type="number" step="0.01" id="additionalCharges" name="additionalCharges" value="{{ $invoice->additionalCharges }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>
                </div>

                <div class="grid mt-10 mb-4">
                    <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primaryBlack text-white hover:bg-black">Update Invoice</button>
                </div>
            </form>
        </div>
    </div>
@endsection
