<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="text-white bg-dark">
    <div class="">
        <form action="{{ route('stabels', ['sana' => $sana]) }}" method="post">
            @csrf
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="150px">FIO</th>
                        @for ($i = 1; $i <= $numberOfDays; $i++)
                            <th width="50px">{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                @foreach ($stafs as $staf)
                    <tr>
                        <th><b>{{ $staf->name }}</b></th>
                        @for ($k = 1; $k <= $numberOfDays; $k++)
                            <td class="text-center">
                                <input type="checkbox" name="tabels[]" value="{{ $staf->id }},{{ $k }}"
                                    class="btn-check" id="btncheck{{ $k }}{{ $staf->id }}"
                                    autocomplete="off">
                                <label class="btn btn-outline-primary"
                                    for="btncheck{{ $k }}{{ $staf->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                        fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                        <path
                                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                </label>
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </table>
            <input type="number" class="form-control" name="stavka" placeholder="Stavka">
            <input type="submit" class="btn btn-info mt-3" name="ok" id="">

        </form>

    </div>
</body>

</html>
