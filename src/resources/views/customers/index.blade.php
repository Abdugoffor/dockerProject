@extends('../index')

@section('title', 'Список клиентов')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить клиента</button>
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
                        <h5 class="modal-title">Клиента</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('customer.create') }}" method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Имя</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Имя">
                            </div>
                            <div class="mb-3">
                                <label for="phone1">Телефон 1</label>
                                <input type="tel" name="phone1" id="phone1" class="form-control" placeholder="+998 00 000 00 00">
                            </div>
                            <div class="mb-3">
                                <label for="phone2">Телефон 2</label>
                                <input type="tel" name="phone2" id="phone2" class="form-control" placeholder="+998 00 000 00 00">
                            </div>
                            <div class="mb-3">
                                <label for="balans">Лимит</label>
                                <input type="number" name="balans" id="balans" class="form-control" placeholder="Лимит">
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
                <h5 class="card-title">Клиенты</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Телефон 1</th>
                        <th>Телефон 2</th>
                        <th>Лимит</th>
                        <th>Фирмы</th>
                        <th>Статус</th>
                        <th class="text-center">Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->phone1 }}</td>
                            <td>{{ $model->phone2 }}</td>
                            <td>{{ $model->balans }}</td>
                            <td><a href="{{ route('customer.show', $model->id) }}" class="btn btn-info">Фирмы</a></td>
                            <td>
                                @if ($model->status == 1)
                                    <a href="{{ route('customer.status', $model->id) }}" class="badge badge-success">
                                        Активный
                                    </a>
                                @else
                                    <a href="{{ route('customer.status', $model->id) }}" class="badge badge-danger">
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
                                                <h5 class="modal-title">Клиента</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('customer.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name">Имя</label>
                                                        <input type="text" name="name" id="name" value="{{ $model->name }}"
                                                            class="form-control" placeholder="Имя">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone1">Телефон 1</label>
                                                        <input type="tel" id="phone1" name="phone1" value="{{ $model->phone1 }}"
                                                            class="form-control" placeholder="+998 00 000 00 00">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="phone2">Телефон 2</label>
                                                        <input type="tel" id="phone2" name="phone2" value="{{ $model->phone2 }}"
                                                            class="form-control" placeholder="+998 00 000 00 00">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="balans">Лимит</label>
                                                        <input type="tel" id="balans" name="balans"
                                                            value="{{ $model->balans }}" class="form-control"
                                                            placeholder="Лимит">
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
                                                <h5 class="modal-title">Клиента</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('customer.delete', $model->id) }}" method="post">
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
