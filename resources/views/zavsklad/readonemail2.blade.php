<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        <section class="p-6 md:p-12 text-center md:text-left shadow-lg rounded-md">
            <div class="flex justify-center">
              <div class="max-w-3xl">
                <div class="block p-6 rounded-lg shadow-lg bg-white m-4">
                  <div class="md:flex md:flex-row">
                    <div
                      class="md:w-96 w-36 flex justify-center items-center mb-6 lg:mb-0 mx-auto md:mx-0"
                    >
                      <img
                        src="https://mdbootstrap.com/img/Photos/Avatars/img%20%2810%29.jpg"
                        class="rounded-full shadow-md"
                        alt="user avatar"
                      />
                    </div>
                    <div class="md:ml-6">
                      <p class="text-gray-500 font-bold mb-6">
                          Ассалому алейкум хорманг!<br><br>
                          Сизнинг складингизда турган ушбу эхтийот кисмни трансферга юборишингизни илтимос киламан!<br>
                          <br>Филиал номи: {{$user->sklad->name}} <br>Филиал коди: {{$user->sklad->Kod}}<br><br>
                        Эхтийот кисм: {{$transfer->sparepart->sap_kod}} {{$transfer->sparepart->name}} <br> Сони: {{$transfer->how}} дона
                        <br>
                        <br>Примечание: {{$message->text}}
                        <br>
                        <br>Текущий статус: {{$transfer->text}}
                        <br>Хабар юборилган сана: {{$message->created_at}}
                      </p>
                      <p class="font-semibold text-xl mb-2 text-gray-800">{{$user->surname}} {{$user->lastname}}</p>
                      <p class="font-semibold text-gray-500 mb-0">{{$user->role->role}} филиала {{$user->sklad->name}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        @endsection
        @include('layoutszavsklad.mainbar')
        @section('mailtrue')
        true
        @endsection
    </x-slot>
</x-zavsklad.ojidaniye>