@extends('../index')

@section('title', 'Панель администратора')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        <!-- Cart dashbort -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert bg-danger alert-rounded alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <span class="font-weight-semibold">{{ $error }}</span>
                </div>
            @endforeach
        @endif
        @if (session('text'))
            <div class="alert bg-teal alert-rounded alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">{{ session('text') }}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-3">

                <!-- Members online -->
                <div class="card bg-success">
                    <div class="card-body">
                        <a href="{{ route('order_app.list') }}" class="text-white">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $sameOrders->count() }}</h3>
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
        <div class="row">
            <div class="col-xl-12">
                <!-- Support tickets -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Входящие заявки</h6>
                    </div>


                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Фирма</th>
                                    <th width="10%">Количество</th>
                                    <th width="15%">Фирма Тел.</th>
                                    <th width="15%">Курьер</th>
                                    <th width="15%">Функция</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = $applications->count();
                                @endphp
                                @foreach ($applications as $application)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->index + 1 }}
                                            @php
                                                $index = $loop->index + 1;
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $application->firma->name }}
                                        </td>
                                        <td>
                                            <a href="#" class="list-icons-item"
                                                data-toggle="dropdown">{{ $application->application_model_products->count() }}
                                                - штуки
                                                ,
                                                <span class="btn btn-primary rounded-pill btn-icon btn-sm ml-2"
                                                    style="font-weight: 900;font-size: 12pt;">
                                                    {{ $application->application_model_products->where('status', 3)->count() }}
                                                    / {{ $application->application_model_products->count() }}</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @foreach ($application->application_model_products as $application->application_model_product)
                                                    <a href="{{ route('order_app.show', $application->id) }}"
                                                        class="dropdown-item {{ $application->application_model_product->status == 3 ? 'bg-primary' : 'bg-warning' }}">
                                                        {{ $application->application_model_product->model_product->name_size }}
                                                        /
                                                        {{ $application->application_model_product->count }} - штуки ,
                                                        @if ($application->application_model_product->status == 3)
                                                            @php
                                                                $text = 'В процессе';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $text = 'В Ожидающие';
                                                            @endphp
                                                        @endif
                                                        @if (isset($key))
                                                            @if ($key == 5)
                                                                @php
                                                                    $text = 'Готовый продукт';
                                                                @endphp
                                                            @endif
                                                        @endif
                                                        {{-- {{ $application->application_model_product->status == 3 ? 'В процессе ' : 'В Ожидающие' }} --}}
                                                        {{ $text }}
                                                    </a>
                                                @endforeach

                                            </div>
                                        </td>
                                        <td>
                                            <a
                                                href="tel:{{ $application->firma->prone1 }}">{{ $application->firma->prone1 }}</a>
                                        </td>
                                        <td>
                                            @if (isset($application->delivery_type))
                                                @if ($application->delivery_type == 1)
                                                    <span class="badge badge-warning ml-1">Отправка с Яндекса</span>
                                                @elseif($application->delivery_type == 2)
                                                    <span class="badge badge-warning ml-1">Клиент сам заберет</span>
                                                @elseif($application->delivery_type == 3)
                                                    <span
                                                        class="badge badge-warning ml-1">{{ $application->courier->staf->name }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="">
                                            @if ($application->status == 5)
                                                <a href="#" class="btn btn-primary mt-2" data-toggle="modal"
                                                    data-target="#modal_defaultstanok{{ $application->id }}">Тип
                                                    доставки</a>
                                                <!-- Large modal -->
                                                <div id="modal_defaultstanok{{ $application->id }}" class="modal fade"
                                                    tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Тип доставки {{ $application->id }}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form action="{{ route('add.curier', $application->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="border p-3 rounded">

                                                                        <div class="custom-control custom-radio mb-3">
                                                                            <input type="radio"
                                                                                class="custom-control-input" value="1"
                                                                                name="type_curyer"
                                                                                id="yangex{{ $index }}">
                                                                            <label class="custom-control-label curyer-radio"
                                                                                data-curyer="1"
                                                                                for="yangex{{ $index }}">Отправка с
                                                                                Яндекса</label>
                                                                        </div>

                                                                        <div class="custom-control custom-radio mb-3">
                                                                            <input type="radio"
                                                                                class="custom-control-input" value="2"
                                                                                name="type_curyer"
                                                                                id="klient{{ $index }}">
                                                                            <label
                                                                                class="custom-control-label curyer-radio"
                                                                                data-curyer="2"
                                                                                for="klient{{ $index }}">Клиент сам
                                                                                заберет</label>
                                                                        </div>

                                                                        <div class="custom-control custom-radio mb-3">
                                                                            <input type="radio"
                                                                                class="custom-control-input"
                                                                                value="3" name="type_curyer"
                                                                                id="kuryer{{ $index }}">
                                                                            <label
                                                                                class="custom-control-label curyer-radio"
                                                                                data-curyer="3"
                                                                                for="kuryer{{ $index }}">Курьер
                                                                                доставит</label>
                                                                        </div>
                                                                        <div class="form-group"
                                                                            id="selectKuryer{{ $index }}">

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-link"
                                                                        data-dismiss="modal">Закрывать</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Сохранять
                                                                        <i class="icon-paperplane ml-2"></i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- <div class="list-icons">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                            class="icon-menu7"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="{{ route('send_to_production', $application->id) }}"
                                                            class="dropdown-item"><i
                                                                class="icon-checkmark3 text-success"></i>
                                                            Производство</a>

                                                    </div>
                                                </div>
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">

                    <div class="d-flex flex-row-reverse">
                        {{-- {{ $applications->links() }} --}}
                    </div>
                </div>
                <!-- /support tickets -->
            </div>

        </div>
        <!-- /dashboard content -->

    </div>
    <!-- /content area -->
    <script>
        $(document).ready(function() {
            let a = {{ $count }}

            for (let index = 1; index <= a; index++) {
                $('.curyer-radio').click(function() {
                    let curyer = $(this).data('curyer');
                    if (curyer == 3) {
                        let selectKuryer = `<label for="model_onklik_up">Выберите курьера</label>
                                <select name="curyer_id" id="model_onklik_up21"
                                    class="form-control">
                                    <option>Выберите курьера</option>
                                    @foreach ($couriers as $courier)
                                        <option value="{{ $courier->id }}">
                                            {{ $courier->staf->name }}</option>
                                    @endforeach
                                </select>`;
                        $(`#selectKuryer${index}`).empty();
                        $(`#selectKuryer${index}`).append(selectKuryer);
                    } else {
                        $(`#selectKuryer${index}`).empty();
                    }
                    console.log(curyer);
                });

            }

        });
    </script>
@endsection
