<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        <div class="flex space-x-2 justify-center p-4">
            <h2 class="text-4xl font-medium leading-tight text-gray-800">
                
                Запросы на  
                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">Трансфер</span>
            с регионов</h2>
          </div>
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="flex justify-center">
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['updated_at'])}}">Обновлен</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['sparepart_id'])}}">Сап код</a></th>
                        <th class="p-2 pr-3">Наименование</th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['how'])}}">шт</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['from_user_id'])}}">Сервис</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['answer_id'])}}">Статус</a></th>
                        <th class="p-2 pr-3"><a href="{{ route('ourTransfers', ['text'])}}">Примечание</a></th>
                        <th class="p-2 pr-3"></th>
                        @foreach ($data1 as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->updated_at}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    @if ($item->answer_id == 8 || $item->answer_id == 7)
                                        <a href="{{route('toexceltransfer', [$item->id])}}" class="text-blue-500">{{$item->sparepart->sap_kod}}</a>
                                    @else
                                    {{$item->sparepart->sap_kod}}
                                    @endif
                                    
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->sparepart->name}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->how}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->fromtransfer->name}}
                                </td>
                                @if ($item->answer_id == 2 || $item->answer_id == 8)
                                <td class="p-2 pr-3 text-xs">
                                    {{ $item->allanswaer->name}}
                                </td>
                                <td class="p-2 pr-3 text-xs">
                                    {{$item->text}}
                                </td>
                                @else
                                <form action="{{ route('oneOurTransfer', $item->id)}}" method="POST">
                                    @csrf
                                    <td class="p-2 pr-3">                                    
                                        
                                            <select name="answer" class="text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                                <option class="text-xs" value="{{ $item->allanswaer->id}}" selected="selected">{{ $item->allanswaer->name}}</option>
                                                @foreach ($data2 as $status)
                                                    @if ($status->id == 2 || $status->id == 1 || $status->id == $item->allanswaer->id )
                                                        @continue
                                                    @endif
                                                    @if ($status->id == 8 && $item->allanswaer->id < 7 )
                                                        @continue
                                                    @endif
                                                    @if ($status->id == 6 && $item->allanswaer->id == 7 )
                                                        @continue
                                                    @endif
                                                    <option class="text-xs" value="{{ $status->id}}">{{ $status->name}}</option>
                                                @endforeach
                                              </select>
                                    </td>
                                    <td class="p-2 pr-3 text-xs">
                                        <input name="info" type="text" class="text-xs" value="{{$item->text}}">
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
        @endsection
        @include('layoutszavsklad.mainbar')
        @section('transfertrue')
        true
        @endsection
    </x-slot>
</x-zavsklad.ojidaniye>