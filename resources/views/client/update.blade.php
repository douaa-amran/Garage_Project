@extends('admin.dashboard')

@section('content')
<div class="flex flex-col justify-center items-center max-w-screen-md px-4 sm:px-6 md:max-w-screen-xl">
    <div class="w-full flex justify-start">
        <a href={{ route('clients.index') }}><i class="fa-solid fa-arrow-left" style="color: #2e2e2e;"></i></a>
    </div>

    <div class="w-full p-7">
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                <div class="mb-5">
                    <label for="email"
                        class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $userEmail }}"
                        placeholder="name@flowbite.com" required />
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">
                        Password</label>
                    <input type="password" id="password" name="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                        placeholder="●●●●●●●●●●" required />
                </div>

                <div class="mb-5">
                    <label for="firtName"
                        class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">First
                        Name</label>
                    <input type="text" id="firstName" name="firstName"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $client->firstName }}"
                        required />
                </div>

                <div class="mb-5">
                    <label for="lastName" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Last
                        Name</label>
                    <input type="text" id="lastName" name="lastName"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $client->lastName }}"
                        required />
                </div>

                <div class="mb-5">
                    <label for="cin"
                        class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">CIN</label>
                    <input type="text" id="cin" name="cin" pattern="[A-Z][0-9]{6}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $client->cin }}" placeholder="L000000" required />
                </div>

                <div class="mb-5">
                    <label for="address"
                        class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                    <input type="text" id="address" name="address"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $client->address }}" required />
                </div>

                <div class="mb-5">
                    <label for="phoneNumber"
                        class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">Phone
                        Number</label>
                    <input type="text" id="phoneNumber" name="phoneNumber"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{ $client->phoneNumber }}" placeholder="123-456-7890"
                        required />
                </div>
            </div>

            <div class="grid mt-10 mb-4">
                <button type="submit"
                    class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primaryBlack text-white hover:bg-blac">Update Client</button>
            </div>
        </form>

    </div>
</div>
@endsection
