<x-app-layout>
    <x-slot name="header">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-2 pr-7">№</th>
                        <th class="p-2 pr-7"><a href="{{ route('allBranchs', ['Kod', 'asc'])}}">Код филиала</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('allBranchs', ['name', 'asc'])}}">Регион</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('allBranchs', ['zavskladsurname', 'asc'])}}">Зав. склад</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('allBranchs', ['filialmanagersurname', 'asc'])}}">Упр. филиала</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('allBranchs', ['managersurname', 'asc'])}}">Менеджер</a></th>
                        <th class="p-2 pr-7"></th>
                        @foreach ($data as $item)
                            <tr>
                                <td class="p-2 pr-7">
                                    {{$loop->index+1}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->Kod}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->name}}
                                </td>
                                <td class="p-2 pr-7">
                                    @if ($item->zavskladsurname && $item->zavskladlastname)
                                    {{$item->zavskladsurname}} {{$item->zavskladlastname}}
                                    @else
                                    зав. склад не привязан
                                    @endif
                                </td>
                                <td class="p-2 pr-7">
                                    @if ($item->filialmanagersurname && $item->filialmanagerlastname)
                                    {{$item->filialmanagersurname}} {{$item->filialmanagerlastname}}
                                    @else
                                     упр филиала не привязан
                                    @endif
                                    
                                </td>
                                <td class="p-2 pr-7">
                                    @if ($item->managersurname && $item->managerlastname)
                                    {{$item->managersurname}} {{$item->managerlastname}}
                                    @else
                                     Менеджер не привязан
                                    @endif
                                    
                                </td>
                                <th class="p-2 pr-7">
                                    <a href="{{ route('oneBranch', $item->id)}}">подробнее</a>
                                </th>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="flex justify-center">
        <button class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">
            <a href="{{ route('newBranch')}}">Добавить еще</a>
        </button>        
    </div>
    
    
</x-app-layout>