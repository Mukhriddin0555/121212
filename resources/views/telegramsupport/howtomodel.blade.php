@foreach ($models as $model)
    <b>SN: </b> <code>{{$model->zavod_sn}}</code>
    <b>Sap kod: </b> <code>{{$model->material}}</code>
    <b>Модели: </b> <code>{{$model->description}}</code>
    <b>Цвет: </b> <code>{{$model->color}}</code>
@endforeach