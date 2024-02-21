<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('store') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="submit" name="ok">
    </form>
    @foreach ($models as $model)
        <li>{{ $model->id }} , {{ $model->name }}</li>
    @endforeach
</body>

</html>
