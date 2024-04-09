@extends('../index')

@section('title', 'Список Фирмы')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить
                Фирма</button>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert bg-danger alert-rounded alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">{{ $error }}!</span>
                </div>
            @endforeach
        @endif
        @if (session('text'))
            <div class="alert bg-teal alert-rounded alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">{{ session('text') }}!</span>
            </div>
        @endif

        <!-- Basic modal -->
        <div id="modal_default" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Фирмы</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('firm.create', $customer->id) }}" method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Фирма Имя</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Фирма Имя">
                            </div>
                            <div class="mb-3">
                                <label for="p1">Телефон 1</label>
                                <input type="tel" id="p1" name="prone1" class="form-control"
                                    placeholder="+998 00 000 00 00">
                            </div>
                            <div class="mb-3">
                                <label for="p2">Телефон 2</label>
                                <input type="tel" id="p2" name="prone2" class="form-control"
                                    placeholder="+998 00 000 00 00">
                            </div>
                            <div class="mb-3">
                                <label for="lt">Локации</label>
                                <input type="text" id="lt" name="long" class="form-control"
                                    placeholder="Локации">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Закрывать</button>
                            <button type="submit" class="btn btn-primary">Сохранять</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /basic modal -->

        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Фирмы</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Телефон 1</th>
                        <th>Телефон 2</th>
                        <th>Локации</th>
                        <th>Статус</th>
                        <th class="text-center">Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->prone1 }}</td>
                            <td>{{ $model->prone2 }}</td>
                            <td>
                                @if (($model->long != 0) & ($model->lang != 0))
                                    <a href="https://www.google.com/maps?q={{ $model->long }},{{ $model->lang }}"
                                        target="_blank">Location</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($model->status == 1)
                                    <a href="{{ route('firm.status', $model->id) }}" class="badge badge-success">
                                        Активный
                                    </a>
                                @else
                                    <a href="{{ route('firm.status', $model->id) }}" class="badge badge-danger">
                                        Приостановленный
                                    </a>
                                @endif
                            </td>
                            <td>
                                <!-- Update modal -->
                                <button type="button" class="btn btn-outline-teal mb-2" data-toggle="modal"
                                    data-target="#modal_defaultroleupdate{{ $model->id }}"><i
                                        class="icon-pencil3"></i></button>
                                <!-- Update modal -->
                                <div id="modal_defaultroleupdate{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Фирма</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('firm.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name">Фирма Имя</label>
                                                        <input type="text" id="name" name="name"
                                                            value="{{ $model->name }}" class="form-control"
                                                            placeholder="Firms Name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="p1">Телефон 1</label>
                                                        <input type="tel" id="p1" name="prone1"
                                                            value="{{ $model->prone1 }}" class="form-control"
                                                            placeholder="+998 00 000 00 00">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="p2">Телефон 2</label>
                                                        <input type="tel" id="p2" name="prone2"
                                                            value="{{ $model->prone2 }}" class="form-control"
                                                            placeholder="+998 00 000 00 00">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="lt">Локации</label>
                                                        <input type="text" name="long"
                                                            value="{{ $model->long }}, {{ $model->lang }}"
                                                            class="form-control" placeholder="Long Lat">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрывать</button>
                                                    <button type="submit" class="btn btn-primary">Обновлять</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Update modal -->

                                <!-- Delete modal -->
                                <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal"
                                    data-target="#modal_defaultroledelete{{ $model->id }}"><i
                                        class="icon-bin"></i></button>
                                <!-- Delete modal -->
                                <div id="modal_defaultroledelete{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Фирма</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('firm.delete', $model->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <h2>Вы хотите удалить</h2>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрывать</button>
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Delete modal -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
