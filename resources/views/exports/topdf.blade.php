<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('storage/font/OmniglotFont.ttf')}}">
        <style>
            
            @font-face{
                font-family: 'RalewayRegular';
                src: url("{{asset('storage/font/OmniglotFont.ttf')}}") format("truetype"); ;
                font-style: normal; 
                font-weight: normal; 
            }
            p.exserif {font-family: 'RalewayRegular';}
            
        </style>
    </head>
    <body>
        <div>
            <div class="header">
                <div><p class="exserif">Накладная на перемешение запчастей </p></div>
                <div><p>№ : 32</p></div>
                <div><p>Дата 12.02.2022</p></div>
            </div>
            <div class="">
                <p style="font-family: RalewayRegular">Отправитель</p>
                <p>OOO "NEW PROFI TECHNOLOGY"</p>
                <p>Филиал Андижан - склад 4115</p>
            </div>
            <div class="fromto">
                <p>Получатель</p>
                <p>OOO "NEW PROFI TECHNOLOGY"</p>
                <p>Филиал Куканд - склад 4112</p>
            </div>
            <div class="flex justify-center overflow-hidden sm:rounded-lg py-8">
                <table class="border">
                    <thead class="border">
                        <tr class="border">
                            <th>Сап код</th>
                            <th>Наименование</th>
                            <th>шт</th>
                            <th>Примечание</th>
                        </tr>
                    </thead>
                    <tbody class="border">
                        <tr class="border">
                            <td class="border">R10080027</td>
                            <td class="border">Насос для слива воды</td>
                            <td class="border">1</td>
                            <td class="border">865 Исузудан бериб юборилди</td>
    
                        </tr>
                    </tbody>                
                </table>
            </div>
            <div class="from">
                <div class="person">
                    Отпустил: Зухритдинов Мухриддин
                </div>
            </div>
            <div class="to">
                <div class="person">
                    Получил: Бойматов Шукурхон
                </div>
            </div>
            <div class="manager">
                <div class="person">
                    Разрешил : Агент по снабжению
                </div>
            </div>
        </div>
        <div class="info">
            <div class="trandferinfo">
                <div class="fromsklad">
                    <div class="sklad">
                        Андижондан
                    </div>
                    <div class="skladkod">
                        4115
                    </div>
                </div>
                <div class="text-center text-3xl">
                    Трансфер
                </div>
                <div class="tosklad">
                    <div class="sklad">
                        Кукандга
                    </div>
                    <div class="skladkod">
                        4112
                    </div>
                </div>
                <div class="number">
                    Тел: +998903074151
                </div>
            </div>
        </div>
    </body>
</html>