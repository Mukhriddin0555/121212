<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
          <div class="flex space-x-2 justify-center p-4">
            <h2 class="text-4xl font-medium leading-tight text-gray-800">
                
                История
                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">Трансфер</span></h2>
          </div>
          <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="flex justify-center">
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['updated_at'])}}">Обновлен</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['sparepart_id'])}}">Сап код</a></th>
                        <th class="p-2 pr-3">Наименование</th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['how'])}}">шт</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['to_user_id'])}}">Сервис</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['answer_id'])}}">Статус</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('myTransfers', ['text'])}}">Примечание</a></th>        
                        <th class="p-1 pr-1">
                            <th class="p-2 pr-3"></th>
                        </th>
                        @foreach ($data1 as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->updated_at}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->sparepart->sap_kod}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->sparepart->name}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->how}}
                                </td>
                                <td class="p-2 pr-3">
                                    {{$item->toTransfer->name}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->allanswaer->name}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->text}}
                                </td>
                                @if ($item->answer_id == 8)
                                <td class="p-1 pr-1">
                                    <x-link.delivered deld="{{ route('oneMyTransfer', [$item->id])}}" />
                                </td>
                                @endif
                                @if ($item->answer_id != 7 && $item->answer_id != 2 && $item->answer_id != 8)
                                <td class="p-1 pr-1">
                                    <x-link.delete delete="{{ route('oneMyTransferDelete', [$item->id])}}" />
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endsection
        @include('layoutszavsklad.mainbar')
        @section('transfertrue')
        true
        @endsection
    </x-slot>
</x-zavsklad.ojidaniye>