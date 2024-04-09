@extends('../index')

@section('title', 'Список ролей')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('role.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить
                Роли</button>
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
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Пользователь</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('role.create') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Name">Имя Роли</label>
                                <input type="text" name="name" id="Name" class="form-control" placeholder="Имя">
                            </div>
                            <div class="form-group">
                                <h3>Разрешения ролей</h3>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-3">

                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" value="{{ $permission->id }}" name="permissions[]"
                                                    class="custom-control-input" id="role{{ $permission->id }}">
                                                <label class="custom-control-label"
                                                    for="role{{ $permission->id }}">{{ $permission->id }} ,
                                                    {{ $permission->name_menyu }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
                <h5 class="card-title">Пользователя</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя Роли</th>
                        <th>Количество разрешения</th>
                        <th class="text-center">Функции</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>
                                <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                    data-target="#model_view{{ $model->id }}">{{ $model->permissions->count() }}</button>
                                <!-- Basic modal -->
                                <div id="model_view{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $model->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    @foreach ($model->permissions as $permission)
                                                        <div class="col-3">
                                                            <span>{{ $permission->id }} ,
                                                                {{ $permission->name_menyu }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link"
                                                    data-dismiss="modal">Закрывать</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('role.update'))
                                    <!-- Update modal -->
                                    <button type="button" class="btn btn-outline-teal mb-2" data-toggle="modal"
                                        data-target="#modal_defaultroleupdate{{ $model->id }}"><i
                                            class="icon-pencil3"></i></button>
                                @endif
                                <!-- Update modal -->
                                <div id="modal_defaultroleupdate{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $model->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('role.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Имя</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Имя" value="{{ $model->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <h3>Разрешения ролей</h3>
                                                        <div class="row">
                                                            @foreach ($permissions as $permission)
                                                                <div class="col-3">

                                                                    <div class="custom-control custom-checkbox mb-2">
                                                                        <input type="checkbox"
                                                                            @foreach ($model->permissions as $m_permission)
                                                                        {{ $m_permission->name == $permission->name ? 'checked' : '' }} @endforeach
                                                                            value="{{ $permission->id }}"
                                                                            name="permissions[]"
                                                                            class="custom-control-input"
                                                                            id="roleupdate{{ $permission->id }}{{ $model->id }}">

                                                                        <label class="custom-control-label"
                                                                            for="roleupdate{{ $permission->id }}{{ $model->id }}">{{ $permission->id }}
                                                                            ,
                                                                            {{ $permission->name_menyu }}</label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
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

                                @if (Auth::user()->hasPermissionTo('role.delete'))
                                    @if (!in_array($model->id, [1, 2, 3, 4, 5, 6, 7, 8]))
                                        <!-- Delete modal -->
                                        <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal"
                                            data-target="#modal_defaultroleDelete{{ $model->id }}"><i
                                                class="icon-bin"></i></button>
                                        <!-- Delete modal -->
                                        <div id="modal_defaultroleDelete{{ $model->id }}" class="modal fade"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $model->name }}</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form action="{{ route('role.delete', $model->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
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
                                    @endif
                                @endif
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
