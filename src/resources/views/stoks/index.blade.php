@extends('../index')

@section('title', 'Список Склад сырья')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('material_stoks.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить
                склад</button>
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
                        <h5 class="modal-title">Склады сырья</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('material_stoks.create') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Имя склада</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Имя склада">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Пользователи склада</label>
                                <select class="form-control" name="user_id" id="exampleFormControlSelect1">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
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
                <h5 class="card-title">Склады сырья</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя склада</th>
                        <th>Пользователи склада</th>
                        <th>Количество</th>
                        <th>Статус</th>
                        <th>Вид</th>
                        <th class="text-center">Функции</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->user->name }}</td>
                            <td>{{ $model->material_stok_values->count() }}</td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('material_stoks.status'))
                                    @if ($model->status == 1)
                                        <a href="{{ route('material_stoks.status', $model->id) }}"
                                            class="badge badge-success">
                                            Активный
                                        </a>
                                    @else
                                        <a href="{{ route('material_stoks.status', $model->id) }}"
                                            class="badge badge-danger">
                                            Приостановленный
                                        </a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('material_stoks.show'))
                                    <a href="{{ route('material_stoks.show', $model->id) }}" class="btn btn-info">Вид</a>
                                @endif
                            </td>
                            <td width='20%' class="">
                                @if (Auth::user()->hasPermissionTo('material_stoks.update'))
                                    <!-- Update modal -->
                                    <button type="button" class="btn btn-outline-teal mb-2 ml-5" data-toggle="modal"
                                        data-target="#modal_defaultroleupdate{{ $model->id }}"><i
                                            class="icon-pencil3"></i></button>
                                @endif
                                <!-- Update modal -->
                                <div id="modal_defaultroleupdate{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Склады сырья</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('material_stoks.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name">Имя</label>
                                                        <input type="text" id="name" name="name"
                                                            value="{{ $model->name }}" class="form-control"
                                                            placeholder="Имя">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Пользователь</label>
                                                        <select class="form-control" name="user_id"
                                                            id="exampleFormControlSelect1">
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}"
                                                                    {{ $model->user_id == $user->id ? 'selected' : '' }}>
                                                                    {{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
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
                                @if (Auth::user()->hasPermissionTo('material_stoks.delete'))
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
                                                <h5 class="modal-title">Склады сырья</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('material_stoks.delete', $model->id) }}"
                                                method="post">
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
