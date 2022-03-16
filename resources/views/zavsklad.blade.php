<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')
        @if (session('errorid'))
                            <div class="flex justify-center ">
                                <div class="w-1/2 font-black bg-red-400 rounded m-5">{{ session('errorid') }}
                                </div>
                            </div>
        @endif
        @if (isset($data1))
                            <div>
                                <div class="flex m-5">
                                    <span class="font-bold">Найденные заказы:</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:sm:grid-cols-3 lg:grid-cols-5">
                                    @foreach ($data1 as $item)
                                    <div class="m-5 flex flex-col justify-center border rounded m-4 p-3">
                                        
                                        <div class="flex justify-center">
                                            <div class="flex justify-center">
                                            

                                                <x-link.document docurl="{{ route('oneWait', $item->id)}}" />
                                            </div>
                                            <div class="flex flex-col">
                                                <div><span>{{$item->Kod}}</span></div>  
                                                <div><span>{{$item->name}}</span></div> 
                                            </div>
                                             
                                        </div>
                                        <div class="flex justify-center">
                                            <div><a href="{{ route('oneWait', $item->id)}}"><span>{{$item->crm_id}}</span></a></div>
                                            </div> 
                                                                               
                                    </div>
                                    
                                    @endforeach
                                </div>
                               
                                
                            </div>
        @endif
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