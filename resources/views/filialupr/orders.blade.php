<x-branchmanager.branfilialmanager>
    <x-slot name="header">
            <div class="py-2">
              
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                      <table>
                          <th class="p-2 pr-7">№</th>
                          <th class="p-2 pr-7"><a href="{{ route('resseptionorders', ['crm_id', 'asc'])}}">CRM ID</a></th>
                          <th class="p-2 pr-7"><a href="{{ route('resseptionorders', ['sap_kod', 'asc'])}}">Сап код</a></th>
                          <th class="p-2 pr-7"><a href="{{ route('resseptionorders', ['sapname', 'asc'])}}">Наименование</a></th>
                          <th class="p-2 pr-7"><a href="{{ route('resseptionorders', ['how', 'asc'])}}">кол</a></th>
                          <th class="p-2 pr-7"><a href="{{ route('resseptionorders', ['statusname', 'asc'])}}">Статус</a></th>        
                          @foreach ($data as $item)
                              <tr>
                                  <td class="p-2 pr-7">
                                      {{$loop->index+1}}
                                  </td>
                                  <td class="p-2 pr-7">
                                      {{$item->crm_id}}
                                  </td>
                                  <td class="p-2 pr-7">
                                      {{$item->sap_kod}}
                                  </td>
                                  <td class="p-2 pr-7">
                                      {{$item->sapname}}
                                  </td>
                                  <td class="p-2 pr-7">
                                      {{$item->how}} шт
                                  </td>
                                  <td class="p-2 pr-7">
                                      {{$item->statusname}}
                                  </td>
                              </tr>
                          @endforeach
                          
                          
                      </table>
                  </div>
              </div>
          </div>
      </x-slot>
      
      
</x-branchmanager.branfilialmanager>