@extends('../index')

@section('title', 'Список Табел')

@section('con')
    <!-- Content area -->
    <style>
        input[type="date"] {
            padding: 8px;
            font-size: 16px;
        }
    </style>
    <div class="content pt-0 mt-5">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert bg-danger alert-rounded alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">{{ $error }}</span>
                </div>
            @endforeach
        @endif
        @if (session('text'))
            <div class="alert bg-teal alert-rounded alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">{{ session('text') }}</span>
            </div>
        @endif
        <!-- Page length options -->
        <div class="card mt-3 overflow-auto">
            <div class="card-header">
                <h3 class="card-title">Табел , Дата : {{ $now->format('M - Y') }}</h3>
            </div>
            @if (Auth::user()->hasPermissionTo('tabels.date'))
                <form action="{{ route('tabels.date') }}" method="get">
                    @csrf
                    <div class="d-flex m-0">
                        <div class="col-2">
                            <!-- Select All option -->
                            <div class="form-group">
                                <input type="date" id="ot" name="date" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-primary">Фильтр</button>
                        </div>
                    </div>
                </form>
            @endif

            <!-- Update modal -->
            <div id="model_tabel_update" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="updateTable" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Склады сырья</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="how_many1">Час</label>
                                    <input type="text" name="how_many" id="how_many1" required placeholder="Введите час"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="stavka1">Ставка</label>
                                    <input type="text" name="stavka" id="stavka1" required
                                        placeholder="Введите ставка" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Закрывать</button>
                                <button type="submit" class="btn btn-primary">Обновлять</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Update -->
            <form action="{{ route('tabels.store') }}" method="post">
                @csrf
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="150px">ФИО</th>
                            @for ($i = 1; $i <= $now->daysInMonth; $i++)
                                <th width="50px" class=""><label
                                        for="data{{ $i }}">{{ $i }}</label></th>
                            @endfor
                            <th>Все</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stafs as $staf)
                            <tr>
                                <th><b>{{ $staf->name }}</b></th>
                                @for ($k = 1; $k <= $now->daysInMonth; $k++)
                                    <td class="">

                                        @php
                                            $check = false;
                                        @endphp

                                        @foreach ($staf->dateTabels as $dateTabel)
                                            @if (\Carbon\Carbon::parse($dateTabel->date)->format('d') == $k)
                                                <a href="#" class="badge badge-primary clickButton"
                                                    data-toggle="modal" data-target="#model_tabel_update"
                                                    data-id="{{ $dateTabel->id }}"
                                                    data-how-many="{{ $dateTabel->how_many }}"
                                                    data-stavka="{{ $dateTabel->stavka }}"
                                                    style="font-size: 13pt;">{{ $dateTabel->clock }}</a>

                                                @php
                                                    $check = true;

                                                @endphp
                                            @endif
                                        @endforeach

                                        @if (!$check)
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="tabels[]"
                                                    value="{{ $staf->id }},{{ $now->copy()->day($k)->toDateString() }}"
                                                    class="custom-control-input"
                                                    id="cc_ls_u{{ $staf->id }},{{ $k }}">
                                                <label class="custom-control-label"
                                                    for="cc_ls_u{{ $staf->id }},{{ $k }}"> </label>
                                            </div>
                                        @endif
                                    </td>
                                @endfor
                                <th><span class="badge badge-success">{{ $staf->dateTabels->sum('clock') }}</span></th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (Auth::user()->hasPermissionTo('tabels.store'))
                    <div class="d-flex m-0 mt-3">
                        <div class="col-2">
                            <!-- Select All option -->
                            <div class="form-group">
                                <label for="how_many">Час</label>
                                <input type="text" name="how_many" id="how_many" required placeholder="Введите час"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label for="stavka">Ставка</label>
                                <input type="text" name="stavka" id="stavka" required placeholder="Введите ставка"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-2 mt-4">
                            <button type="submit" class="btn btn-primary">Сохранять</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
        <!-- /page length options -->
    </div>
    <script>
        $(document).ready(function() {
            $('.clickButton').click(function() {
                let id = $(this).data('id');
                let howMany = $(this).data('how-many');
                let stavka = $(this).data('stavka');
                console.log(id, howMany, stavka);
                myFunction(id, howMany, stavka);
                console.log(123);
            });

            function myFunction(id, howMany, clock) {
                $('#how_many1').val(howMany);
                $('#stavka1').val(clock);
                $('#updateTable').attr('action', '{{ route('tabels.update', '') }}/' + id);
            }
        });
    </script>
@endsection
