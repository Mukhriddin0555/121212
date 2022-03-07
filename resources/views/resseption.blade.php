<x-resseption.appresseption>
    <x-slot name="header">
        @section('session-start')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight m-5">
            Добро пожаловать {{ Auth::user()->lastname }} {{ Auth::user()->surname }}
        </h2>
        @include('resseption.forminorder')
        @endsection
        @section('countdostavlen')
            {{ $data3 }}
        @endsection
        @section('countojidaniya')
            {{ $data2 }}
        @endsection       
    </x-slot>
</x-resseption.appresseption>
