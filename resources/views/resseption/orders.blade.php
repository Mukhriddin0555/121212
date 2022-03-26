<x-resseption.appresseption>
    <x-slot name="header">
      @section('session-start')
      
          <div class="py-2">
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="flex justify-center">
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['1', 'crm_id', 'asc'])}}">CRM ID</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['1', 'sap_kod', 'asc'])}}">Сап код</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['1', 'sap.name', 'asc'])}}">Наименование</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('ressepshnOrders', ['1', 'how', 'asc'])}}">кол</a></th>
                        <th class="p-2 pr-7"></th>
                        @foreach ($data as $item)
                            <tr>
                                <td class="p-2 pr-7">
                                    {{$item->crm_id}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->sapkod->sap_kod}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->sapkod->name}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->how}} шт
                                </td>
                                <th class="p-2 pr-3">
                                    <a href="{{ route('orderDelete', $item->id)}}" title="Удалить"><img src="{{asset('storage/delete_icon.png')}}"  alt="Удалить" class="w-4 h-4"></a>
                                </th>
                            </tr>
                        @endforeach
                        
                        
                    </table>
                </div>
            </div>
        </div>
      @endsection
      @section('countdostavlen')
            {{ $data3 }}
        @endsection
        @section('countojidaniya')
            {{ $data2 }}
        @endsection 
      
    </x-slot>
    
    
</x-resseption.appresseption>