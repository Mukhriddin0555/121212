<x-app-layout>
    <form class="w-full max-w-lg" action="{{ route('sparePartSearch')}}" method="get">
        <div><h6>Поиск запчасти</h6></div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              По САП коду
            </label>
            <input name="sap" value="@if(isset($data1)){{$data1}}@endif" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
              По названию
            </label>
            <input name="name" value="@if(isset($data2)){{$data2}}@endif" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
          </div>
        </div>
        <button type="submit" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Искать запчасти</button>
      </form>
    <x-slot name="header">
        @if (isset($data1))
        <div>Результаты поиска по указанному сап коду "{{$data1}}"</div>
        @endif 
        @if (isset($data2))
        <div>Результаты поиска по указанному наименованию "{{$data2}}"</div>
         @endif 
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-2 pr-7">№</th>
                        <th class="p-2 pr-7">Сап код</th>
                        <th class="p-2 pr-7">Наименование</th>
                        <th class="p-2 pr-7"></th>
                        @foreach ($data as $item)
                            <tr>
                                <td class="p-2 pr-7">
                                    {{$loop->index+1}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->sap_kod}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->name}}
                                </td>
                                <th class="p-2 pr-7">
                                    <a href="{{ route('deleteSparePart', $item->sap_kod)}}">удалить</a>
                                </th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>