@extends('../index')

@section('title', 'Список заказа')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">

        <!-- Cart dashbort -->
        <div class="row">
            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-success">
                    <div class="card-body">
                        <a href="{{ route('order_app.list') }}" class="text-white">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $count }}</h3>
                                {{-- <span class="badge badge-teal badge-pill align-self-center ml-auto">+53,6%</span> --}}
                            </div>

                            <div>
                                Похожие заказы
                                {{--                                <div class="font-size-sm opacity-75">489 avg</div> --}}
                            </div>
                        </a>
                    </div>

                    <div class="container-fluid">
                        {{-- <div id="members-online"></div> --}}
                    </div>
                </div>
                <!-- /members online -->

            </div>

            <div class="col-lg-3">
                <!-- Today's revenue -->
                <div class="card bg-primary">
                    <a href="{{ route('order_app.status', 3) }}" class="text-white">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $orderApps->where('status', 3)->count() }}</h3>
                            </div>

                            <div>
                                Входящие заявки
                                {{--                                <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /today's revenue -->
            </div>

            <div class="col-lg-3">
                <!-- Today's revenue -->
                <div class="card bg-primary">
                    <a href="{{ route('order_app.status', 4) }}" class="text-white">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $orderApps->where('status', 4)->count() }}</h3>
                            </div>

                            <div>
                                В процессе производства
                                {{--                                <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /today's revenue -->
            </div>

            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-teal">
                    <div class="card-body">
                        <a href="{{ route('order_app.status', 5) }}" class="text-white">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $orderApps->where('status', 5)->count() }}</h3>
                                {{--                                <span class="badge badge-teal badge-pill align-self-center ml-auto">+53,6%</span> --}}
                            </div>

                            <div>
                                Готовый продукт
                                {{--                                <div class="font-size-sm opacity-75">489 avg</div> --}}
                            </div>
                        </a>
                    </div>

                    <div class="container-fluid">
                        {{-- <div id="members-online"></div> --}}
                    </div>
                </div>
                <!-- /members online -->

            </div>
        </div>
        <!-- Cart dashbort -->
        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Список {{ $sameOrders->firma->name }}</h5>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название модели</th>
                        <th>Количество заказа</th>
                        <th>Количество модели</th>
                        <th>Статус</th>
                        {{-- <th class="text-center">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sameOrders->application_model_products as $sameOrder)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                {{-- {{ $sameOrder->model_product->name_size }} --}}
                                <a href="#" class="" data-toggle="modal"
                                    data-target="#order_product_images{{ $sameOrder->model_product->id }}{{ $sameOrder->id }}">
                                    {{ $sameOrder->model_product->name_size }}
                                </a>
                                <!-- Images Product modal -->
                                <div id="order_product_images{{ $sameOrder->model_product->id }}{{ $sameOrder->id }}"
                                    class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Название модели</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                                            <td>{{ $sameOrder->model_product->id }}</td>
                                                            <td>{{ $sameOrder->model_product->name_size }}</td>
                                                            <td>{{ $sameOrder->model_product->size }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    @foreach ($sameOrder->model_product->model_images as $model_image)
                                                        <div class="col-lg-4">
                                                            <div class="card card-body text-center">
                                                                <a href="{{ asset($model_image->img) }}" target="_blank">
                                                                    <img src="{{ asset($model_image->img) }}" class="rounded-4"
                                                                        width="120" height="120" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Закрывать</button>
                                                {{-- <button type="submit" class="btn btn-primary">Сохранять</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  Images Product modal -->
                            </td>
                            <td>
                                <a type="button" class="btn btn-light mb-2" data-toggle="modal"
                                    data-target="#modal_default{{ $sameOrder->id }}">Производство
                                    продукции <span class="btn btn-primary rounded-pill btn-icon btn-sm ml-2"
                                        style="font-weight: 900;font-size: 12pt;">{{ $sameOrder->count }}</span></a>
                                <!-- Basic modal -->
                                <div id="modal_default{{ $sameOrder->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Производство продукции</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('order_app.create', $sameOrder->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Модель продукта</label>
                                                        <input type="text" name=""
                                                            value="{{ $sameOrder->model_product->name_size }}"
                                                            step="any" id="exampleFormControlSelect1"
                                                            class="form-control" readonly placeholder="Модель продукта">
                                                        <input type="hidden" name="model_product_id"
                                                            value="{{ $sameOrder->model_product_id }}" id="">

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="product_stok">Склад продукции</label>
                                                        <select name="product_stok_id" id="product_stok" required
                                                            class="custom-select">
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
                                                                <select name="equipment1" id="stanok" required
                                                                    class="custom-select">
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
                                                                <select name="user1" id="user" required
                                                                    class="custom-select">
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="selectOptions{{ $loop->index + 1 }}"></div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="btn btn-info mb-3"
                                                                id="addOptionBtn{{ $loop->index + 1 }}">Добавлять</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="Count">Количество</label>
                                                                <input type="number" name="count" step="any"
                                                                    id="Count" class="form-control"
                                                                    value="{{ $sameOrder->count }}" readonly
                                                                    placeholder="Количество">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="lose">Потерять</label>
                                                                <input type="number" name="lose" step="any"
                                                                    id="lose" class="form-control" required
                                                                    placeholder="Потерять">
                                                            </div>
                                                        </div>
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
                                <!-- /basic modal -->
                            </td>
                            <td>{{ $sameOrder->sum }}</td>
                            <td>{{ $sameOrder->sum }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            let sameOrders = {{ $count }}

            console.log(typeof sameOrders + sameOrders);
            for (let i = 1; i <= sameOrders; i++) {

                let optionCounter = 2; // Start with 2 or any initial value
                // Button qo'shish
                $(`#addOptionBtn${i}`).on('click', function() {
                    // console.log(i);
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

                    $(`#selectOptions${i}`).append(newSelect);

                    // Increment the option counter for the next option
                    optionCounter++;
                });
                // Tugma uchun o'chirish
                $(`#selectOptions${i}`).on('click', '.delete-model-input', function() {
                    const rowId = $(this).data('id');
                    $('#optionRow' + rowId).remove();
                });
            }

        });
    </script>
@endsection
