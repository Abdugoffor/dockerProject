@extends('../index')

@section('title', 'Склад продукции')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('product_stoks.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Создать cклад
            </button>
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
                        <h5 class="modal-title">Продукт склад</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('product_stoks.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="Count">Имя</label>
                                    <input type="text" name="name" step="any" id="Count" class="form-control"
                                        required placeholder="Имя">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Пользователи</label>
                                <select class="form-control" name="user_id" required id="exampleFormControlSelect1">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
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
                <h5 class="card-title">Склад продукции</h5>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Склад Имя</th>
                        <th>Пользователи склад</th>
                        <th>Посмотреть</th>
                        <th>Статус</th>
                        <th class="text-center">Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->user->name }}</td>
                            <td>
                                <!-- View modal -->
                                <button type="button" class="btn btn-outline-teal mb-2 ml-5" data-toggle="modal"
                                    data-target="#model_view{{ $model->id }}">Посмотреть</button>
                                <!-- View modal -->
                                <div id="model_view{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Склад продукции</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>Имя</th>
                                                        <th>Количество</th>
                                                    </thead>
                                                    <tbody>
                                                        @if ($model->product_stok_values->count() > 0)
                                                            @foreach ($model->product_stok_values as $product_stok_value)
                                                                <tr>
                                                                    <td>{{ $product_stok_value->id }}</td>
                                                                    <td>{{ $product_stok_value->model_product->name_size }}
                                                                    </td>
                                                                    <td>{{ $product_stok_value->value }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-center">Нет в наличии</td>
                                                            </tr>
                                                        @endif

                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"
                                                    data-dismiss="modal">Закрывать</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /View modal -->
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('product_stoks.status'))
                                    @if ($model->status == 1)
                                        <a href="{{ route('product_stoks.status', $model->id) }}"
                                            class="badge badge-success">
                                            активный
                                        </a>
                                    @else
                                        <a href="{{ route('product_stoks.status', $model->id) }}"
                                            class="badge badge-danger">
                                            нет активного
                                        </a>
                                    @endif
                                @endif
                            </td>
                            <td width='20%' class="">
                                @if (Auth::user()->hasPermissionTo('product_stoks.update'))
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
                                                <h5 class="modal-title">Продукт склад</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('product_stoks.update', $model->id) }}" method="post">
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
                                                        <label for="exampleFormControlSelect1">Пользователи</label>
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
                                @if (Auth::user()->hasPermissionTo('product_stoks.delete'))
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
                                                <h5 class="modal-title">Продукт склад</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('product_stoks.delete', $model->id) }}"
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
@endsection
