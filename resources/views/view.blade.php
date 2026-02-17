<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                View User Details of {{ $ok->first()->name }}
            </h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ok as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }} {{ $item->surname }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->DOB }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
                Back
            </a>
        </div>
    </div>

</div>

</body>
</html>