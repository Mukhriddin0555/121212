<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight m-5">
            Добро пожаловать {{ Auth::user()->lastname }} {{ Auth::user()->surname }}
        </h2>
        @include('zavsklad.forminorder')
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