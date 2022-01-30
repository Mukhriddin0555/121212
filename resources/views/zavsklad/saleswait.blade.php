<x-zavsklad.ojidaniye>
    <x-slot name="header">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-2 pr-3">№</th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', ['crm_id', 'asc'])}}">CRM ID</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', ['sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', ['sapname', 'asc'])}}">Наименование</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', ['how', 'asc'])}}">шт</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', ['order', 'asc'])}}">Заказ</a></th>
                        <th class="p-2 pr-3"></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', ['statusname', 'asc'])}}">Текущий статус</a></th>
                        <th class="p-2 pr-3"></th>   
                        <th class="p-2 pr-3"></th> 
                        @foreach ($data as $item)
                            <tr>
                                <td class="p-2 pr-3">
                                    {{$loop->index+1}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->crm_id}}
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
                                
                                    @if ($item->order == 'Еще не заказано')
                                    
                                    <form action="{{ route('oneWaitOrder', $item->id )}}" method="GET">
                                        <td class="p-2 pr-3">
                                        <input name="order" type="text" placeholder="{{$item->order}}">
                                        </td>
                                        <td class="p-2 pr-3">
                                            <button type="submit"><img src="{{asset('storage/save_icon2.png')}}"  alt="Сохранить" class="w-4 h-4"></button>
                                        </td>
                                    </form>
                                    @else                                    
                                    <td class="p-2 pr-3">
                                        {{$item->order}}
                                    </td>
                                    <td class="p-2 pr-3">
                                    </td>
                                    @endif
                                
                                <td class="p-2 pr-3">
                                    {{$item->statusname}}
                                </td>
                                <th class="p-2 pr-3">
                                    <a href="{{ route('deliveredOneWaitOrder', $item->id)}}" title="Доставлено"><img src="{{asset('storage/dostavlen.png')}}"  alt="Доставлен" class="w-4 h-4"></a>
                                </th>
                                <th class="p-2 pr-3">
                                    <a href="{{ route('deleteOneWaitOrder', $item->id)}}" title="Удалить"><img src="{{asset('storage/delete_icon.png')}}"  alt="Удалить" class="w-4 h-4"></a>
                                </th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
</x-zavsklad.ojidaniye>