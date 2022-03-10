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
        <div>
            <div class="max-w-7xl ml-2 mx-auto sm:px-6>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="flex justify-center my-3.5">
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['data', 'asc'])}}">Дата ID</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['crm_id', 'asc'])}}">CRM ID</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['sapname', 'asc'])}}">Наименование</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['how', 'asc'])}}">шт</a></th>
                        <th class="p-1 pr-3"><a href="{{ route('allWait', ['order', 'asc'])}}">Заказ</a></th>
                        <th class="p-1 pr-3"></th>   
                        <th class="p-1 pr-3"></th>
                        <th class="p-1 pr-3"></th>
                        <th class="p-1 pr-3">Длит.</th>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($data1 as $item)
                            @php
                                $count++;
                            @endphp
                            <tr>
                                <td class="p-1 pr-3">
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
                                <td class="p-1 pr-3 text-xs">
                                    {{$item->order}}
                                </td>
                                <th class="p-1 pr-1">
                                    <x-link.delivered deld="{{ route('deliveredOneWait', [$item->id, 'allWait'])}}" />
                                </th>
                                <th class="p-1 pr-1">
                                    <x-link.delete delete="{{ route('deleteOneWait', [$item->id, 'allWait']) }}" />
                                </th>
                                <th class="p-1 pr-1 text-xs">
                                    <input type="checkbox" name="selected[]" form="selectedopt" value="{{$item->id}}">
                                </th>
                                <td class="p-1 pr-3 text-xs">
                                    @php
                                        $datetime1 = date_create(date($item->data));
                                        $datetime2 = date_create(date("Y-m-d"));
                                        $interval = date_diff($datetime1, $datetime2);
                                    @endphp
                                    {{$interval->format('%a дней')}}
                                </td>
                            </tr>
                            
                        @endforeach
                    </table>
                    
                </div>
            </div>
            <div class="flex justify-center">
                <input type="button" onclick='selects()' value="выбрать все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400"><br>
                <input type="button" onclick='deSelect()' value="отменить все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400">
                <button form="selectedopt" formaction="{{ route('selecteddelivered', 'allWait')}}" type="submit" formmethod="get" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Доставлен</button>
                <button form="selectedopt"  formaction="{{ route('selecteddelete', 'allWait')}}" type="submit" formmethod="get" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Удалить</button>
                <button title="Экспортировать в книгу экзель" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 "><a href="{{ route('allWaitExport')}}">Экспорт в Excel</a></button>
                
                <br>
            </div>
        </div>
        
        @endsection
        @section('countwait')
            {{ $count }}
        @endsection
        @section('countvputi')
            {{ $data3 }}
        @endsection
        @section('countdostavlen')
            {{ $data4 }}
        @endsection
        @section('countprodaja')
            {{ $data5 }}
        @endsection
        
    </x-slot>
</x-zavsklad.ojidaniye>