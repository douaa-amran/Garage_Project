@extends('auth')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="flex w-2/5 bg-white rounded-lg shadow-lg mx-auto my-4 align-middle justify-center px-8 py-14">
            <div class="flex-1 flex flex-col">
                <h1 class="text-5xl text-center font-bold leading-tight tracking-tight text-gray-900 mb-10">
                    Sign In
                </h1>
                <form  method="POST" class="w-full flex-1" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@flowbite.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <div class="flex justify-between mt-3 mb-5">
                        <div class="flex items-center text-xs gap-1">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                            Remember me
                        </div>
                        <a href="/forgot-password" class="text-xs">
                            Forgot password ?
                        </a>
                    </div>
                    <button type="submit"
                        class="py-3 px-9 gap-x-2 self text-sm font-semibold rounded-lg border border-transparent bg-primaryBlack text-white hover:bg-black">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
