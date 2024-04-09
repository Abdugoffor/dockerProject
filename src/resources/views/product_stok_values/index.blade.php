@extends('../index')

@section('title', 'Стоимость продукта на складе')

@section('con')

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

    <!-- Content area -->
    <div class="content pt-0 mt-5">
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
        <!-- Page length options -->

        <!-- /content area -->
        <div class="card mt-0">
            <div class="card-header">
                <h5 class="card-title">Список Запасы продукции</h5>
            </div>
            <form action="{{ route('product_stok_value.search') }}" method="get">
                <div class="d-flex m-0">
                    @csrf

                    <div class="form-group col-4">
                        <!-- Select All option -->
                        <div class="form-group">
                            <select class="form-control multiselect-select-all" name="ids[]" multiple="multiple"
                                data-fouc>
                                @foreach ($product_stoks as $product_stok)
                                    <option value="{{ $product_stok->id }}">{{ $product_stok->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /select All option -->
                    </div>

                    <div class="form-group col-2">
                        <button type="submit" class="btn btn-primary">Фильтр</button>
                    </div>
                </div>
            </form>

            <div class="form-group">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="20%">Склад Имя</th>
                            <th width="20%">Пользователи склад</th>
                            <th width="25%">Количество</th>
                            <th width="15%">Дата</th>
                            <th>Функция</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $model)
                            <tr>
                                <td>{{ $model->id }}</td>
                                <td>{{ $model->product_stok->name }}</td>
                                <td>{{ $model->model_product->name_size }}</td>
                                <td>{{ $model->value }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $model->created_at->format('H:i , d - M - Y') }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Shaer modal -->
                                    <button type="button" class="btn btn-outline-teal mb-2 ml-2" data-toggle="modal"
                                        data-target="#modal_defaultroleshare{{ $model->id }}"><i
                                            class="icon-share3"></i></button>
                                    <!-- Shaer modal -->
                                    <div id="modal_defaultroleshare{{ $model->id }}" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Список Запасы продукции</h5>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <form
                                                    action="{{ route('product.share', ['product_stok_id' => $model->product_stok_id, 'model_product_id' => $model->model_product_id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="Name">Имя</label>
                                                            <input type="text" name="name" id="Name" disabled
                                                                value="{{ $model->model_product->name_size }}"
                                                                class="form-control" placeholder="Имя">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Value">Количество</label>
                                                            <input type="number" id="Value" required name="value"
                                                                max="{{ $model->value }}" maxlength="{{ $model->value }}"
                                                                class="form-control"
                                                                placeholder="Макс Количество ({{ $model->value }})">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Склад Имя</label>
                                                            <select class="form-control" name="to_id"
                                                                id="exampleFormControlSelect1">
                                                                <option selected="" disabled="">Склад Имя
                                                                </option>
                                                                @foreach ($product_stoks as $product_stok)
                                                                    <option value="{{ $product_stok->id }}">
                                                                        {{ $product_stok->name }}</option>
                                                                @endforeach
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
                                    <!-- /Shaer modal -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /page length options -->
        </div>
        <script>
            $(document).ready(function() {
                $('#material_stok').change(function() {
                    var id = $(this).val();
                    // alert(id);

                    $('#material_stok').find('option').not(':first').remove();
                    $.ajax({
                        url: 'http://127.0.0.1:8000/material_stok/' + id,
                        method: 'get',
                        dataType: 'json', // Corrected the typo here

                        success: function(response) {
                            console.log(response);
                            var len = 0;
                            if (response['data'] != null) { // Corrected the typo here
                                len = response['data'].length; // Corrected the typo here
                            }
                            if (len > 0) {
                                for (let i = 0; i < len; i++) {
                                    console.log(i);
                                    // Access your data using response['data'][i]
                                }
                            }
                        }
                    });
                });
            });
        </script>
        <!-- /content area -->
    @endsection
