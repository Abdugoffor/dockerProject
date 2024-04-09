@extends('../index')

@section('title', 'Список курьеров')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('courier.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить
                курьеров</button>
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
                <span class="font-weight-semibold">{{ session('text') }}</span>
            </div>
        @endif

        <!-- Basic modal -->
        <div id="modal_default" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Курьер</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('courier.create') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Сотрудников</label>
                                <select class="form-control" name="staf_id" id="exampleFormControlSelect1">
                                    <option disabled selected>-- Сотрудников --</option>
                                    @foreach ($stafs as $staf)
                                        <option value="{{ $staf->id }}">
                                            {{ $staf->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phone">Телефон</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="+998 00 000 00 00">
                            </div>
                            <div class="mb-3">
                                <label for="car_number">Номер машины 60A111AA</label>
                                <input type="text" name="car_number" id="car_number" class="form-control"
                                    placeholder="Номер машины 60A111AA">
                            </div>
                            <div class="mb-3">
                                <label for="car_number">ID номер телеграма 9 - число</label>
                                <input type="number" name="telegram_id" id="telegram_id" class="form-control"
                                    placeholder="ID номер телеграма">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /basic modal -->

        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Курьеры</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Номер машины</th>
                        <th>ID номер телеграма</th>
                        <th>Статус</th>
                        <th class="text-center">Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->staf->name }}</td>
                            <td><a href="tel:+{{ $model->phone }}">{{ $model->phone }}</a>
                            </td>
                            <td>{{ $model->car_number }}</td>
                            <td>{{ $model->telegram_id }}</td>
                            <td>
                                {{-- @if (Auth::user()->hasPermissionTo('courier.status')) --}}
                                    @if ($model->status == 1)
                                        <a href="{{ route('courier.status', $model->id) }}" class="badge badge-success">
                                            Активный
                                        </a>
                                    @else
                                        <a href="{{ route('courier.status', $model->id) }}" class="badge badge-danger">
                                            Приостановленный
                                        </a>
                                    @endif
                                {{-- @endif --}}
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('courier.show'))
                                    {{-- View --}}
                                    <a href="{{ route('courier.show', $model->id) }}" class="btn btn-outline-teal mb-2"><i
                                            class="icon-file-text2"></i></a>
                                    {{-- View --}}
                                @endif

                                @if (Auth::user()->hasPermissionTo('courier.update'))
                                    <!-- Update modal -->
                                    <button type="button" class="btn btn-outline-teal mb-2" data-toggle="modal"
                                        data-target="#modal_defaultroleupdate{{ $model->id }}"><i
                                            class="icon-pencil3"></i></button>
                                @endif
                                <!-- Update modal -->
                                <div id="modal_defaultroleupdate{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Курьер</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('courier.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Сотрудников</label>
                                                        <select class="form-control" name="staf_id"
                                                            id="exampleFormControlSelect1">
                                                            <option>-- Сотрудников --</option>
                                                            @foreach ($stafs as $staf)
                                                                <option value="{{ $staf->id }}"
                                                                    {{ $staf->id == $model->staf_id ? 'selected' : '' }}>
                                                                    {{ $staf->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone">Телефон</label>
                                                        <input type="text" value="{{ $model->phone }}" name="phone"
                                                            id="phone" class="form-control"
                                                            placeholder="+998 00 000 00 00">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="car_number">Номер машины</label>
                                                        <input type="number" value="{{ $model->car_number }}"
                                                            name="car_number" id="car_number" class="form-control"
                                                            placeholder="Номер машины">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="car_number">ID номер телеграма</label>
                                                        <input type="number" value="{{ $model->telegram_id }}"
                                                            name="telegram_id" id="telegram_id" class="form-control"
                                                            placeholder="ID номер телеграма">
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-primary">Обновлять</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Update modal -->

                                @if (Auth::user()->hasPermissionTo('courier.delete'))
                                    <!-- Delete modal -->
                                    <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal"
                                        data-target="#modal_defaultroledelete{{ $model->id }}"><i
                                            class="icon-bin"></i></button>
                                    <!-- Delete modal -->
                                @endif
                                <div id="modal_defaultroledelete{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Курьер</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('courier.delete', $model->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <h2>Хотите удалить</h2>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрыть</button>
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
