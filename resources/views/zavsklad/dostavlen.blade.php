<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
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
        <div>
            <div class="max-w-7xl ml-2 mx-auto sm:px-6>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="flex justify-center my-3.5">
                        <th class="p-1 pr-3"><a href="{{ route('dostavlen', ['data', 'asc'])}}">Дата поставки</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('dostavlen', ['crm_id', 'asc'])}}">CRM ID</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('dostavlen', ['sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('dostavlen', ['sapname', 'asc'])}}">Наименование</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('dostavlen', ['how', 'asc'])}}">шт</a></th>
                        <th class="p-1 pr-3"></th>   
                        <th class="p-1 pr-3"></th>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($data1 as $item)
                            @php
                                $count++;
                            @endphp
                            <tr>
                                <td class="p-1 pr-3">
                                    {{$item->updated_at}}
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
                                <th class="p-1 pr-1">
                                    <x-link.delete delete="{{ route('deleteOneWait', [$item->id, 'dostavlen']) }}" />
                                </th>
                                <th class="p-1 pr-1 text-xs">
                                    <input type="checkbox" name="selected[]" form="selectedopt" value="{{$item->id}}">
                                </th>
                            </tr>
                            
                        @endforeach
                    </table>
                    
                </div>
            </div>
            <div class="flex justify-center">
                <input type="button" onclick='selects()' value="выбрать все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400"><br>
                <input type="button" onclick='deSelect()' value="отменить все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400"><button form="selectedopt"  formaction="{{ route('selecteddelete', 'dostavlen')}}" type="submit" formmethod="get" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Удалить</button>
                <button title="Экспортировать в книгу экзель" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 "><a href="{{ route('allWaitExport')}}">Экспорт в Excel</a></button>
                
                <br>
            </div>
        </div>
        
        @endsection
        @section('countwait')
            {{ $data3 }}
        @endsection
        @section('countvputi')
            {{ $data4 }}
        @endsection
        @section('countdostavlen')
            {{ $count }}
        @endsection
        @section('countprodaja')
            {{ $data5 }}
        @endsection
        
        
    </x-slot>
</x-zavsklad.ojidaniye>