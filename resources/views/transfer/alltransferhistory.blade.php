<x-transfer.all-transfer>
    <x-slot name="header">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">Хатолик</strong>
          <span class="block sm:inline">{{ $error }}</span>
          <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
          </span>
        </div>
        @endforeach
        @endif
        <h1>{{ $data }}</h1>

    </x-slot>
</x-transfer.all-transfer>