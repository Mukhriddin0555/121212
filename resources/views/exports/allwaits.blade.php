<table>
    <thead>
    <tr >
        <th>ID</th>
        <th>Сап</th>
        <th>Наименования</th>
        <th>Сервис</th>
        <th>Код</th>
        <th>К-во</th>
        <th>Дата</th>
        <th>Состояние</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>№Заявки</th>
    </tr>
    </thead>
    <tbody>
    @foreach($waits as $wait)
        <tr>
            
            @if (strlen($wait->crm_id) == 11)
            <td>'0{{ $wait->crm_id }}</td>
            @else
            <td>{{ $wait->crm_id }}</td>
            @endif            
            <td>{{ $wait->sap_kod }}</td>
            <td>{{ $wait->sapname }}</td>
            <td>{{ $wait->servisname }}</td>
            <td>{{ $wait->warehouseskod }}</td>
            <td>{{ $wait->how }}</td>
            <td>{{ str_replace("-", ".", substr($wait->created_at, 0, 10)) }}</td>
            <td>{{ $wait->statusname }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $wait->order }}</td>
        </tr>
    @endforeach
    </tbody>
</table>