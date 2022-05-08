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
        <div class="flex space-x-2 justify-center p-4">
          <h2 class="text-4xl font-medium leading-tight text-gray-800">
              Добавление Заказов
        </div>
        <form class="w-full" action="{{ route('addNewWait')}}" method="post" enctype="multipart/form-data">
            @csrf
            <br>
            <div class="flex flex-nowrap mb-6">
              <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                  CRM ID
                </label>
                <input name="crm_id" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
              </div>
              <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                  Сап код
                </label>
                <input name="sparepart_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
              <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    кол-во
                </label>
                <input name="how" value="1" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
              <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    Номер заказа
                </label>
                <input name="order" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
            </div>
            <div class="mb-6">
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Excel дан импорт килиш
                </label>
                <input name="waitimport" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="file">
                <p class="text-gray-600 text-xs italic">куйидаги форматда киритилсин(.xlsx)</p>
              </div>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="align-center bg-green-200 rounded m-3 p-3 hover:bg-green-400 ">Добавить</button>
            </div>
            </form>