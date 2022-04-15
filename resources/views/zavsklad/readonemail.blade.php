<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        салююют
        @endsection
        @foreach ($count as $item => $value)
                @section($item)
                    {{ $value }}
                @endsection
        @endforeach
        
    </x-slot>
</x-zavsklad.ojidaniye>