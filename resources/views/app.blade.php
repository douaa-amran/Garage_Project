<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Set maximum width for the content of the first column */
        td {
            max-width: 190px;
            /* Adjust the value as per your requirement */
            overflow: auto;
            scrollbar-width: none
                /* Prevent wrapping */
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <button id="sidebar-toggle" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
        aria-controls="logo-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Flowbite</span>
                    </a>
                </div>

                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <form class="max-w-sm mx-auto mr-3">
                            <select id="language-form"
                                class="py-3 px-4 inline-flex self-end items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-primaryBlack text-white hover:bg-black"
                                onchange="changeLanguage(this)">
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English
                                </option>
                                <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>French
                                </option>
                                <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Spanish
                                </option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar section -->
    @yield('sidebar')

    <!-- Main content -->
    <div class="p-4 sm:ml-64 mt-16">
        @yield('content')
    </div>

    <script src="./node_modules/preline/dist/preline.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function(event) {
            event.stopPropagation(); // Prevents the click event from reaching the document body
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });

        // Add event listener to close sidebar when clicking outside of it
        document.body.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');
            if (!sidebar.contains(event.target) && event.target !== toggleButton) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown-example');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>

</html>
