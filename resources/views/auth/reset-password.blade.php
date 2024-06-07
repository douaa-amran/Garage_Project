@extends('auth')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="flex w-2/5 bg-white rounded-lg shadow-lg mx-auto my-4 align-middle justify-center px-8 py-14">
            <div class="flex-1 flex flex-col">
                <h1 class="text-5xl text-center font-bold leading-tight tracking-tight text-gray-900 mb-10">
                    Reset Password
                </h1>
                <form  method="POST" class="w-full flex-1" action="/reset-password">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                        <label for="password_confirmation" class="block mb-2 ml-1 text-sm font-medium text-gray-900 dark:text-white">
                            Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "
                            placeholder="●●●●●●●●●●" required />
                    </div>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <button type="submit"
                        class="py-3 px-9 gap-x-2 self text-sm font-semibold rounded-lg border border-transparent bg-primaryBlack text-white hover:bg-black">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
