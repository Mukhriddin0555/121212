<nav>
    <div class="flex flex-row min-h-screen bg-gray-100 text-gray-800">
        <aside
          class="sidebar w-64 md:shadow transform -translate-x-full md:translate-x-0 transition-transform duration-150 ease-in bg-indigo-500"
        >           
          <div class="sidebar-header flex items-center justify-center py-4">
            <div class="inline-flex">
                <button>
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </button>
                    
            </div>
          </div>
          <div class="sidebar-content px-4 py-6">
            <ul class="flex flex-col w-full">
              <li class="my-px">
                <a
                  href="{{ route('admin') }}"
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-700 bg-gray-100"
                >
                  <span class="flex items-center justify-center text-lg text-gray-400">
                    <svg
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="h-6 w-6"
                    >
                      <path
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                      />
                    </svg>
                  </span>
                  <span class="ml-3">Главная страница</span>
                </a>
              </li>
              <li class="my-px">
                <span class="flex font-medium text-sm text-gray-300 px-4 my-4 uppercase">Отчеты</span>
              </li>
              <li class="my-px">
                <a
                  href="{{route('ressepshnOrders', ['1', 'crm_id', 'asc'])}}"
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                  <span class="flex items-center justify-center text-lg text-gray-400">
                    <svg
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="h-6 w-6"
                    >
                      <path
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"
                      />
                    </svg>
                  </span>
                  <span class="ml-3">Ожидание</span>
                  <span
                    class="flex items-center justify-center text-xs text-red-500 font-semibold bg-red-100 h-6 px-2 rounded-full ml-auto"
                  >@yield('countojidaniya')</span>
                </a>
              </li>
              <li class="my-px">
                <a
                  href="{{route('ressepshnOrders', ['2', 'crm_id', 'asc'])}}"
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                  <span class="flex items-center justify-center text-lg text-gray-400">
                    <svg
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="h-6 w-6"
                    >
                      <path
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                      />
                    </svg>
                  </span>
                  <span class="ml-3">Доставлен</span>
                  <span
                    class="flex items-center justify-center text-xs text-red-500 font-semibold bg-red-100 h-6 px-2 rounded-full ml-auto"
                  >@yield('countdostavlen')</span>
                  
                </a>
              </li>
              <li class="my-px">
                <span class="flex font-medium text-sm text-gray-300 px-4 my-4 uppercase">Дургие</span>
              </li>
              <li class="my-px">
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a
                  href="#"
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                  <span class="flex items-center justify-center text-lg text-red-400">
                    <svg
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="h-6 w-6"
                    >
                      <path
                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"
                      />
                    </svg>
                  </span>
                  <button type="submit"><span class="ml-3">Logout</span></button>
                </a>
                </form>
              </li>
            </ul>
          </div>
        </aside>
        <main class="main flex flex-col flex-grow -ml-64 md:ml-0 transition-all duration-150 ease-in">
          <header class="header bg-white shadow py-4 px-4">
            <div class="header-content flex items-center flex-row">
              <form action="{{ route('searchid')}}" method="get">
                <div class="hidden md:flex relative">
                  <div
                    class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400"
                  >
                    <svg
                      class="h-6 w-6"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                  </div>
                  <input
                    id="search"
                    type="text"
                    name="search"
                    class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-300 w-full h-10 focus:outline-none focus:border-indigo-400"
                    placeholder="Search..."
                  />
                  
                </div>
                <div class="flex md:hidden">
                  <a href="#" class="flex items-center justify-center h-10 w-10 border-transparent">
                    <svg
                      class="h-6 w-6 text-gray-500"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                  </a>
                </div>
              </form>
              <div class="flex ml-auto">
                <a href="#" class="flex flex-row items-center">
    
                  <span class="flex flex-col ml-2 hidden lg:flex  ">
                    <span class="truncate w-30 font-semibold tracking-wide leading-none">{{ Auth::findrole() }}</span>
                    <span class="truncate w-30 text-gray-500 text-xs leading-none mt-1">{{ Auth::user()->surname }} {{ Auth::user()->lastname }}</span>
                  </span>
                </a>
              </div>
            </div>
          </header>
          <div class="main-content flex flex-col flex-grow p-4">
            <h1 class="font-bold text-2xl text-gray-700">@yield('position')</h1>
    
            <div
              class="flex flex-col flex-grow border-4 border-gray-400 border-dashed bg-white rounded mt-4">
              @yield('session-start')
            </div>
          </div>
        </main>
      </div>
</nav>
