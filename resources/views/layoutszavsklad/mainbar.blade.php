@foreach ($count as $item => $value)
        @if ($item == 'profile')
        @section($item)
        <a href="#" class="flex flex-row items-center">
            <span class="flex flex-col ml-2 hidden lg:flex  ">
              <span class="truncate w-30 font-semibold tracking-wide leading-none">{{ $value->surname }}</span>
              <span class="truncate w-30 text-gray-500 text-xs leading-none mt-1">{{ $value->role->role }}</span>
            </span>
        </a>
        @endsection  
        @else
            @if ($value > 0)
              @section($item)
              <span class="flex items-center justify-center text-xs text-red-500 font-semibold 
              bg-red-100 h-6 px-2 rounded-full ml-auto">{{ $value }}</span>
              @endsection
            @endif
        @endif
        @endforeach