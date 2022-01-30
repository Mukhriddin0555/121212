<x-zavsklad.ojidaniye>
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
        <form class="w-full max-w-lg" action="{{ route('newtransfer')}}" method="post">
            @csrf
            <div><h6>Добавить заказ на трансфер</h6></div>
            <br>
            <div class="flex flex-wrap -mx-3 mb-6">
              
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
                <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Выбрать филиал
                </label>
                <select name="tosklad" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    @foreach ($data3 as $branch)
                        <option value="{{ $branch->id}}">{{ $branch->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Примечание
                    </label>
                    <input name="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                  </div>              
            </div>
            <button type="submit" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Сохранить</button>
          </form>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-2 pr-3">№</th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['updated_at', 'asc'])}}">Обновлен</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['sapname', 'asc'])}}">Наименование</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['how', 'asc'])}}">шт</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['toskladname', 'asc'])}}">Сервис</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['answer_id', 'asc'])}}">Ответ из филиала</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['text', 'asc'])}}">Примечание</a></th>        
                        <th class="p-2 pr-3"></th>
                        @foreach ($data1 as $item)
                            <tr>
                                <td class="p-2 pr-3">
                                    {{$loop->index+1}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->updated_at}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->sap_kod}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->sapname}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->how}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->toskladname}}
                                </td>
                                @if ($item->toresponse == 'Отправлен')
                                <td class="p-2 pr-3">
                                    <form action="{{ route('oneMyTransfer', $item->id)}}" method="GET">
                                        <select name="answer" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option value="{{ $item->answer_id}}" selected="selected">{{ $item->toresponse}}</option>
                                            @foreach ($data2 as $status)
                                                <option value="{{ $status->id}}">{{ $status->name}}</option>
                                            @endforeach
                                          </select>                    
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->text}}
                                </td>
                                <td class="p-2 pr-3">
                                    <button type="submit"><img src="{{asset('storage/save_icon2.png')}}"  alt="Сохранить" class="w-4 h-4"></button>
                                </td>
                            </form>
                                @else
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->toresponse}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->text}}
                                </td>
                                @endif 
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
</x-zavsklad.ojidaniye>