@extends('../index')

@section('title', 'Список модель продукта')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('product_model.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить модель
                продукта</button>
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
                        <h5 class="modal-title">Модель продукта</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('product_model.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <style>
                                .modal-body span {
                                    position: fixed;
                                    left: ;
                                }
                            </style>
                            <div class="mb-3">
                                <label for="name_size">Имя</label>
                                <input type="text" name="name_size" id="name_size" class="form-control" required
                                    placeholder="Имя">
                            </div>
                            <div class="mb-3">
                                <label for="size">Размер</label>
                                <input type="text" name="size" id="size" class="form-control" required
                                    placeholder="Размер">
                            </div>
                            <div class="mb-3">
                                <label for="price">Цена</label>
                                <input type="text" name="price" id="price" class="form-control" required
                                    placeholder="Цена">
                            </div>
                            <div class="row" id="selectOptions">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="материал">Материал</label>
                                        <select name="data[0]['material_id']" required class="custom-select">
                                            @foreach ($materials as $material)
                                                <option value="{{ $material->id }}">
                                                    {{ $material->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="value1">Количество</label>
                                        <input type="text" id="value1" name="data[0]['value']" required
                                            class="form-control" placeholder="Количество">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <span class="btn btn-info" id="addOptionBtn">Добавить</span>
                            </div>
                            <div class="form-group form-group-float">
                                <label class="d-block form-group-float-label animate">Изображение</label>
                                <div class="custom-file">
                                    <input type="file" name="imgs[]" multiple class="custom-file-input"
                                        id="custom-file-hidden">
                                    <label class="custom-file-label text-muted" for="custom-file-hidden">Изображение</label>
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
                <h5 class="card-title">Список модель продукта</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Размер</th>
                        <th>Цена</th>
                        {{-- <th>Model Structure</th> --}}
                        <th class="text-center">Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->name_size }}</td>
                            <td>{{ $model->size }}</td>
                            <td>{{ $model->price }}</td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('product_model.update'))
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
                                                <h5 class="modal-title">Модель продукта</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('product_model.update', $model->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name_size">Имя</label>
                                                            <input type="text" name="name_size"
                                                                value="{{ $model->name_size }}" class="form-control"
                                                                placeholder="Имя">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="size">Размер</label>
                                                            <input type="text" name="size"
                                                                value="{{ $model->size }}" class="form-control"
                                                                placeholder="Размер">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price">Цена</label>
                                                            <input type="text" name="price" id="price" value="{{ $model->price }}"
                                                                class="form-control" required placeholder="Цена">
                                                        </div>
                                                        @foreach ($model->model_structures as $model_structure)
                                                            <div class="row input-delete">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="материал">Материал</label>
                                                                        <select
                                                                            name="material_ids{{ $model_structure->id }}"
                                                                            required class="custom-select">
                                                                            <option value="{{ $model_structure->id }}">
                                                                                {{ $model_structure->material->name }}
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <div class="form-group">
                                                                        <label for="value1">Количество</label>
                                                                        <input type="text"
                                                                            name="sizes{{ $model_structure->id }}"
                                                                            value="{{ $model_structure->value }}"
                                                                            class="form-control" placeholder="Size">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <div class="form-group">
                                                                        <span
                                                                            class="btn btn-outline-danger mt-4 delete-model-input"
                                                                            data-id="{{ $model_structure->id }}">
                                                                            <i class="icon-cross3"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="row input-delete"
                                                            id="models_structures{{ $model->id }}">

                                                        </div>

                                                        <div class="mb-3">
                                                            <span class="btn btn-info"
                                                                id="addSelect{{ $model->id }}">Добавить</span>
                                                        </div>

                                                        {{-- {{ $model->model_images }} --}}
                                                        <div class="form-group form-group-float">
                                                            <label
                                                                class="d-block form-group-float-label animate">Изображение</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="imgs[]" multiple
                                                                    class="custom-file-input" id="custom-file-hidden">
                                                                <label class="custom-file-label text-muted"
                                                                    for="custom-file-hidden">Изображение</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            @foreach ($model->model_images as $model_image)
                                                                <div class="col-lg-4">
                                                                    <div class="card card-body  text-center">

                                                                        <a href="{{ $model_image->img }}" target="_blank"
                                                                            class="d-inline-block mb-3">
                                                                            <img src="{{ $model_image->img }}"
                                                                                class="rounded-4" width="110"
                                                                                height="110" alt="">
                                                                        </a>

                                                                        <ul class="list-inline mb-0">
                                                                            <li class="list-inline-item">
                                                                                <p class="btn btn-outline-danger btn-icon rounded-pill delete-model-img"
                                                                                    data-id="{{ $model_image->id }}">
                                                                                    <i class="icon-bin"></i>
                                                                                </p>

                                                                            </li>

                                                                        </ul>
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
                                @if (Auth::user()->hasPermissionTo('product_model.delete'))
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
                                                <h5 class="modal-title">Модель продукта</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('product_model.delete', $model->id) }}"
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
    <script type="text/javascript">
        $(document).ready(function() {

            let optionCounter = 2; // Start with 2 or any initial value
            let optionNomer = 1;
            // Button qo'shish
            $('#addOptionBtn').on('click', function() {
                const newSelect = `<div class="col-lg-6">
                                        <div class="form-group">
                                        <label for="материал">Материал</label>
                                            <select name="data[${optionCounter}]['material_id']" class="custom-select">
                                                @foreach ($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                        <label for="value1">Количество</label>
                                            <input type="text" name="data[${optionCounter}]['value']" class="form-control" placeholder="Количество">
                                        </div>
                                    </div>`;

                $('#selectOptions').append(newSelect);

                // Increment the option counter for the next option
                optionCounter++;
            });



            let models = @json($models);
            models.forEach(function(model) {

                // Select option qo'shish
                $('#addSelect' + model.id).on('click', function() {
                    const newSelect = `<div class="col-lg-6">
                                        <div class="form-group">
                                            <select name="material_id${optionNomer}" class="custom-select">
                                                @foreach ($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </div>
    
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="value${optionNomer}" class="form-control" placeholder="Количество">
                                            </div>
                                        </div>`;

                    $('#models_structures' + model.id).append(newSelect);

                    // Increment the option counter for the next option
                    optionNomer++;
                });
            });


            // Image delete
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.delete-model-img', function() {
                let id = $(this).data('id');
                let cart = $(this).closest("div.col-lg-4"); // Top parent <li> element
                console.log(id, cart);
                $.ajax({
                    url: '/product-model-img-delete/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.mes === 'success') {
                            cart.remove();
                        } else {
                            alert('Error: Unexpected response from the server');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + xhr.responseText);
                    }
                });

            });

            // Delete select input
            $(document).on('click', '.delete-model-input', function() {
                let id = $(this).data('id');
                let input = $(this).closest("div.row.input-delete");
                // alert(cart);
                $.ajax({
                    url: '/product-model-input-delete/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // alert(data);
                        if (data.mes == 'success') {
                            input.remove();
                        } else {
                            input.remove();
                            // alert('Error: Unexpected response from the server');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + xhr.responseText);
                        cart.remove();
                    }
                });

            });


        });
    </script>

@endsection
