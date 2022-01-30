<x-resseption.appresseption>
    <x-slot name="header">
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Хатолик</strong>
        <span class="block sm:inline">{{ $error }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        </span>
      </div>
      @endforeach
      @endif
        <form class="w-full max-w-lg" action="{{ route('newRessepshnOrders')}}" method="post">
            @csrf
            <div><h6>Добавить новый заказ</h6></div>
            <br>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  CRM ID
                </label>
                <input name="crm_id" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Сап код
                </label>
                <input name="sap_kod" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    кол-во
                </label>
                <input name="how" value="1" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
            </div>
            <button type="submit" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Сохранить</button>
          </form>
          <div class="py-2">
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-2 pr-7">№</th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['crm_id', 'asc'])}}">CRM ID</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['sapname', 'asc'])}}">Наименование</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['how', 'asc'])}}">кол</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['statusname', 'asc'])}}">Статус</a></th>        
                        @foreach ($data as $item)
                            <tr>
                                <td class="p-2 pr-7">
                                    {{$loop->index+1}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->crm_id}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->sap_kod}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->sapname}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->how}} шт
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->statusname}}
                                </td>
                            </tr>
                        @endforeach
                        
                        
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
    
    
</x-resseption.appresseption>