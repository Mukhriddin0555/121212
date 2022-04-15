<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        <script type="text/javascript">  
            function selects(){  
                var ele=document.getElementsByName('selected[]');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=true;  
                }  
            }  
            function deSelect(){  
                var ele=document.getElementsByName('selected[]');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                      
                }  
            }             
        </script> 
        <form id="selectedopt" method="GET"></form>
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
        <div>
            <div class="max-w-7xl ml-2 mx-auto sm:px-6>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="flex justify-center my-3.5 w-full">
                        <th class="p-1 pr-1"></th>
                        <th class="p-1 pr-14"><a href="{{ route('FilialBranchMailAll', ['surname'])}}">Отправитель</a></th>
                        <th class="p-1 pr-14"><a href="{{ route('FilialBranchMailAll', ['role'])}}">Должность</a></th>
                        <th class="p-1 pr-14"><a href="{{ route('FilialBranchMailAll', ['topic'])}}">Тема</a></th>
                        <th class="p-1 pr-14"><a href="{{ route('FilialBranchMailAll', ['created_at'])}}">Дата отправки</a></th>
                        <th class="p-1 pr-1"></th>
                        @foreach ($messages as $item)
                            <tr class="hover:bg-gray-100">
                                @if ($item->active == 1)
                                <td class="p-1 pr-1">
                                    <img src="{{asset('storage/message1_icon.png')}}"  alt="Прочитан" class="w-4 h-4">
                                </td>
                                @else
                                <td class="p-1 pr-1">
                                    <img src="{{asset('storage/message_icon.png')}}"  alt="Прочитан" class="w-4 h-4">
                                </td>
                                @endif
                                <td class="p-1 pr-14">
                                    {{$item->surname}} {{$item->lastname}}
                                </td>
                                <td class="p-1 pr-14">
                                    {{$item->role}}
                                </td>
                                <td class="p-1 pr-14">
                                    <a href="{{ route('FilialBranchMailRead', [$item->id]) }}">{{$item->topic}}</a>
                                </td>
                                <td class="p-1 pr-1 text-xs">
                                    {{$item->created_at}}
                                </td>
                                <th class="p-1 pr-1">
                                    <x-link.delete delete="{{ route('FilialBranchMailDelete', [$item->id]) }}" />
                                </th>
                                <th class="p-1 pr-1 text-xs">
                                    <input type="checkbox" name="selected[]" form="selectedopt" value="{{$item->id}}">
                                </th>
                            </tr>                            
                        @endforeach
                    </table>
                    
                </div>
            </div>
            <div class="flex justify-center">
                <input type="button" onclick='selects()' value="выбрать все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400"><br>
                <input type="button" onclick='deSelect()' value="отменить все" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400">
                <button form="selectedopt"  formaction="{{ route('FilialBranchMailDeleteMulti')}}" type="submit" formmethod="get" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Удалить</button>
                <button title="Отправить Новое сообшение" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 "><a href="{{ route('FilialBranchMailNewMessage')}}">Создать новое</a></button>
                
                <br>
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