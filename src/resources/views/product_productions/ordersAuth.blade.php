@extends('../index')

@section('title', 'Product Production list')

@section('con')
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
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Список продукции продукции</h5>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Станок</th>
                        <th>Название модели</th>
                        <th>Количество</th>
                        <th>Произведено</th>
                        <th>Брак</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->equipment->name }}</td>
                            <td>
                                <a href="#" class="" data-toggle="modal"
                                    data-target="#order_product_images{{ $product->model_product->id }}{{ $product->id }}">
                                    {{ $product->model_product->name_size }}
                                </a>

                                <!-- Images Product modal -->
                                <div id="order_product_images{{ $product->model_product->id }}{{ $product->id }}"
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
                                                            <td>{{ $product->model_product->id }}</td>
                                                            <td>{{ $product->model_product->name_size }}</td>
                                                            <td>{{ $product->model_product->size }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    @foreach ($product->model_product->model_images as $model_image)
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
                                                    data-dismiss="modal">Закрывать</button>
                                                {{-- <button type="submit" class="btn btn-primary">Сохранять</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  Images Product modal -->
                            </td>
                            <td>{{ $product->count }}</td>
                            <td>{{ $product->successful }}</td>
                            <td>{{ $product->defective }}</td>
                            <td>
                                @if ($product->status == 1)
                                    @if (Auth::user()->hasPermissionTo('statusUpdate'))
                                        <a href="{{ route('statusUpdate', $product->id) }}"
                                            class="btn btn-outline-danger rounded-pill border-2 btn-icon">
                                            <i class="mi-done mr-0 mi-1x"></i>
                                        </a>
                                    @endif
                                @elseif($product->status == 2)
                                    @if (Auth::user()->hasPermissionTo('finished'))
                                        <a href="#" class="btn btn-outline-warning rounded-pill border-2 btn-icon"
                                            data-toggle="modal" data-target="#modal_default">
                                            {{-- <i class="mi-done mr-0 mi-1x"></i> --}}
                                            <i class="icon-spinner2 spinner"></i>
                                        </a>
                                    @endif
                                    <!-- Basic modal -->
                                    <div id="modal_default" class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $product->model_product->name_size }}</h5>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <form action="{{ route('finished', $product->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="test">Количество постановок максимум
                                                                {{ $product->count }}</label>
                                                            <input type="number" id="test" name="count"
                                                                class="form-control" required max="{{ $product->count }}"
                                                                placeholder="Количество постановок максимум {{ $product->count }}">
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
                                @elseif($product->status == 3)
                                    <a href="#" class="btn btn-outline-success rounded-pill border-2 btn-icon">
                                        <i class="mi-done-all mr-0 mi-1x"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>

@endsection
