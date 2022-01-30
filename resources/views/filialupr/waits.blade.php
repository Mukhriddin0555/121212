<x-branchmanager.branfilialmanager>
    
    <x-slot name="header">
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table>
                    <th class="p-1 pr-3">№</th>
                    <th class="p-1 pr-3"><a href="{{ route('waitorders', ['data', 'asc'])}}">Дата ID</a></th>
                    <th class="p-1 pr-3"><a href="{{ route('waitorders', ['crm_id', 'asc'])}}">CRM ID</a></th>
                    <th class="p-1 pr-3"><a href="{{ route('waitorders', ['sap_kod', 'asc'])}}">Сап код</a></th>
                    <th class="p-1 pr-3"><a href="{{ route('waitorders', ['sapname', 'asc'])}}">Наименование</a></th>
                    <th class="p-1 pr-3"><a href="{{ route('waitorders', ['how', 'asc'])}}">шт</a></th>
                   <th class="p-1 pr-3"><a href="{{ route('waitorders', ['statusname', 'asc'])}}">Текущий статус</a></th>
                    @foreach ($data as $item)
                        <tr>
                            <td class="p-1 pr-3">
                                {{$loop->index+1}}
                            </td>
                            <td class="p-1 pr-3 text-xs">
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
                            <td class="p-1">
                                {{ $item->statusname}}                                                                      
                            </td>
                        </tr>
                        
                    @endforeach
                </table>
                
            </div>
        </div>
    </div>
        
</x-slot>
</x-branchmanager.branfilialmanager>