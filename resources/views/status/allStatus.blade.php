<x-app-layout>
    <x-slot name="header">
        <H6>Статусы</H6>
    </x-slot>
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
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                          Статусы:
                        </label><br>
                        @foreach ($data1 as $status1)
                        <div class="flex justify center m-1 block tracking-wide text-xs mb-2">
                          <div name="location" class="appearance-none block md:w-1/2 bg-gray-200 text-gray-700 border border-gray-200 rounded m-1 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$status1->name}}
                          </div>
                        </div>
                        @endforeach
                        @foreach ($data2 as $status2)
                        <div class="flex justify center m-1 block tracking-wide text-xs mb-2">
                          <div name="location" class="appearance-none block md:w-1/2 bg-gray-200 text-gray-700 border border-gray-200 rounded m-1 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$status2->name}}
                          </div>
                          <button class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">
                            <a href="{{ route('deleteStatus', $status2->id)}}">Удалить</a>
                        </button>
                        </div>
                        @endforeach                        
                      </div>       
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Добавить еще:
                      </label><br>
                      <form action="{{ route('addStatus')}}" method="post">
                        @csrf
                        <div class="flex justify center m-1 block tracking-wide text-xs mb-2">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                  Название
                                </label>
                                <input name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
                                <button type="submit" class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">Сохранить</button>
                              </div>
                          
                        </div>                      
                      </form>                      
                    </div>       
                </div>
            </div>
        </div>
    </div>
</x-app-layout>