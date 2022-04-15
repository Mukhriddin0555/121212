<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        <div class="flex justify-center">
            <div class="m-10 p-6 rounded-lg shadow-lg bg-white w-2/4">
                <form action="{{ route('FilialBranchAddMailNewMessage')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-6">
                        <select name="user_id" class="block appearance-none px-3 py-1.5 w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            @foreach ($users as $user)
                            <option value="{{ $user->id}}">{{ $user->surname}} {{ $user->lastname}} || {{ $user->role->role}}</option>
                            @endforeach
                        </select>
                    </div>
                  <div class="form-group mb-6">
                    <input type="text" name="topic" class="form-control block
                      w-full
                      px-3
                      py-1.5
                      text-base
                      font-normal
                      text-gray-700
                      bg-white bg-clip-padding
                      border border-solid border-gray-300
                      rounded
                      transition
                      ease-in-out
                      m-0
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput8"
                      placeholder="Тема сообшении">
                  </div>
                  <div class="form-group mb-6">
                    <textarea
                    type="text" name="text" 
                    class="
                      form-control
                      block
                      w-full
                      px-3
                      py-1.5
                      text-base
                      font-normal
                      text-gray-700
                      bg-white bg-clip-padding
                      border border-solid border-gray-300
                      rounded
                      transition
                      ease-in-out
                      m-0
                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                    "
                    id="exampleFormControlTextarea13"
                    rows="3"
                    placeholder="Напишите ваше сообшение"
                  ></textarea>
                  </div>
                  <button type="submit" class="
                    w-full
                    px-6
                    py-2.5
                    bg-blue-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    rounded
                    shadow-md
                    hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out">Отправить</button>
                </form>
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