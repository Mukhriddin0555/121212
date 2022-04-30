<x-zavsklad.ojidaniye>
    <x-slot name="header">
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
        @section('session-start')
        <form class="w-full max-w-lg m-5" action="{{ route('updateOneWait', $wait->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="flex md:w-3/4 mb-6">
            <div class="w-full  p-6 bg-white border rounded border-gray-200">
              <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                      Id
                    </label>
                    <div name="surname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
                      {{$wait->crm_id}}
                    </div>
                  </div>
                  <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                      Примечание
                    </label>
                    <input name="text" value="{{$wait->text}}" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
                  </div>          
              </div>
          <br><button type="submit" class="bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Сохранить</button>
        </form>
        @endsection
        @foreach ($count as $item => $value)
                @if ($value > 0)
                @section($item)
                <span class="flex items-center justify-center text-xs text-red-500 font-semibold 
                bg-red-100 h-6 px-2 rounded-full ml-auto">{{ $value }}</span>
                @endsection
                @endif
        @endforeach
        @section('waittrue')
        true
        @endsection
    </x-slot>
</x-zavsklad.ojidaniye>