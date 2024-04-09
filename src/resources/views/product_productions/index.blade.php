@extends('../index')

@section('title', 'Производство продукции')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('product_production.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Производство
                продукции</button>
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
                        <h5 class="modal-title">Производство продукции</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('product_production.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Модель продукта</label>
                                <select class="form-control" name="model_product_id" required
                                    id="exampleFormControlSelect1">
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->name_size }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_stok">Склад продукции</label>
                                <select name="product_stok_id" id="product_stok" required class="custom-select">
                                    @foreach ($product_stoks as $product_stok)
                                        <option value="{{ $product_stok->id }}">
                                            {{ $product_stok->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="stanok">Станок 1</label>
                                        <select name="equipment1" id="stanok" required class="custom-select">
                                            @foreach ($equipments as $equipment)
                                                <option value="{{ $equipment->id }}">
                                                    {{ $equipment->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="user">Пользователь 1</label>
                                        <select name="user1" id="user" required class="custom-select">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="selectOptions"></div>
                            <div class="row">
                                <div class="col-12">
                                    <span class="btn btn-info mb-3" id="addOptionBtn">Добавлять</span>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="Count">Количество</label>
                                        <input type="number" name="count" step="any" id="Count"
                                            class="form-control" required placeholder="Количество">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="lose">Потерянные</label>
                                        <input type="number" name="lose" step="any" id="lose"
                                            class="form-control" required placeholder="Потерять">
                                    </div>
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
                <h5 class="card-title">Список произведенных продукции</h5>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название модели</th>
                        <th>Название склада</th>
                        <th>Пользователи Станок</th>
                        <th>Количество</th>
                        <th>Произведено</th>
                        <th>Брак</th>
                        <th>Потеря</th>
                        <th>Статус</th>
                        {{-- <th class="text-center">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modelsOrders as $modelsOrder)
                        @if (($modelsOrder->defective / $modelsOrder->count) * 100 > $modelsOrder->lose)
                            @php
                                $row = 'badge badge-danger';
                            @endphp
                        @else
                            @php
                                $row = 'badge badge-primary';
                            @endphp
                        @endif
                        <tr>
                            <td>{{ $modelsOrder->id }}</td>
                            <td>
                                <a href="#" class="" data-toggle="modal"
                                    data-target="#images_product{{ $modelsOrder->id }}">
                                    {{ $modelsOrder->model_product->name_size }}
                                </a>

                                <!-- Images Product modal -->
                                <div id="images_product{{ $modelsOrder->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Название модели</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table mb-3">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Название модели</th>
                                                            <th>Размер</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $modelsOrder->model_product->id }}</td>
                                                            <td>{{ $modelsOrder->model_product->name_size }}</td>
                                                            <td>{{ $modelsOrder->model_product->size }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    @foreach ($modelsOrder->model_product->model_images as $model_image)
                                                        <div class="col-lg-4">
                                                            <div class="card card-body text-center">
                                                                <a href="{{ $model_image->img }}" target="_blank">
                                                                    <img src="{{ $model_image->img }}" class="rounded-4"
                                                                        width="120" height="120" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Закрыть</button>
                                                {{-- <button type="submit" class="btn btn-primary">Сохранять</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  Images Product modal -->
                            </td>
                            <td>{{ $modelsOrder->product_stok->name }}</td>
                            <td>
                                <ul class="media-list">
                                    @foreach ($modelsOrder->product_productions as $product_production)
                                        @if (($product_production->defective / $product_production->count) * 100 > $modelsOrder->lose)
                                            @php
                                                $danger = 'badge badge-danger';
                                            @endphp
                                        @else
                                            @php
                                                $danger = 'badge badge-primary';
                                            @endphp
                                        @endif
                                        <li class="media">
                                            <div class="media-body">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modal_defaultstanok1{{ $modelsOrder->id }}{{ $product_production->user->id }}">{{ $product_production->user->name }}</a>

                                                <!-- Large modal -->
                                                <div id="modal_defaultstanok{{ $modelsOrder->id }}{{ $product_production->user->id }}"
                                                    class="modal fade" tabindex="-1">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    {{ $product_production->user->name }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <table class="table table-hover">
                                                                    <tr>
                                                                        <th width="5%">Названия склада</th>
                                                                        <th width="5%">Количество</th>
                                                                        <th width="5%">Произведено</th>
                                                                        <th width="5%">Брак</th>
                                                                        <th width="5%">Статус</th>
                                                                        <th width="18%">Время отправки</th>
                                                                        <th width="20%">Время начала</th>
                                                                        <th width="18%">Время окончания</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ $product_production->equipment->name }}</td>
                                                                        <td>{{ $product_production->count }} 00</td>
                                                                        <td>{{ $product_production->successful }}</td>
                                                                        <td>
                                                                            <span
                                                                                class="{{ $danger }}">{{ $product_production->defective }}</span>
                                                                        </td>
                                                                        <td>
                                                                            @if ($product_production->status == 1)
                                                                                <a href="#"
                                                                                    class="btn btn-outline-danger rounded-pill border-2 btn-icon">
                                                                                    <i class="mi-done mr-0 mi-1x"></i>
                                                                                </a>
                                                                            @elseif($product_production->status == 2)
                                                                                <a href="#"
                                                                                    class="btn btn-outline-warning rounded-pill border-2 btn-icon">

                                                                                    <i class="icon-spinner2 spinner"></i>
                                                                                </a>
                                                                            @elseif($product_production->status == 3)
                                                                                <a href="#"
                                                                                    class="btn btn-outline-success rounded-pill border-2 btn-icon">
                                                                                    <i class="mi-done-all mr-0 mi-1x"></i>
                                                                                </a>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $product_production->created_at->format('d-m-Y , H : i : s') }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $product_production->start != null ? \Carbon\Carbon::parse($product_production->start)->format('d-m-Y , H : i : s') : ' - ' }}
                                                                        </td>

                                                                        <td>{{ $product_production->status == 3 ? $product_production->updated_at->format('d-m-Y , H : i : s') : ' - ' }}
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                    class="btn btn-primary">Закрыть</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /large modal -->
                                                <div class="text-muted">
                                                    {{ $product_production->updated_at->format('M - d , H : i') }}</div>
                                            </div>
                                            <div class="mr-3">
                                                @if ($product_production->status == 1)
                                                    <a href="#"
                                                        class="btn btn-outline-danger rounded-pill border-2 btn-icon">
                                                        <i class="mi-done mr-0 mi-1x"></i>
                                                    </a>
                                                @elseif($product_production->status == 2)
                                                    <a href="#"
                                                        class="btn btn-outline-warning rounded-pill border-2 btn-icon">
                                                        <i class="icon-spinner2 spinner"></i>
                                                    </a>
                                                @elseif($product_production->status == 3)
                                                    <a href="#"
                                                        class="btn btn-outline-success rounded-pill border-2 btn-icon">
                                                        <i class="mi-done-all mr-0 mi-1x"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $modelsOrder->count }}</td>
                            <td>{{ $modelsOrder->successful }}</td>
                            <td><span class="{{ $row }}">{{ $modelsOrder->defective }}</span></td>
                            <td>{{ $modelsOrder->lose }} %</td>
                            <td>
                                @if ($modelsOrder->status == 1)
                                    <a href="#" data-toggle="modal"
                                        data-target="#admin_model_status{{ $modelsOrder->id }}"
                                        class="btn btn-outline-danger rounded-pill border-2 btn-icon">
                                        <i class="mi-done mr-0 mi-1x"></i>
                                    </a>
                                @elseif($modelsOrder->status == 2)
                                    <a href="#" data-toggle="modal"
                                        data-target="#admin_model_status{{ $modelsOrder->id }}"
                                        class="btn btn-outline-warning rounded-pill border-2 btn-icon">
                                        <i class="icon-spinner2 spinner"></i>
                                    </a>
                                @elseif($modelsOrder->status == 3)
                                    <a href="#" data-toggle="modal"
                                        data-target="#admin_model_status{{ $modelsOrder->id }}"
                                        class="btn btn-outline-success rounded-pill border-2 btn-icon">
                                        <i class="mi-done-all mr-0 mi-1x"></i>
                                    </a>
                                @endif

                                <!-- Table modal -->
                                <div id="admin_model_status{{ $modelsOrder->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Производство продукции</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="media-list">
                                                    <li class="media">
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <th>Пользователи Станок</th>
                                                                <th>Название склада</th>
                                                                <th>Количество</th>
                                                                <th width="5%">Произведено</th>
                                                                <th width="5%">Брак</th>
                                                                <th width="5%">Статус</th>
                                                                <th width="18%">Время отправки
                                                                </th>
                                                                <th width="20%">Время начала
                                                                </th>
                                                                <th width="18%">Время окончания
                                                                </th>
                                                            </tr>
                                                            @foreach ($modelsOrder->product_productions as $product_production)
                                                                @if (($product_production->defective / $product_production->count) * 100 > $modelsOrder->lose)
                                                                    @php
                                                                        $danger = 'badge badge-danger';
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $danger = 'badge badge-primary';
                                                                    @endphp
                                                                @endif

                                                                <tr>
                                                                    <td>{{ $product_production->user->name }}</td>
                                                                    <td>{{ $product_production->equipment->name }}
                                                                    </td>
                                                                    <td>{{ $product_production->count }}
                                                                    </td>
                                                                    <td>{{ $product_production->successful }}
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            class="{{ $danger }}">{{ $product_production->defective }}</span>
                                                                    </td>
                                                                    <td>
                                                                        @if ($product_production->status == 1)
                                                                            <a href="#"
                                                                                class="btn btn-outline-danger rounded-pill border-2 btn-icon">
                                                                                <i class="mi-done mr-0 mi-1x"></i>
                                                                            </a>
                                                                        @elseif($product_production->status == 2)
                                                                            <a href="#"
                                                                                class="btn btn-outline-warning rounded-pill border-2 btn-icon">

                                                                                <i class="icon-spinner2 spinner"></i>
                                                                            </a>
                                                                        @elseif($product_production->status == 3)
                                                                            <a href="#"
                                                                                class="btn btn-outline-success rounded-pill border-2 btn-icon">
                                                                                <i class="mi-done-all mr-0 mi-1x"></i>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $product_production->created_at->format('d-m-Y , H : i : s') }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $product_production->start != null ? \Carbon\Carbon::parse($product_production->start)->format('d-m-Y , H : i : s') : ' - ' }}
                                                                    </td>

                                                                    <td>{{ $product_production->status == 3 ? $product_production->updated_at->format('d-m-Y , H : i : s') : ' - ' }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Table modal -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            let optionCounter = 2; // Start with 2 or any initial value
            // Button qo'shish
            $('#addOptionBtn').on('click', function() {
                const newSelect = `<div class="row" id="optionRow${optionCounter}">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="stanok">Станок ${optionCounter}</label>
                                                <select name="equipment${optionCounter}" id="stanok" required class="custom-select">
                                                    @foreach ($equipments as $equipment)
                                                        <option value="{{ $equipment->id }}">
                                                            {{ $equipment->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="user">Пользователь ${optionCounter}</label>
                                                <select name="user${optionCounter}" id="user" required class="custom-select">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 mt-4 mr-3">
                                            <span class="btn btn-outline-danger delete-model-input"
                                                data-id="${optionCounter}">
                                                <i class="icon-cross3"></i>
                                            </span>
                                        </div>
                                    </div>`;

                $('#selectOptions').append(newSelect);

                // Increment the option counter for the next option
                optionCounter++;
            });
            // Tugma uchun o'chirish
            $('#selectOptions').on('click', '.delete-model-input', function() {
                const rowId = $(this).data('id');
                $('#optionRow' + rowId).remove();
            });

        });
    </script>
@endsection
