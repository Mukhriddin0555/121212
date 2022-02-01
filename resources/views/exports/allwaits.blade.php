<table>
    <thead>
    <tr class="bg-sky-500">
        <th class="bg-sky-500">ID</th>
        <th class="bg-sky-500">Сап</th>
        <th class="bg-sky-500">Наименования</th>
        <th class="bg-sky-500">Сервис</th>
        <th class="bg-sky-500">К-во</th>
        <th class="bg-sky-500">Дата</th>
        <th class="bg-sky-500">Состояние</th>
        <th class="bg-sky-500">№Заявки</th>
    </tr>
    </thead>
    <tbody>
    @foreach($waits as $wait)
        <tr>
            <td>{{ $wait->crm_id }}</td>
            <td>{{ $wait->sap_kod }}</td>
            <td>{{ $wait->sapname }}</td>
            <td>{{ $wait->warehouseskod }}</td>
            <td>{{ $wait->how }}</td>
            <td>{{ str_replace("-", ".", substr($wait->created_at, 0, 10)) }}</td>
            <td>{{ $wait->statusname }}</td>
            <td>{{ $wait->order }}</td>
        </tr>
    @endforeach
    </tbody>
</table>