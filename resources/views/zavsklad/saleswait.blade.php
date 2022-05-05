<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        <div class="flex space-x-2 justify-center p-4">
            <h2 class="text-4xl font-medium leading-tight text-gray-800">
            {{$status}} тип заявки:  
                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap 
                align-baseline font-bold bg-blue-600 text-white rounded">Продажа</span></h2>
          </div>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="flex justify-center">
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', [$status2, 'crm_id'])}}">CRM ID</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', [$status2, 'sapkod'])}}">Сап код</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', [$status2, 'sapname'])}}">Наименование</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', [$status2, 'how'])}}">шт</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('allWaitOrder', [$status2, 'order'])}}">Заказ</a></th>
                        <th class="p-2 pr-3"></th>
                        <th class="p-2 pr-3"></th>   
                        <th class="p-2 pr-3"></th> 
                        @foreach ($data as $item)
                            <tr>
                                <td class="p-2 pr-3">
                                    {{$item->crm_id}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->sapkod}}
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
                                        <input class="w-32" name="order" type="text" placeholder="{{$item->order}}">
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
        @endsection
        @include('layoutszavsklad.mainbar')
        @section('salestrue')
        true
        @endsection
    </x-slot>
</x-zavsklad.ojidaniye>