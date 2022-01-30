<x-zavsklad.ojidaniye>
    <x-slot name="header">
        <script type="text/javascript">  
            function selects(){  
                var ele=document.getElementsByName('selected[]');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=true;  
                }  
            }  
            function deSelect(){  
                var ele=document.getElementsByName('selected[]');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                      
                }  
            }             
        </script> 
        <form id="selectedopt" method="GET"></form>
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
        <form class="w-full max-w-lg" action="{{ route('addNewWait')}}" method="post">
            @csrf
            <div class="text-sm" >Добавить новый заказ</div>
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
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Номер заказа
                </label>
                <input name="order" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
            </div>
            <button type="submit" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Сохранить</button>
          </form>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-1 pr-3">№</th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['data', 'asc'])}}">Дата ID</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['crm_id', 'asc'])}}">CRM ID</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['sapname', 'asc'])}}">Наименование</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['how', 'asc'])}}">шт</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['order', 'asc'])}}">Заказ</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['statusname', 'asc'])}}">Текущий статус</a></th>
                        <th class="p-1 pr-3"></th>   
                        <th class="p-1 pr-3"></th>
                        <th class="p-1 pr-3"></th>
                        @foreach ($data1 as $item)
                            <tr>
                                <td class="p-1 pr-3">
                                    {{$loop->index+1}}
                                </td>
                                <td class="p-1 pr-3 text-xs">
                                    {{$item->data}}
                                </td>
                                <td class="p-1 pr-3">
                                    {{$item->crm_id}}
                                </td>
                                <td class="p-1 pr-3">
                                    {{$item->sap_kod}}
                                </td>
                                <td class="p-1 pr-3 text-xs">
                                    {{$item->sapname}}
                                </td>
                                <td class="p-1 pr-3">
                                    {{$item->how}}
                                </td>
                                <td class="p-1 pr-3">
                                    {{$item->order}}
                                </td>
                                <form action="{{ route('statusOneWait', $item->id)}}" method="GET">
                                <td class="p-1">
                                    
                                        <select name="newstatus" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option value="{{ $item->statusid}}" selected="selected">{{ $item->statusname}}</option>
                                            @foreach ($data2 as $status)
                                                <option value="{{ $status->id}}" class="text-xs">{{ $status->name}}</option>
                                            @endforeach
                                          </select>                                                                        
                                </td>
                                <th class="p-1 pr-10">
                                    <button type="submit"><img src="{{asset('storage/save_icon2.png')}}"  alt="Сохранить" class="w-4 h-4"></button>
                                </th></form>
                                <th class="p-1 pr-1">
                                    <x-link.delivered deld="{{ route('deliveredOneWait', $item->id)}}" />
                                </th>
                                <th class="p-1 pr-1">
                                    <x-link.delete delete="{{ route('deleteOneWait', $item->id) }}" />
                                </th>
                                <th class="p-1 pr-1">
                                    <x-link.more more="{{ route('oneWait', $item->id)}}" />
                                </th>
                                <th class="p-1 pr-1">
                                    <input type="checkbox" name="selected[]" form="selectedopt" value="{{$item->id}}">
                                </th>
                            </tr>
                            
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <input type="button" onclick='selects()' value="выбрать все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400"><br>
            <input type="button" onclick='deSelect()' value="отменить все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400">
            <button form="selectedopt" formaction="{{ route('selecteddelivered')}}" type="submit" formmethod="get" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Доставлен</button>
            <button form="selectedopt"  formaction="{{ route('selecteddelete')}}" type="submit" formmethod="get" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Удалить</button>
            <br>
        </div>
        
    </x-slot>
</x-zavsklad.ojidaniye>