<x-app-layout>
    <x-slot name="header">
        <H6>Фойдаланувчи хакида малумот</H6>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Исми
                          </label>
                          <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$data->surname}}
                        </div>
                        </div>         
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Фамилияси
                          </label>
                          <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$data->lastname}}
                        </div>
                        </div>         
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Номери
                          </label>
                          <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$data->number}}
                        </div>
                        </div>         
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Буюруг хакида малумот
                          </label>
                          <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$data->order}}
                        </div>
                        </div>         
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Мансаби
                          </label>
                          <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$data->role->role}}
                        </div>
                        </div>         
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            Почта манзили
                          </label>
                          <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                            {{$data->email}}
                        </div>
                        </div>         
                    </div>                    
                    <div class="flex justify-center">
                        <button class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">
                            <a href="{{ route('editOneUser', $data->id)}}">Изменить</a>
                        </button>       
                        <button class="font-bold text-white no-underline rounded p-2 bg-green-400 shadow-sm m-1 duration-200 transition ease-in-out duration-150 hover:bg-green-600 active:bg-green-700 ">
                            <a href="{{ route('deleteOneUser', $data->id)}}">Удалить</a>
                        </button>  
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>