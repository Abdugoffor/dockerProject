@extends('../index')

@section('title', 'Список сотрудников')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('staf.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить
                Сотрудник</button>
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
                        <h5 class="modal-title">Список Сотрудник</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('staf.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Имя</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Имя">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone">Телефон</label>
                                        <input type="tel" name="phone" id="phone" class="form-control"
                                            placeholder="+998 00 000 00 00">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="adres">Адрес</label>
                                <input type="text" name="adres" id="adres" class="form-control"
                                    placeholder="Адрес">
                            </div>

                            <div class="form-group form-group-float">
                                <label class="d-block form-group-float-label animate">Изображение</label>
                                <div class="custom-file">
                                    <input type="file" name="img" class="custom-file-input" id="custom-file-hidden">
                                    <label class="custom-file-label text-muted" for="custom-file-hidden">Изображение</label>
                                </div>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="d-block form-group-float-label animate">Файл</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="custom-file-hidden">
                                    <label class="custom-file-label text-muted" for="custom-file-hidden">Файл</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Отделы</label>
                                        <select class="form-control" name="department_id" id="exampleFormControlSelect1">
                                            <option selected disabled>Отделы</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Тип зарплаты</label>
                                        <select class="form-control" name="salary__type_id" id="exampleFormControlSelect1">
                                            <option selected disabled>Тип зарплаты</option>
                                            @foreach ($salarys as $salary)
                                                <option value="{{ $salary->id }}">{{ $salary->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="time">Рабочее время</label>
                                        <input type="number" id="time" name="working_time" class="form-control"
                                            placeholder="Рабочее время">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="sum">Зарплата</label>
                                        <input type="number" id="sum" name="sum" class="form-control"
                                            placeholder="Зарплата">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="text">Описание</label>
                                    <textarea name="text" id="text" class="form-control" placeholder="Описание"></textarea>
                                </div>
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
                <h5 class="card-title">Список Сотрудник</h5>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th width='15%'>Телефон</th>
                        <th width='15%'>Изображение</th>
                        <th>Зарплата</th>
                        {{-- <th>Добавить станок</th> --}}
                        <th width='20%'>Отделение</th>
                        <th>Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->phone }}</td>
                            <td><img src="{{ $model->img }}" width="100px" alt=""></td>
                            <td>{{ number_format($model->sum, 2, '.', ' ') }}</td>
                            {{-- <td>
                                <a href="{{ route('staf.show', $model->id) }}" class="btn btn-info">Добавить станок</a>
                            </td> --}}
                            <td>{{ $model->department->name }}</td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('staf.view'))
                                    <!-- View modal -->
                                    <a href="{{ route('staf.view', ['staf' => $model->id]) }}"
                                        class="btn btn-outline-teal mb-2"><i class="icon-file-text2"></i></a>
                                    <!-- /View modal -->
                                @endif

                                @if (Auth::user()->hasPermissionTo('staf.update'))
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
                                                <h5 class="modal-title">Список Сотрудник</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('staf.update', $model->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="name">Имя</label>
                                                                <input type="text" id="name" name="name"
                                                                    value="{{ $model->name }}" class="form-control"
                                                                    placeholder="Имя">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="phone">Телефон</label>
                                                                <input type="tel" id="phone" name="phone"
                                                                    value="{{ $model->phone }}" class="form-control"
                                                                    placeholder="+998 00 000 00 00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adres">Адрес</label>
                                                        <input type="text" name="adres" id="adres"
                                                            value="{{ $model->adres }}" class="form-control"
                                                            placeholder="Адрес">
                                                    </div>

                                                    <div class="form-group form-group-float">
                                                        <label
                                                            class="d-block form-group-float-label animate">Изображение</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="img"
                                                                value="{{ $model->img }}" class="custom-file-input"
                                                                id="custom-file-hidden">
                                                            <label class="custom-file-label text-muted"
                                                                for="custom-file-hidden">Изображение</label>
                                                        </div>
                                                        <img src="{{ $model->img }}" width="100px" class="mt-2"
                                                            alt="">
                                                    </div>
                                                    <div class="form-group form-group-float">
                                                        <label class="d-block form-group-float-label animate">Файл</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="file"
                                                                value="{{ $model->file }}" class="custom-file-input"
                                                                id="custom-file-hidden">
                                                            <label class="custom-file-label text-muted"
                                                                for="custom-file-hidden">Файл</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Отделы</label>
                                                                <select class="form-control" name="department_id"
                                                                    id="exampleFormControlSelect1">
                                                                    <option selected disabled>Отделы</option>
                                                                    @foreach ($departments as $department)
                                                                        <option value="{{ $department->id }}"
                                                                            {{ $model->department_id == $department->id ? 'selected' : '' }}>
                                                                            {{ $department->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Тип
                                                                    зарплатыe</label>
                                                                <select class="form-control" name="salary__type_id"
                                                                    id="exampleFormControlSelect1">
                                                                    <option selected disabled>Тип зарплаты</option>
                                                                    @foreach ($salarys as $salary)
                                                                        <option value="{{ $salary->id }}"
                                                                            {{ $model->salary__type_id == $salary->id ? 'selected' : '' }}>
                                                                            {{ $salary->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="time">Рабочее время</label>
                                                                <input type="number" name="working_time"
                                                                    value="{{ $model->working_time }}"
                                                                    class="form-control" placeholder="Рабочее время">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="sum">Зарплата</label>
                                                                <input type="number" name="sum"
                                                                    value="{{ $model->sum }}" class="form-control"
                                                                    placeholder="Зарплата">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="text">Описание</label>
                                                            <textarea name="text" id="text" class="form-control" rows="5" placeholder="Описание">{{ $model->text }}</textarea>
                                                        </div>
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

                                @if (Auth::user()->hasPermissionTo('staf.delete'))
                                    <!-- Delete modal -->
                                    <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal"
                                        data-target="#modal_defaultroledelete{{ $model->id }}"><i
                                            class="icon-bin"></i></button>
                                @endif
                                <!-- Delete modal -->
                                <div id="modal_defaultroledelete{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Список Сотрудник</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('staf.delete', $model->id) }}" method="post">
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
