<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Images Hosting</title>
    @vite(['resources/sass/app.scss'])
</head>
<body>
    <div class="container">
        <div class="header">Images Hosting</div>

        <form
            action="{{ @route('upload') }}"
            method="POST"
            id="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div
                data-url="{{ @route("upload_temp") }}"
                data-csrf="{{ csrf_token() }}"
                class="dropzone"
                id="dz"
            ></div>
            <button class="btn">Upload</button>
        </form>

        <form action="#" class="sort">
            <div class="sort__text">Sort:</div>
            <div class="sort__field">
                <label for="by">By</label>
                <select name="by">
                    <option @selected(request('by') == 'name') value="name">Name</option>
                    <option @selected(request('by') == 'created_at') value="created_at">Date</option>
                </select>
            </div>
            <div class="sort__field">
                <label for="order">Order</label>
                <select name="order">
                    <option @selected(request('order') == 'asc') value="asc">ASC</option>
                    <option @selected(request('order') == 'desc') value="desc">DESC</option>
                </select>
            </div>
            <button class="sort__btn">OK</button>
        </form>

        <div class="images">
            @foreach($images as $image)
                <div class="image">
                    <a href="{{ $image->getFirstMediaUrl('file') }}" target="_blank" class="image__preview" style="background-image: url({{ $image->getFirstMediaUrl('file') }})">
                        <div class="image__name">{{ $image->name }}</div>
                    </a>
                    <div class="image__footer">
                        <div class="image__date">{{ $image->created_at }}</div>
                        <a href="{{ route("download", $image->id) }}" class="image__download">
                            <img src="img/download.png" alt="Download as ZIP">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>
