<div class="flex flex-wrap gap-2">
    @foreach($getState() as $image)
        <img src="{{ asset('storage/' . $image) }}" alt="Hotel Image" class="h-12 w-12 object-cover rounded">
    @endforeach
</div>