@extends('../index')

@section('title', 'Список накладной')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('prixod.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                data-target="#modal_defaultexcel">Импортировать накладных в Exel</button>
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить накладных</button>
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
        <div id="modal_defaultexcel" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавить накладной</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('prixod.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group form-group-float">
                                <label class="d-block form-group-float-label animate">Файл Excel</label>
                                <div class="custom-file">
                                    <input type="file" name="file" multiple class="custom-file-input"
                                        id="custom-file-hidden">
                                    <label class="custom-file-label text-muted" for="custom-file-hidden">Файл Excel</label>
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

        <!-- Basic modal -->
        <div id="modal_default" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавить накладной</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('nakladnoy.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name">Грузоотправитель</label>
                                        <input type="text" name="shipper" id="name" class="form-control"
                                            placeholder="Грузоотправитель" required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name">Грузополучатель</label>
                                        <input type="text" name="consignee" id="name" class="form-control"
                                            placeholder="Грузополучатель" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Основание для отпуска: Договор № </label>
                                        <input type="text" name="nomer" id="name" class="form-control"
                                            placeholder="Договор №" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Отпустил</label>
                                        <input type="text" name="sender" id="name" class="form-control"
                                            placeholder="Отпустил" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Получил</label>
                                        <input type="text" name="recipient" id="name" class="form-control"
                                            placeholder="Получил" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Дата</label>
                                        <input type="date" name="date" id="name" class="form-control"
                                            placeholder="Дата" required>
                                    </div>
                                </div>
                            </div>

                            <h1>Введите материал</h1>

                            <div class="row mt-3">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name0">Имя</label>
                                        <select name="materials[0]['name']" id="name0"
                                            class="form-control select-multiple-tags" multiple="multiple" data-fouc>
                                            @foreach ($materials as $material)
                                                <option value="{{ $material }}">
                                                    {{ $material }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="unit1">Ед. изм.</label>
                                        <input type="text" name="materials[0]['unit']" id="unit1"
                                            class="form-control" placeholder="Ед. изм." required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="quantity1">Количество</label>
                                        <input type="text" name="materials[0]['quantity']" id="quantity1"
                                            class="form-control" placeholder="Количество" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="price1">Цена, за единицу</label>
                                        <input type="text" name="materials[0]['price']" id="price1"
                                            class="form-control" placeholder="Цена, за единицу" required>
                                    </div>
                                </div>
                                {{-- <div class="col-2">
                                    <div class="form-group">
                                        <label for="sum1">Сумма,</label>
                                        <input type="text" name="materials[0]['sum']" id="sum1"
                                            class="form-control" placeholder="Сумма," required>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-2">
                                    <div class="form-group">
                                        <label for="term1">Срок годности</label>
                                        <input type="date" name="materials[0]['term']" id="term1"
                                            class="form-control" placeholder="Срок годности" required>
                                    </div>
                                </div> --}}
                            </div>
                            <div id="newRow"></div>
                            <a href="#" class="btn btn-info" id="addModel">Добавить</a>
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
                <h5 class="card-title">Список накладных</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Грузоотправитель</th>
                        <th>Грузополучатель</th>
                        <th>Основания для отпуска</th>
                        <th>Дата</th>
                        <th>Отпустил</th>
                        <th>Получил</th>
                        <th>Количество сырьё</th>
                        <th>Функции</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->shipper }}</td>
                            <td>{{ $model->consignee }}</td>
                            <td>{{ $model->nomer }}</td>
                            <td>{{ $model->date }}</td>
                            <td>{{ $model->sender }}</td>
                            <td>{{ $model->recipient }}</td>
                            <td>{{ $model->prixods->count() }}</td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('nakladnoy.view'))
                                    <a href="{{ route('nakladnoy.view', $model->id) }}"
                                        class="btn btn-outline-info mb-2">
                                        <i class="icon-file-text2"></i>
                                    </a>
                                @endif
                                <!-- Update modal -->
                                {{-- <button type="button" class="btn btn-outline-teal mb-2" data-toggle="modal"
                                    data-target="#modal_defaultroleupdate{{ $model->id }}"><i
                                        class="icon-pencil3"></i></button> --}}
                                <!-- Update modal -->
                                <div id="modal_defaultroleupdate{{ $model->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Список накладной</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('prixod.update', $model->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <input type="text" name="name" value="{{ $model->name }}"
                                                            class="form-control" placeholder="Mame">
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

                                @if (Auth::user()->hasPermissionTo('prixod.delete'))
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
                                                <h5 class="modal-title">Список накладной</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('prixod.delete', $model->id) }}" method="post">
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
    <script>
        $(document).ready(function() {
            let optionCounter = 1
            $('#addModel').on('click', function() {

                const newSelect = `<div class="row mt-3" id="deleteRow${optionCounter}">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="name${optionCounter}">Имя</label>
                                        <select name="materials[${optionCounter}]['name']" id="name${optionCounter}"
                                            class="form-control select-multiple-tags" multiple="multiple" data-fouc>
                                            @foreach ($materials as $material)
                                                <option value="{{ $material }}">
                                                    {{ $material }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="unit${optionCounter}">Ед. из.</label>
                                        <input type="text" name="materials[${optionCounter}]['unit']" id="unit${optionCounter}" class="form-control" placeholder="Ед. изм." required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="quantity${optionCounter}">Количеств</label>
                                        <input type="text" name="materials[${optionCounter}]['quantity']" id="quantity1" class="form-control" placeholder="Количество" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="price${optionCounter}">Цена, за единицу</label>
                                        <input type="text" name="materials[${optionCounter}]['price']" id="price${optionCounter}" class="form-control" placeholder="Цена, за единицу" required>
                                    </div>
                                </div>
                                
                                <div class="col-1">
                                    <div class="form-group mt-4">
                                        <span class="btn btn-outline-danger delete-row" data-row="${optionCounter}">X</span>
                                    </div>
                                </div>
                            </div>`;

                $('#newRow').append(newSelect);

                $('.select-multiple-tags').select2({
                    tags: true
                });

                optionCounter++;
            });
            $('#newRow').on('click', '.delete-row', function() {
                const rowId = $(this).data('row');
                console.log(rowId);
                // console.log($(`#deleteRow${rowId}`));
                $('#deleteRow' + rowId).remove();

            });
        });

        // <div class="col-2">
        //     <div class="form-group">
        //         <label for="sum${optionCounter}">Сумма,</label>
        //         <input type="text" name="materials[${optionCounter}]['sum']" id="sum${optionCounter}" class="form-control" placeholder="Сумма," required>
        //     </div>
        // </div>
    </script>
@endsection
