<x-app-layout>
    <x-slot name="header">
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table>
                        <th class="p-2 pr-7">№</th>
                        <th class="p-2 pr-7"><a href="{{ route('allUsers', ['surname', 'asc'])}}">Имя</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('allUsers', ['lastname', 'asc'])}}">Фамилия</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('allUsers', ['number', 'asc'])}}">Номер</a></th>
                        <th class="p-2 pr-7"><a href="{{ route('allUsers', ['role_id', 'asc'])}}">Роль</a></th>
                        <th class="p-2 pr-7"></th>
                        @foreach ($data as $item)
                            <tr>
                                <td class="p-2 pr-7">
                                    {{$loop->index+1}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->surname}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->lastname}}
                                </td>
                                <td class="p-2 pr-7">
                                    +998{{$item->number}}
                                </td>
                                <td class="p-2 pr-7">
                                    {{$item->role}}
                                </td>
                                <th class="p-2 pr-7">
                                    <a href="{{ route('oneUser', $item->id)}}">подробнее</a>
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
            <a href="{{ route('newUser')}}">Добавить еще</a>
        </button>        
    </div>
    
    
</x-app-layout>