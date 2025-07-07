<head>
    <link rel="stylesheet" href="{{asset('/styles/hotels/show.css')}}">
</head>

<div class="images-container">
    <div class="slider-wrapper">
        <div class="slider">
        @foreach ($getState() as $image)
            <img id="slide-{{ $image }}" src="{{ asset('storage/' . $image) }}" alt="Hotel Image" />
        @endforeach
        </div>

        <div class="slider-nav">
        @foreach ($getState() as $image)
            <a href="#slide-{{ $image }}"></a>
        @endforeach
        </div>
    </div>
</div>