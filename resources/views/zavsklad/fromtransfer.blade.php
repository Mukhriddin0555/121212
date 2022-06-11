<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
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
        @if (session('noDelete'))
                            <div class="flex justify-center ">
                                <div class="w-1/2 font-black bg-red-400 rounded m-5 text-center">{{ session('noDelete') }}
                                </div>
                            </div>
        @endif
        @if (session('deleted'))
                            <div class="flex justify-center">
                                <div class="w-1/2 font-black bg-green-300 rounded m-5 text-center">{{ session('deleted') }}
                                </div>
                            </div>
        @endif
        <div class="flex space-x-2 justify-center p-4">
            <h2 class="text-4xl font-medium leading-tight text-gray-800">
                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">Новый</span>
                заказ на трансфер</h2>
          </div>
        <form class="w-full " action="{{ route('newtransfer')}}" method="post">
            @csrf
            <br>
            <div class="flex mb-6">
              
                <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Сап код
                </label>
                <input name="sparepart_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                </div>
                <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    кол-во
                </label>
                <input name="how" value="1" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                </div>
                <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Выбрать филиал
                </label>
                <select name="tosklad" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    @foreach ($branchs as $branch)
                        <option value="{{ $branch->id}}">{{ $branch->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Crm_ID
                    </label>
                    <input name="crm_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="number">
                  </div>              
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Сохранить</button>
            </div>
            
          </form>
          <div class="flex space-x-2 justify-center p-4">
            <h2 class="text-4xl font-medium leading-tight text-gray-800">
                
                Мои заказы на 
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