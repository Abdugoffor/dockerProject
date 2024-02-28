<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .sayt {
            width: 300px;
            min-height: 50vh;
            border: 3px solid rgb(20, 49, 179);
            border-radius: 10px;
        }
    </style>
</head>

<body bgcolor="grey">
    <h1>Css style</h1>
    <h1>test1</h1>
    <h1>test 2</h1>
    <h1>test migrate 2</h1>
    <h1>test migrate 3</h1>
    <h1>test migrate 3</h1>
    <h1>test migrate 3</h1>
    <h1>test migrate 3</h1>
    <h1>test migrate 3</h1>
    <h1>test migrate 3</h1>
    <h1>test migrate 3</h1>
    <form action="{{ route('store') }}" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="submit" name="ok">
    </form>
    <div class="sayt">
        @foreach ($models as $model)
            <li>{{ $model->id }} , {{ $model->name }}</li>
        @endforeach
    </div>
</body>

</html>
