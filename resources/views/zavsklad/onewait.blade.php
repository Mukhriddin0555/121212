<x-zavsklad.ojidaniye>
    <x-slot name="header">
      @section('session-start')
      <div class="flex justify-center w-full md:w-3/4">
        <div class="font-bold text-xl"><span>Кутилайотган эхтийот кисм хакида малумот:</span></div>
      </div>
      
      
      <div class="py-2">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden ">
                  <div class="w-full md:w-3/4 p-6 bg-white border rounded border-gray-200">
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Регион
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data->sklad->name}}
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Id
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data->crm_id}}
                            </div>
                          </div>          
                      </div>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Sap kod
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data->sapkod->sap_kod}}
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              наименование
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data->sapkod->name}}
                            </div>
                          </div>         
                      </div>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Требуемуе количество
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data->how}} шт
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Номер заказа в сапе
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data->order}}
                            </div>
                          </div>         
                      </div>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Текущий статус
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data->status->name}}
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Примечание
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              @if (empty($data->text))
                                  Примечании нет
                              @endif
                              {{$data->text}}
                            </div>
                          </div>         
                      </div>                     
                      <div class="flex justify-center">
                          @if ($data->status_id != 2)
                              <button class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">
                                <a href="{{ route('editOneWait', $data->id)}}">Изменить</a>
                              </button>
                          @else
                            <button class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">
                              <a href="{{ url()->previous()}}">Назад</a>
                            </button>
                          @endif 
                      </div>
                      
                  </div>
                  
                  
              </div>
              
          </div>
          
      </div>
      @endsection
      @foreach ($count as $item => $value)
                @section($item)
                    {{ $value }}
                @endsection
        @endforeach
      
    </x-slot>
</x-zavsklad.ojidaniye>