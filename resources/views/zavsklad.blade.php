<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
           <div class="m-5">sss</div>
        @endsection
        @section('countwait')
            {{ $data3 }}
        @endsection
        @section('countvputi')
            {{ $data2 }}
        @endsection
        @section('countdostavlen')
            {{ $data4 }}
        @endsection
        @section('countprodaja')
            {{ $data5 }}
        @endsection
    </x-slot>
</x-zavsklad.ojidaniye>