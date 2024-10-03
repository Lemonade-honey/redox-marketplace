<div wire:poll.keep-alive>
    @foreach ($orders as $item)
    <div class="w-full sm:flex justify-between p-4 border border-gray-100 shadow rounded-lg">
        <a href="{{ route('master.order.detail', $item->id) }}" class="font-semibold hover:underline truncate">{{ $item->id }}</a>
        <div class="font-bold">{{ $item->payment->status }}</div>
        <div class="">{{ $item->created_at->diffForHumans() }}</div>
    </div>
    @endforeach
</div>
