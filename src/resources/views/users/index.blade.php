@extends('../index')

@section('title', 'Список пользователей')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить
                пользователяe</button>
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
                        <h5 class="modal-title">Пользователь</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('user.create') }}" method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Name">Имя</label>
                                <input type="text" name="name" id="Name" class="form-control" placeholder="Имя">
                            </div>
                            <div class="mb-3">
                                <label for="Phone">Телефон</label>
                                <input type="tel" name="phone" id="Phone" class="form-control"
                                    placeholder="Телефон">
                            </div>
                            <div class="mb-3">
                                <label for="c_pas">Пароль</label>
                                <input type="password" name="password" id="c_pas" class="form-control"
                                    placeholder="Пароль">
                            </div>
                            <div class="mb-3">
                                <label for="pas">Подтвердите пароль</label>
                                <input type="password" name="c_password" id="pas" class="form-control"
                                    placeholder="Подтвердите пароль">
                            </div>
                            <div class="form-group">
                                <label lang="user">Роли пользователей</label>
                                <select multiple="multiple" name="roles[]" id="user" class="form-control select"
                                    data-fouc>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="per">Разрешения пользователя</label>
                                <select multiple="multiple" id="per" name="permissions[]" class="form-control select"
                                    data-fouc>
                                    <optgroup label="Mountain Time Zone">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name_menyu }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
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
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Роли</th>
                        <th>Разрешения</th>
                        <th>Статус</th>
                        <th class="text-center">Функции</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->phone }}</td>
                            <td>
                                {{-- {{ $model->roles->pluck('name')->implode(', ') }} --}}

                                <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                    data-target="#modal_defaultrole{{ $model->id }}">Роли</button>
                                <!-- Roles modal -->
                                <div id="modal_defaultrole{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Роли</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($model->roles as $role)
                                                    <p>
                                                        <span class="badge badge-secondary">{{ $role->name }}</span>
                                                    </p>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link"
                                                    data-dismiss="modal">Закрывать</button>
                                                <button type="submit" class="btn btn-primary">Сохранять</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Roles modal -->

                            </td>

                            <td>
                                <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                    data-target="#modal_defaultrepmission{{ $model->id }}">Разрешения</button>
                                <!-- Permission modal -->
                                <div id="modal_defaultrepmission{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Разрешения</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($model->permissions as $item)
                                                    <p>
                                                        <span class="badge badge-secondary">{{ $item->name_menyu }}</span>
                                                    </p>
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link"
                                                    data-dismiss="modal">Закрывать</button>
                                                <button type="submit" class="btn btn-primary">Сохранять</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Permission modal -->

                                {{-- <span class="badge badge-success">Active</span> --}}
                            </td>
                            <td>
                                @if ($model->status == 1)
                                    <a href="{{ route('user.status', $model->id) }}" class="badge badge-success">
                                        Активный
                                    </a>
                                @else
                                    <a href="{{ route('user.status', $model->id) }}" class="badge badge-danger">
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
                                                <h5 class="modal-title">Пользовател</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('user.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Имя</label>
                                                        <input type="text" name="name" class="form-control"
                                                            placeholder="Имя" value="{{ $model->name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Телефон</label>
                                                        <input type="tel" name="phone" class="form-control"
                                                            placeholder="Телефон" value="{{ $model->phone }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Пароль</label>
                                                        <input type="password" name="password" class="form-control"
                                                            placeholder="Пароль">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Подтвердите пароль</label>
                                                        <input type="c_password" name="c_password" class="form-control"
                                                            placeholder="Подтвердите пароль">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Роли пользователей</label>
                                                        <select multiple="multiple" name="roles[]"
                                                            class="form-control select" data-fouc>
                                                            {{-- <optgroup label="Tanlang"> --}}
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}"
                                                                    @foreach ($model->roles as $item)
                                                                            {{ $item->name == $role->name ? 'selected' : '' }} @endforeach>
                                                                    {{ $role->name }}</option>
                                                            @endforeach
                                                            {{-- </optgroup> --}}
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Разрешения пользователя</label>
                                                        <select multiple="multiple" name="permissions[]"
                                                            class="form-control select" data-fouc>
                                                            <optgroup label="Разрешения пользователя">
                                                                @foreach ($permissions as $permission)
                                                                    <option value="{{ $permission->name }}"
                                                                        @foreach ($model->permissions as $m_permission)
                                                                            {{ $m_permission->name == $permission->name ? 'selected' : '' }} @endforeach>
                                                                        {{ $permission->name }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрывать</button>
                                                    <button type="submit" class="btn btn-primary">Сохранять</button>
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
                                                <h5 class="modal-title">Пользовател</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('user.delete', $model->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <h2>Вы хотите удалить </h2>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрывать</button>
                                                    <button type="submit" class="btn btn-danger">Сохранять</button>
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
