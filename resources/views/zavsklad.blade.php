<x-zavsklad.ojidaniye>
    <x-slot name="header">
        @section('session-start')        
        @if (session('errorid'))
                            <div class="flex justify-center ">
                                <div class="w-1/2 font-black bg-red-400 rounded m-5 text-center">{{ session('errorid') }}
                                </div>
                            </div>
        @endif
        @if (session('errordateid'))
                            <div class="flex justify-center">
                                <div class="w-1/2 font-black bg-red-400 rounded m-5 text-center">{{ session('errordateid') }}
                                </div>
                            </div>
        @endif
        @if (session('success'))
                            <div class="flex justify-center">
                                <div class="w-1/2 font-black bg-green-300 rounded m-5 text-center">{{ session('success') }}
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
        @foreach ($count as $item => $value)
                @section($item)
                    {{ $value }}
                @endsection
        @endforeach
        
    </x-slot>
</x-zavsklad.ojidaniye>