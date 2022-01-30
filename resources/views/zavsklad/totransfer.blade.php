<x-zavsklad.ojidaniye>
    <x-slot name="header">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-2 pr-3">№</th>                        
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['updated_at', 'asc'])}}">Обновлен</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['sapname', 'asc'])}}">Наименование</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['how', 'asc'])}}">шт</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['toskladname', 'asc'])}}">Сервис</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['answer_id', 'asc'])}}">Ваш ответ</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['text', 'asc'])}}">Примечание</a></th>
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
                                    {{$item->fromskladname}}
                                </td>
                                @if ($item->answer_id == 2)
                                <td class="p-2 pr-3 text-xs">
                                    Доставлено в филиал
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->text}}
                                </td>
                                @else
                                <form action="{{ route('oneOurTransfer', $item->id)}}" method="GET">
                                    <td class="p-2 pr-3">                                    
                                        
                                            <select name="answer" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                                <option value="{{ $item->answer_id}}" selected="selected">{{ $item->toresponse}}</option>
                                                @foreach ($data2 as $status)
                                                    @if ($status->id == 2)
                                                        @continue
                                                    @endif
                                                    <option value="{{ $status->id}}">{{ $status->name}}</option>
                                                @endforeach
                                              </select>
                                    </td>
                                    <td class="p-2 pr-3 text-xs">
                                        <input name="info" type="text" value="{{$item->text}}">
                                    </td>
                                    <td class="p-2 pr-3">
                                        <button type="submit"><img src="{{asset('storage/save_icon2.png')}}"  alt="Сохранить" class="w-4 h-4"></button>
                                    </td>                                
                                </form>
                                @endif                                
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
</x-zavsklad.ojidaniye>