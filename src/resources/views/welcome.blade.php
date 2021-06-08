<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        .drop-area {
            height: 200px;
        }

    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-8">
                <div
                    class="drop-area bg-info d-flex justify-content-center align-items-center"
                    ondrop="upload(event)" ondragover="event.preventDefault()">
                    <span>Drop image to upload</span>
                </div>

                <div class="mt-5">
                    <div class="row">
                        @foreach ($images as $image)
                            <div class="col-md-3"
                                onclick="preview(this)"
                                data-image="{{ asset($image->name) }}"
                                data-name="{{ $image->name }}">

                                <img src="{{ asset($image->name) }}" class="img-fluid" alt="">
                                <div class="text-break">{{ $image->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="border vh-100 p-5" id="preview">

                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function upload(e) {
            e.preventDefault();

            const files = e.dataTransfer.files;
            const formData = new FormData();

            for (let index = 0; index < files.length; index++) {
                formData.append('file[]', files[index]);
            }

            formData.append('_token', '{{ csrf_token() }}');

            axios.post('/', formData)
                .then(res => {
                    location.reload();
                })
        }

        function preview(el) {
            const image = el.dataset.image;
            const name = el.dataset.name;
            const width = el.dataset.width;
            const height = el.dataset.height;

            const preview = document.querySelector('#preview');
            preview.innerHTML = `
                <img src="${image}" alt="" class="img-fluid">
                <br><br>
                <div class="text-break">Name: ${name}</div>
                <br><br>
                <div>Width: ${width}</div>
                <br><br>
                <div>Height: ${height}</div>
            `;
        }

    </script>
</body>

</html>
