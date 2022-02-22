<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div>
            <div class="flex justify-center py-8">
                <div><p class="px-4">Накладная на перемешение запчастей </p></div>
                <div><p class="px-4">№ : 32</p></div>
                <div><p>Дата 12.02.2022</p></div>
            </div>
            <div class="flex justify-center py-3.5">
                <p class="px-4">Отправитель</p>
                <p class="px-4">OOO "NEW PROFI TECHNOLOGY"</p>
                <p class="px-4">Филиал Андижан - склад 4115</p>
            </div>
            <div class="flex justify-center py-3.5">
                <p class="px-4">Получатель</p>
                <p class="px-4">OOO "NEW PROFI TECHNOLOGY"</p>
                <p class="px-4">Филиал Куканд - склад 4112</p>
            </div>
            <div class="flex justify-center overflow-hidden sm:rounded-lg py-8">
                <table class="border">
                    <thead class="border">
                        <tr class="border">
                            <th class="border w-24 p-1 pr-10">Сап код</th>
                            <th class="border w-96 p-1 pr-10">Наименование</th>
                            <th class="border w-24 p-1 pr-10">шт</th>
                            <th class="border w-64 p-1 pr-10">Примечание</th>
                            <th class="border w-24 p-1 pr-10">Расходы</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        <tr class="border">
                            <td class="border w-24  p-1 pr-10">R10080027</td>
                            <td class="border w-96  p-1 pr-10">Насос для слива воды</td>
                            <td class="border w-24  p-1 pr-10">1</td>
                            <td class="border w-64  p-1 pr-10">таксидан юборилди</td>
                            <td class="border w-24  p-1 pr-10">35000</td>
    
                        </tr>
                    </tbody>                
                </table>
            </div>
            <div class="flex justify-center">
                <div class="border-b-2 py-4 px-16 w-2/3">
                    Отпустил: Зухритдинов Мухриддин
                </div>
            </div>
            <div class="flex justify-center">
                <div class="border-b-2 py-4 px-16 w-2/3">
                    Получил: Бойматов Шукурхон
                </div>
            </div>
            <div class="flex justify-center">
                <div class="border-b-2 py-4 px-16 w-2/3">
                    Разрешил : Агент по снабжению
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="border w-1/4 py-4 m-4">
                <div class="flex justify-around">
                    <div class="pr-5 m-2 text-3xl">
                        Андижондан
                    </div>
                    <div class="pr-5 m-2 text-3xl">
                        4115
                    </div>
                </div>
                <div class="text-center text-3xl">
                    Трансфер
                </div>
                <div class="flex justify-around">
                    <div class="pr-5 m-2 text-3xl">
                        Кукандга
                    </div>
                    <div class="pr-5 m-2 text-3xl">
                        4112
                    </div>
                </div>
                <div class="pr-5 m-2 font-bold text-center">
                    Тел: +998903074151
                </div>
            </div>
        </div>
    </body>
</html>