<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        th,td{ text-align: center; } 
    </style>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    @if(session('alert'))
    <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg">
        {{ session('alert') }}
    </div>
@endif

@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif
    <a href="/add" class="btn btn-primary">Add User</a>
    <a  href="{{ route('logout') }}" class="btn btn-danger">logout</a>
    <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover align-middle">
      
        <tr>
            <th>id</th>
            <th width="20%">name</th>
            <th>email</td>
            <th width="20%">date of birth</th>
            <th>adhar</th>
            <th>image</th>

            <th>Actions to perform</th>
            {{-- <th>del</th>
            <th>update</th> --}}
           
        </tr>
        @foreach ($ok as $item)
        @if($item->status == 0)
            @continue
        @endif
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}} {{$item->surname}}</td>
            <td>{{$item->email}}</td>
            <td >{{$item->DOB}}</td>
            <td>****-****-{{ substr($item->adhar, -4) }}</td>

            <td>
                @if($item->image)
                    <img src="{{ asset('images/' . $item->image) }}" alt="User Image" width="100">
                @else
                    <span class="text-muted">No image</span>
                @endif
            </td>
            <td>  <a class="btn btn-danger" onclick="myfun()" href="{{ route('delete.resister', ['id' => $item->id]) }}">Delete</a>
             <a class="btn btn-danger" href="{{ route('update.resister', ['id' => $item->id]) }}">Update</a></div></td>
           
            
        
        </tr>
        @endforeach
        <script>
            function myfun(){ 
                if(!confirm("Are you sure you want to delete this user?")){ 
                    event.preventDefault(); 
                } 
            }
        </script>
    </table>    
    </div>
    
</body>
</html>