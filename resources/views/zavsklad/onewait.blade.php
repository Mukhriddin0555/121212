<x-zavsklad.ojidaniye>
    <x-slot name="header">
      @section('session-start')
      <div class="flex justify-center w-full md:w-3/4">
        <div class="font-bold text-xl"><span>Кутилайотган эхтийот кисм хакида малумот:</span></div>
      </div>
      
      
      <div class="py-2">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden ">
                  @foreach ($data as $data1)
                  <div class="w-full md:w-3/4 p-6 bg-white border rounded border-gray-200">
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Регион
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data1->skladname}}
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Id
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data1->crm_id}}
                            </div>
                          </div>          
                      </div>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Sap kod
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data1->sap_kod}}
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              наименование
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data1->sapname}}
                            </div>
                          </div>         
                      </div>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Требуемуе количество
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data1->how}} шт
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Номер заказа в сапе
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data1->order}}
                            </div>
                          </div>         
                      </div>
                      <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Текущий статус
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              {{$data1->statusname}}
                            </div>
                          </div>
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Примечание
                            </label>
                            <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                              @if (empty($data1->text))
                                  Примечании нет
                              @endif
                              {{$data1->text}}
                            </div>
                          </div>         
                      </div>                     
                      <div class="flex justify-center">
                          <button class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">
                              <a href="{{ route('editOneWait', $data1->id)}}">Изменить</a>
                          </button> 
                      </div>
                      
                  </div>
                  @endforeach
                  
                  
              </div>
              
          </div>
          
      </div>
      @endsection
      @section('countwait')
      {{ $data3 }}
      @endsection
      @section('countvputi')
          {{ $data2 }}
      @endsection
      @section('countdostavlen')
          {{ $data4 }}
      @endsection
      @section('countprodaja')
          {{ $data5 }}
      @endsection
      
    </x-slot>
</x-zavsklad.ojidaniye>