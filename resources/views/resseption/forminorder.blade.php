
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
        <form class="w-full" action="{{ route('newRessepshnOrders')}}" method="post">
            @csrf
            <div class="flex justify-center font-bold">Добавить новый заказ</div>
            <br>
            <div class="flex m-3 ml-8 mb-6">
              <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  CRM ID
                </label>
                <input name="crm_id" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text">
              </div>
              <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Сап код
                </label>
                <input name="sap_kod" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
              <div class="w-full md:w-1/4 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    кол-во
                </label>
                <input name="how" value="1" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name">
              </div>
              <div class="w-full md:w-1/4 px-3"><button type="submit" class="w-4/6 h-4/6 bg-green-200 rounded m-3 p-3 hover:bg-green-400 mt-5">Сохранить</button></div>
            </div>
            
          </form>