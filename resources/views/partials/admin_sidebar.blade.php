<aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href={{route('clients.index')}}
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa-solid fa-user-group fa-lg" style="color: #2e2e2e;"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Clients</span>
                    </a>
                </li>
                <li>
                    <a href={{route('vehicles.index')}}
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa-solid fa-car fa-lg" style="color: #2e2e2e;"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Vehicles</span>
                    </a>
                </li>
                <li>
                    <a href={{route('mechanics.index')}}
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa-solid fa-user-gear fa-lg" style="color: #2e2e2e;"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Mechanics</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example" onclick="toggleDropdown()">
                        <i class="fa-solid fa-screwdriver-wrench fa-lg" style="color: #2e2e2e;"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Maintenance</span>
                            <i class="fa-solid fa-chevron-down" style="color: #2e2e2e;"></i>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2">
                        <li>
                            <a href={{route('spareparts.index')}}
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Spare parts</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <i class="fa-solid fa-right-from-bracket fa-lg" style="color: #2e2e2e;"></i>
                            <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                        </button>
                    </form>
                    
                </li>
            </ul>
        </div>
    </aside>