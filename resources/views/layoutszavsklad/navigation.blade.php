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
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                <img src="{{asset('storage/homepage_icon.png')}}"  alt="vputi" class="w-6 h-6 mr-3">
                  <span class="ml-3">Главная страница</span>
                </a>
              </li>
              <li class="my-px">
                <div x-data="{ open: @hasSection('waittrue')
                @yield('mailtrue')
                @else
                false
                @endif }">
                  <button @click="open = ! open" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 
                  hover:bg-gray-100 hover:text-gray-700 w-full"><img src="{{asset('storage/wait_icon.png')}}"  alt="wait" class="w-6 h-6 mr-3">Заявки</button>
               
                  <div x-show="open" class="border rounded border-cyan-400 p-2">
                      <ul>
                        <li class="my-px">
                          <a
                            href="{{route('allWait', ['crm_id'])}}"
                            class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                          >
                          <img src="{{asset('storage/waiting_icon.png')}}"  alt="wait" class="w-6 h-6 mr-3">
                            <span class="ml-3">Ожидание</span>
                            @yield('countwait')
                          </a>
                        </li>
                        <li class="my-px">
                          <a
                            href="{{route('vputi', ['crm_id'])}}"
                            class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                          >
                          <img src="{{asset('storage/vputi_icon.png')}}"  alt="vputi" class="w-6 h-6 mr-3">
                            <span class="ml-3">В пути</span>
                            @yield('countvputi')
                          </a>
                        </li>
                        <li class="my-px">
                          <a
                            href="{{route('dostavlen', ['crm_id'])}}"
                            class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 
                            hover:text-gray-700"
                          >
                          <img src="{{asset('storage/delivery_icon.png')}}"  alt="wait" class="w-6 h-6 mr-3">
                            <span class="ml-3">Доставлен</span>
                            @yield('countdostavlen')
                            
                          </a>
                        </li>
                      </ul>
                  </div>
              </div>
              </li>
              <li class="my-px">
                <div x-data="{ open: @hasSection('salestrue')
                @yield('mailtrue')
                @else
                false
                @endif }">
                  <button @click="open = ! open" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 
                  hover:bg-gray-100 hover:text-gray-700 w-full"><img src="{{asset('storage/wait_icon.png')}}"  alt="wait" class="w-6 h-6 mr-3">Продажа</button>
               
                  <div x-show="open" class="border rounded border-cyan-400 p-2">
                      <ul>
                        <li>
                          <a
                          href="{{route('allWaitOrder', [1,'crm_id'])}}"
                          class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                        >
                        <img src="{{asset('storage/waiting_icon.png')}}"  alt="wait" class="w-6 h-6">
                          <span class="ml-3">Ожидании</span>
                          @yield('countprodaja')
                        </a>
                        </li>
                        <li>
                          <a
                          href="{{route('allWaitOrder', [2,'crm_id'])}}"
                          class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                        >
                        <img src="{{asset('storage/delivery_icon.png')}}"  alt="del" class="w-6 h-6">
                          <span class="ml-3">Доставлен</span>
                          @yield('countprodajadostavlen')
                        </a>
                        </li>
                      </ul>
                  </div>
                </div>
                
              </li>
              
              <li class="my-px">
                <div x-data="{ open: @hasSection('transfertrue')
                @yield('mailtrue')
                @else
                false
                @endif }">
                  <button @click="open = ! open" class="flex flex-row items-center h-10 px-3 rounded-lg 
                  text-gray-300 hover:bg-gray-100 hover:text-gray-700 w-full">
                  <img src="{{asset('storage/transfer_icon.png')}}"  alt="tr" class="w-6 h-6 mr-3">Трансфер</button>
               
                  <div x-show="open" class="border rounded border-cyan-400 p-2">
                      <ul>
                        <li class="my-px">
                          <a
                            href="{{route('myTransfers', 'answer_id')}}"
                            class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                          >
                          <img src="{{asset('storage/incoming_icon.png')}}"  alt="in" class="w-6 h-6">
                            <span class="ml-3">Входящие</span>
                            @yield('countfromtransfer')
                          </a>
                        </li>
                        <li class="my-px">
                          <a
                            href="{{route('ourTransfers', ['answer_id'])}}"
                            class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                          >
                          <img src="{{asset('storage/outgoing_icon.png')}}"  alt="out" class="w-6 h-6">
                            <span class="ml-3">Изходящие</span>
                            @yield('counttotransfer')
                          </a>
                        </li>
                        <li class="my-px">
                          <a
                            href="{{route('historyTransfers', 'answer_id')}}"
                            class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                          >
                          <img src="{{asset('storage/history_icon.png')}}"  alt="hist" class="w-6 h-6">
                            <span class="ml-3">История</span>
                          </a>
                        </li>
                      </ul>
                  </div>
              </div>
              </li>
              
              <li class="my-px">
                <div x-data="{ open: @hasSection('mailtrue')
                @yield('mailtrue')
                @else
                false
                @endif }">
                  
                  <button @click="open = ! open" class="flex flex-row items-center h-10 px-3 
                  rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700 w-full">
                  <img src="{{asset('storage/mail_icon.png')}}"  alt="mail" class="w-6 h-6 mr-3">
                  Почта</button>
               
                  <div x-show="open" class="border rounded border-cyan-400 p-2">
                      <ul>
                        <li>
                          <a
                  href="{{route('FilialBranchMailNewMessage')}}"
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                  <img src="{{asset('storage/new_message_icon.png')}}"  alt="in" class="w-6 h-6">
                  <span class="ml-3">Новое сообшение</span>
                </a>
                        </li>
                        <li>
                          <a
                  href="{{route('FilialBranchMailAllIncoming')}}"
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                  <img src="{{asset('storage/incoming_icon.png')}}"  alt="in" class="w-6 h-6">
                  <span class="ml-3">Входящие</span>
                  @yield('countmessages')
                </a>
                        </li>
                        <li>
                          <a
                  href="{{route('FilialBranchMailAllOutgoing')}}"
                  class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700"
                >
                  <img src="{{asset('storage/outgoing_icon.png')}}"  alt="out" class="w-6 h-6">
                  <span class="ml-3">Изходящие</span>
                </a>
                        </li>
                      </ul>
                  </div>
              </div>
                
              </li>
              
              <li class="my-px">
                <form method="POST" action="{{ route('logout') }}" class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                @csrf
                <img src="{{asset('storage/exit_icon.png')}}"  alt="exit" class="w-6 h-6 mr-3"><button type="submit">Выйти</button>
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
                @yield('profile')
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
