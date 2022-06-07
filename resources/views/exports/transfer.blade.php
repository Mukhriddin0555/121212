<table>
    <thead>
    <tr>  
        <td>Накладная на перемешение запчастей</td> <td></td> <td>№</td><td>{{$transfer->order_number}}</td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>   <td></td>   <td></td>   <td></td>  <td>Дата: {{ substr($transfer->created_at, 0, 10)}}</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Откуда :</td>  <td>OOO "NEW PROFI TECHNOLOGY"  Филиал {{$fromhouse->name}}</td> <td>{{$fromhouse->Kod}}</td> <td>Cклад</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Кому :</td>  <td>OOO "NEW PROFI TECHNOLOGY"  Филиал {{$tohouse->name}}</td> <td>{{$tohouse->Kod}}</td> <td>Cклад</td>
    </tr>
    <tr></tr>
    </thead>
    <tbody>
    <tr>
        <td>Сап код</td>    <td>Наименование</td>   <td>Ед. Изм</td>    <td>Кол-во</td> <td>CRM ID</td>
    </tr>
    <tr>
        <td>{{$transfer->sparepartname->sap_kod}}</td>  <td>{{$transfer->sparepartname->name}}</td>  <td>шт</td> <td>{{$transfer->how}}</td> <td> ID: {{$transfer->transferinfo->crm_id}}</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Отпустил:</td>   <td>{{ $fromhouse->user->surname }} {{ $fromhouse->user->lastname }} ___________</td><td></td>  <td>м/у</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Принял:</td>   <td>{{ $tohouse->user->surname }} {{ $tohouse->user->lastname }}  ___________</td><td></td>  <td>м/у</td>
    </tr>
    <tr></tr>
    <tr>
        <td></td><td></td><td>{{$fromhouse->Kod}} {{$fromhouse->name}}дан</td>
    </tr>
    <tr>
        <td></td><td></td><td>Трансфер</td>
    </tr>
    <tr>
        <td></td><td></td><td>{{$tohouse->Kod}} {{$tohouse->name}}га</td>
    </tr>
    <tr>
        <td></td><td></td><td>+998 ({{ substr($tohouse->user->number, 0, 2)}}) {{ substr($tohouse->user->number, 2, 3)}} {{ substr($tohouse->user->number, 5, 4)}}</td>
    </tr>
    <tr></tr>
    <tr>
        <td></td><td></td><td>{{$fromhouse->Kod}} {{$fromhouse->name}}дан</td>
    </tr>
    <tr>
        <td></td><td></td><td>Трансфер</td>
    </tr>
    <tr>
        <td></td><td></td><td>{{$tohouse->Kod}} {{$tohouse->name}}га</td>
    </tr>
    <tr>
        <td></td><td></td><td>+998 ({{ substr($tohouse->user->number, 0, 2)}}) {{ substr($tohouse->user->number, 2, 3)}} {{ substr($tohouse->user->number, 5, 4)}}</td>
    </tr>
    </tbody>
</table>