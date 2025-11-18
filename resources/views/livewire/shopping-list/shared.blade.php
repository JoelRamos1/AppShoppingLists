<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @forelse ($shoppingLists as $shoppingList)
        {{$shoppingList->title}}
    @empty
        <p>There is nothing here</p>
    @endforelse
</div>
