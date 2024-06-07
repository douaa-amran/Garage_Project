<aside id="sidebar"
        class="fixed top-0 left-0 z-30 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href={{route('mechanics.index')}}
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa-solid fa-user-gear fa-lg" style="color: #2e2e2e;"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Repairs</span>
                    </a>
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