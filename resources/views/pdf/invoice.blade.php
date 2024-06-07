<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title>Invoice</title>
</head>

<body>
    <div class="rounded-lg shadow-lg px-8 py-10 my-4 max-w-xl mx-auto">
        <div class="text-gray-700 mb-8">
            <div class="font-bold text-xl mb-2">INVOICE</div>
            <div class="text-sm">Date : {{ now()->format('d/m/Y') }}</div>
            <div class="text-sm">Invoice Id : {{ $repair->id }}</div> <!-- Changed from $data['id'] to $repair->id -->
        </div>
        <div class="border-b-2 border-gray-300 pb-8 mb-8">
            <h2 class="text-2xl font-bold mb-4">Bill To:</h2>
            <div class="text-gray-700 mb-2">{{ $client->firstName }} {{ $client->lastName }}</div> <!-- Changed from $data['full_name'] to $client->full_name -->
            <div class="text-gray-700 mb-2">{{ $client->address }}</div> <!-- Changed from $data['address'] to $client->address -->
            <div class="text-gray-700">{{ $client->email }}</div> <!-- Changed from $data['email'] to $client->email -->
        </div>
        <table class="w-full mb-8">
            <thead>
                <tr>
                    <th class="text-gray-700 text-left font-bold py-2">Spare Part</th>
                    <th class="text-gray-700 text-left font-bold py-2">Quantity</th>
                    <th class="text-gray-700 text-left font-bold py-2">Charges</th>
                    <th class="text-gray-700 text-left font-bold py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td class="py-2 text-gray-700">{{ $invoice->sparepart->name ?? 'Unknown' }}</td> <!-- Accessing relationship and changed from $spareparts[$invoice->sparepartId]->name to $invoice->sparepart->name -->
                        <td class="py-2 text-gray-700">{{ $invoice->quantity }}</td>
                        <td class="py-2 text-gray-700">{{ $invoice->additionalCharges }} DH</td>
                        <td class="py-2 text-gray-700">{{ $invoice->total }} DH</td> <!-- Changed from $repair->total to $invoice->total -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total:</div>
            <div class="text-gray-700 font-bold text-xl">{{ $total }} DH</div> <!-- Changed from $data['total'] to $total -->
        </div>
    </div>
</body>

</html>
