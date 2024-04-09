@extends('../index')

@section('title', 'Панель администратора')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        <div class="row">
            <div class="col-xl-8">
                <!-- Quick stats boxes -->
                <div class="row">
                    <div class="col-lg-4">

                        <!-- Members online -->
                        <div class="card bg-pink">
                            <div class="card-body">
                                <a href="{{ route('status_all', 2) }}" class="text-white">
                                    <div class="d-flex">
                                        <h3 class="font-weight-semibold mb-0">{{ $count->where('status', 2)->count() }}</h3>
                                        {{-- <span class="badge badge-teal badge-pill align-self-center ml-auto">+53,6%</span> --}}
                                    </div>

                                    <div>
                                        Ожидающие заказы
                                        {{-- <div class="font-size-sm opacity-75">489 avg</div> --}}
                                    </div>
                                </a>
                            </div>

                            <div class="container-fluid">
                                {{-- <div id="members-online"></div> --}}
                            </div>
                        </div>
                        <!-- /members online -->

                    </div>

                    <div class="col-lg-4">
                        <!-- Today's revenue -->
                        <div class="card bg-primary">
                            <a href="{{ route('status_all', 3) }}" class="text-white">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h3 class="font-weight-semibold mb-0">{{ $count->where('status', 3)->count() }}</h3>
                                    </div>

                                    <div>
                                        Отправленные в производство
                                        {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- /today's revenue -->
                    </div>

                    <div class="col-lg-4">

                        <!-- Members online -->
                        <div class="card bg-teal">
                            <div class="card-body">
                                <a href="{{ route('status_all', 4) }}" class="text-white">
                                    <div class="d-flex">
                                        <h3 class="font-weight-semibold mb-0">{{ $count->where('status', 4)->count() }}</h3>
                                        {{-- <span class="badge badge-teal badge-pill align-self-center ml-auto">+53,6%</span> --}}
                                    </div>

                                    <div>
                                        В процессе производства
                                        {{-- <div class="font-size-sm opacity-75">489 avg</div> --}}
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

                        <!-- Members online -->
                        <div class="card bg-teal">
                            <div class="card-body">
                                <a href="{{ route('status_all', 5) }}" class="text-white">
                                    <div class="d-flex">
                                        <h3 class="font-weight-semibold mb-0">{{ $count->where('status', 5)->count() }}</h3>
                                        {{-- <span class="badge badge-teal badge-pill align-self-center ml-auto">+53,6%</span> --}}
                                    </div>

                                    <div>
                                        Готовый продукт
                                        {{-- <div class="font-size-sm opacity-75">489 avg</div> --}}
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
                        <!-- Current server load -->
                        <div class="card bg-success">
                            <div class="card-body">
                                <a href="{{ route('status_all', 6) }}" class="text-white">
                                    <div class="d-flex">
                                        <h3 class="font-weight-semibold mb-0">{{ $count->where('status', 6)->count() }}</h3>
                                    </div>
                                    <div>
                                        Доставленный
                                        {{-- <div class="font-size-sm opacity-75">34.6% avg</div> --}}
                                    </div>
                                </a>
                            </div>
                            <div id="server-load"></div>
                        </div>
                        <!-- /current server load -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Current server load -->
                        <div class="card bg-info">
                            <div class="card-body">
                                <a href="{{ route('status_all', 1) }}" class="text-white">
                                    <div class="d-flex">
                                        <h3 class="font-weight-semibold mb-0">{{ $count->where('status', 1)->count() }}
                                        </h3>
                                    </div>
                                    <div>
                                        Отдел продаж
                                        {{-- <div class="font-size-sm opacity-75">34.6% avg</div> --}}
                                    </div>
                                </a>
                            </div>
                            <div id="server-load"></div>
                        </div>
                        <!-- /current server load -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Current server load -->
                        <div class="card bg-danger">
                            <div class="card-body">
                                <a href="{{ route('status_all', 7) }}" class="text-white">
                                    <div class="d-flex">
                                        <h3 class="font-weight-semibold mb-0">{{ $count->where('status', 7)->count() }}
                                        </h3>
                                    </div>
                                    <div>
                                        Возврат товаров
                                        {{-- <div class="font-size-sm opacity-75">34.6% avg</div> --}}
                                    </div>
                                </a>
                            </div>
                            <div id="server-load"></div>
                        </div>
                        <!-- /current server load -->
                    </div>
                </div>
                <!-- /quick stats boxes -->

                <!-- Support tickets -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Список заказы</h6>
                    </div>


                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Фирма</th>
                                    <th width="10%">Количество</th>
                                    <th width="10%">Сумма</th>
                                    <th width="10%">Процент</th>
                                    <th width="10%">Сумма</th>
                                    <th width="15%">Фирма Тел.</th>
                                    <th width="15%">Курьер</th>
                                    <th width="15%">Функция</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td class="text-center">
                                            {{ ($applications->currentPage() - 1) * $applications->perPage() + $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ $application->firma->name }}
                                        </td>
                                        <td>
                                            <a href="#" class="list-icons-item"
                                                data-toggle="dropdown">{{ $application->application_model_products->count() }}
                                                - штуки</a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @foreach ($application->application_model_products as $application->application_model_product)
                                                    <p class="dropdown-item">
                                                        {{ $application->application_model_product->model_product->name_size }}
                                                        /
                                                        {{ $application->application_model_product->count }} - штуки
                                                        @foreach ($application->application_model_product->model_product->model_structures as $model_structure)
                                                            @if (
                                                                $materials->where('material_id', $model_structure->material_id)->first()->quantity <
                                                                    str_replace(',', '.', $model_structure->value) * $application->application_model_product->count)
                                                                <span
                                                                    class="badge badge-danger ml-1">{{ $materials->where('material_id', $model_structure->material_id)->first()->material->name }},
                                                                    {{ number_format($model_structure->value * $application->application_model_product->count - $materials->where('material_id', $model_structure->material_id)->first()->quantity) }}</span>
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                @endforeach

                                            </div>
                                        </td>
                                        <td>{{ number_format($application->sum) }}</td>
                                        <td>{{ $application->protsent }} %</td>
                                        <td>{{ number_format($application->payment) }}</td>
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
                                        @if ($application->status == 2)
                                            <td>

                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                                class="icon-menu7"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{ route('send_to_production', $application->id) }}"
                                                                class="dropdown-item"><i
                                                                    class="icon-checkmark3 text-success"></i>
                                                                Производство</a>
                                                            <div class="dropdown-divider"></div>

                                                            <a href="{{ route('status_failed', $application->id) }}"
                                                                class="dropdown-item"><i
                                                                    class="icon-cross2 text-danger"></i>
                                                                Отмененные </a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">

                    <div class="d-flex flex-row-reverse">
                        {{ $applications->links() }}
                    </div>
                </div>
                <!-- /support tickets -->
            </div>

            <div class="col-xl-4">

                <!-- My messages -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title mt-1">Расходы</h6>

                    </div>

                    <!-- Numbers -->
                    <div class="card-body py-0 mt-2">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mb-3">
                                    <a href="{{ route('rashodStatus', 1) }}" class="text-info">
                                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                                            <span href="#"
                                                class="btn btn-outline-primary rounded-pill border-2 btn-icon ml-4">
                                                <i class="icon-checkmark3"></i>
                                            </span>
                                            <div class="ml-3">
                                                <h5 class="font-weight-semibold mb-0">
                                                    {{ number_format($rashodCount->where('type', 1)->count()) }}</h5>
                                                <span class="text-muted">Платежи</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <a href="{{ route('rashodStatus', 2) }}" class="text-danger">
                                        <div class="d-flex align-items-center mb-3 mb-lg-0">
                                            <span href="#"
                                                class="btn btn-outline-danger rounded-pill border-2 btn-icon ml-4">
                                                <i class="icon-statistics"></i>
                                            </span>
                                            <div class="ml-3">
                                                <h5 class="font-weight-semibold mb-0">
                                                    {{ number_format($rashodCount->where('type', 2)->count()) }}</h5>
                                                <span class="text-muted">Расходы</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /numbers -->

                    <!-- Tabs content -->
                    <div class="tab-content card-body">
                        <div class="tab-pane active fade show" id="messages-tue">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Тип</th>
                                            <th>Куда</th>
                                            <th>Сумма</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rashods as $rashod)
                                            <tr>
                                                <td class="text-{{ $rashod->type == 1 ? 'info' : 'danger' }}">
                                                    <a href=""
                                                        class="text-{{ $rashod->type == 1 ? 'info' : 'danger' }}"
                                                        data-toggle="modal" data-target="#rashor{{ $rashod->id }}">
                                                        {{ $rashod->type == 1 ? 'Приход' : 'Расходы' }}
                                                    </a>
                                                    <!-- Basic modal -->
                                                    <div id="rashor{{ $rashod->id }}" class="modal fade"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Расходы</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="border p-3 rounded">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <table class="table text-nowrap">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Тип</th>
                                                                                            <th>Куда</th>
                                                                                            <th>Сумма</th>
                                                                                            <th>Описание</th>
                                                                                            <th>Дата </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>{{ $rashod->id }}</td>
                                                                                            <td>{{ $rashod->type == 1 ? 'Приход' : 'Расходы' }}
                                                                                            </td>
                                                                                            <td>{{ $rashod->application_id != null ? 'Заявки : ' . $rashod->application->firma->name : ($rashod->nakladnoy_id != null ? 'Накладной : ' . $rashod->nakladnoy->shipper : 'Другой : ' . $rashod->boshqa) }}
                                                                                            </td>
                                                                                            <td>{{ number_format($rashod->sum) }}
                                                                                            </td>
                                                                                            <td>{{ $rashod->text }}</td>
                                                                                            <td>{{ $rashod->created_at->format('d-m-Y') }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-dismiss="modal">Закрывать</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /basic modal -->
                                                </td>
                                                <td>
                                                    {{ $rashod->application_id != null ? 'Заявки : ' . $rashod->application->firma->name : ($rashod->nakladnoy_id != null ? 'Накладной : ' . $rashod->nakladnoy->shipper : 'Другой : ' . $rashod->boshqa) }}
                                                </td>
                                                <td>{{ number_format($rashod->sum) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse mr-2">
                            {{ $rashods->links() }}
                        </div>

                    </div>
                    <!-- /tabs content -->

                </div>
                <!-- /my messages -->

            </div>
        </div>
        <!-- /dashboard content -->

    </div>
    <!-- /content area -->
    <script>
        $(document).ready(function() {
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
                    $('#selectKuryer').empty();
                    $('#selectKuryer').append(selectKuryer);
                } else {
                    $('#selectKuryer').empty();
                }
                console.log(curyer);
            });

        });
    </script>
@endsection
