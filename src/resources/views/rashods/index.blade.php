@extends('../index')

@section('title', 'Список Рашод')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-4">
        @if (Auth::user()->hasPermissionTo('addRasxod'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить
                расходы</button>
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
                        <h5 class="modal-title">Добавить расходы</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('addRasxod') }}" method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="border p-3 rounded">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="rashod_type_add"></div>
                                        {{-- <h2 class="">Расходы</h2> --}}
                                        <div class="form-group">
                                            <input type="hidden" name="rashod_type" value="2">
                                            <label lang="nakladnoy">Накладной</label>
                                            <select id="nakladnoy" name="nakladnoy_id" required class="custom-select">
                                                <option disabled selected>Выбирать</option>
                                                @foreach ($nakladnoys as $nakladnoy)
                                                    <option value="{{ $nakladnoy->id }}">Грузоотправитель :
                                                        {{ $nakladnoy->shipper }} , Дата :
                                                        {{ $nakladnoy->created_at->format('d-m-Y') }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="stanok">Другой</label>
                                            <select name="boshqa" id="skidka" class="form-control select-multiple-tags"
                                                multiple="multiple" data-fouc>
                                                <option value="На обед">На обед</option>
                                                <option value="Для бензина">Для бензина</option>
                                                <option value="Другой">Другой</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="custom-control custom-radio mb-3 ml-2">

                                                <input type="radio" class="custom-control-input" value="1"
                                                    name="type_sum" id="Сум">

                                                <label class="custom-control-label rashod-radio" data-rashod="1"
                                                    for="Сум">
                                                    <i class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                    Сум
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3 ml-2">

                                                <input type="radio" class="custom-control-input" value="2"
                                                    name="type_sum" id="Карта">

                                                <label class="custom-control-label rashod-radio" data-rashod="2"
                                                    for="Карта">
                                                    <i class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                    Карта
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3 ml-2">

                                                <input type="radio" class="custom-control-input" value="3"
                                                    name="type_sum" id="Перечесление">

                                                <label class="custom-control-label rashod-radio" data-rashod="3"
                                                    for="Перечесление">
                                                    <i class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                    Перечисление
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio mb-3 ml-2">

                                                <input type="radio" class="custom-control-input" value="4"
                                                    name="type_sum" id="Доллар">

                                                <label class="custom-control-label rashod-radio" data-rashod="4"
                                                    for="Доллар">
                                                    <i class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                    Доллар
                                                </label>
                                            </div>

                                        </div>
                                        <div id="kurs"></div>
                                        <div class="mb-3">
                                            <label for="sum">Сумма</label>
                                            <input type="text" name="sum" id="sum" class="form-control"
                                                placeholder="Сумма">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description">Описание</label>
                                            <textarea type="text" name="description" id="description" class="form-control" placeholder="Описание"></textarea>
                                        </div>
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

        <!-- Cart dashbort -->
        <div class="row mt-3">
            <div class="col-lg-4">

                <!-- Members online -->
                <div class="card bg-warning">
                    <div class="card-body">
                        <a href="{{ route('rashod') }}" class="text-white">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $count->where('debtor', '>', 0)->count() }}</h3>
                                {{-- <span class="badge badge-teal badge-pill align-self-center ml-auto">+53,6%</span> --}}
                            </div>

                            <div>
                                Ожидаемые платежи
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
                <div class="card bg-success">
                    <a href="{{ route('statusRashor', 1) }}" class="text-white">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $countRashod->where('type', 1)->count() }}</h3>
                            </div>

                            <div>
                                Произведенные платежи
                                {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /today's revenue -->
            </div>
            <div class="col-lg-4">
                <!-- Today's revenue -->
                <div class="card bg-danger">
                    <a href="{{ route('statusRashor', 2) }}" class="text-white">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{ $countRashod->where('type', 2)->count() }}</h3>
                            </div>

                            <div>
                                Расходы
                                {{-- <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /today's revenue -->
            </div>
        </div>
        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Список Похожие заказы</h5>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Фирма</th>
                        <th>Фирма Тел.</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th>Долг</th>
                        <th>Описание</th>
                        <th>Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ ($applications->currentpage() - 1) * $applications->perpage() + $loop->index + 1 }}</td>
                            <td>
                                {{ $application->firma->name }}
                            </td>
                            <td>
                                <a href="tel:{{ $application->firma->prone1 }}">{{ $application->firma->prone1 }}</a> ,
                                <a href="tel:{{ $application->firma->prone2 }}">{{ $application->firma->prone2 }}</a>
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

                                        </p>
                                    @endforeach

                                </div>
                            </td>
                            <td>{{ number_format($application->payment) }}</td>
                            <td>{{ number_format($application->debtor) }}</td>
                            <td>
                                <p>
                                    {{ $application->description }}
                                </p>
                            </td>
                            <td>

                                <div class="list-icons">
                                    <div class="dropdown">
                                        @if (Auth::user()->hasPermissionTo('rashod.add'))
                                            <a href="#" class="list-icons-item" data-toggle="dropdown"><i
                                                    class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-toggle="modal"
                                                    data-target="#modalRashod{{ $application->id }}"><i
                                                        class="icon-checkmark3 text-success"></i>
                                                    Оплата</a>
                                                <div class="dropdown-divider"></div>

                                                <a href="#" class="dropdown-item" data-toggle="modal"
                                                    data-target="#modalRashod{{ $application->id }}"><i
                                                        class="icon-cross2 text-danger"></i>
                                                    Вазврата товар</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Basic modal -->
                                <div id="modalRashod{{ $application->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Фирма : {{ $application->firma->name }} , Долг:
                                                    {{ number_format($application->debtor) }}</h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('rashod.add') }}" method="post">
                                                @csrf

                                                <div class="modal-body">
                                                    <div class="border p-3 rounded">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <div class="custom-control custom-radio mb-3">

                                                                    <input type="radio" class="custom-control-input"
                                                                        value="1" name="rashod_type"
                                                                        id="rasxod{{ $application->id }}">

                                                                    <label class="custom-control-label"
                                                                        for="rasxod{{ $application->id }}">
                                                                        <i
                                                                            class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                                        Оплата</a>
                                                                    </label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-3">
                                                                    <input type="radio" class="custom-control-input"
                                                                        value="2" name="rashod_type"
                                                                        id="prixod{{ $application->id }}">
                                                                    <label class="custom-control-label"
                                                                        for="prixod{{ $application->id }}">
                                                                        <i class="icon-cross2 text-danger ml-1 mr-2"></i>
                                                                        Вазврата товар</a>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="row">
                                                                    <div class="custom-control custom-radio mb-3 ml-2">

                                                                        <input type="radio" class="custom-control-input"
                                                                            value="1" name="type_sum"
                                                                            id="sum{{ $application->id }}">

                                                                        <label class="custom-control-label rashod-radio"
                                                                            data-rashod="1"
                                                                            for="sum{{ $application->id }}">
                                                                            <i
                                                                                class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                                            Сум
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-3 ml-2">

                                                                        <input type="radio" class="custom-control-input"
                                                                            value="2" name="type_sum"
                                                                            id="karta{{ $application->id }}">

                                                                        <label class="custom-control-label rashod-radio"
                                                                            data-rashod="2"
                                                                            for="karta{{ $application->id }}">
                                                                            <i
                                                                                class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                                            Карта
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-3 ml-2">

                                                                        <input type="radio" class="custom-control-input"
                                                                            value="3" name="type_sum"
                                                                            id="perechisleniya{{ $application->id }}">

                                                                        <label class="custom-control-label rashod-radio"
                                                                            data-rashod="3"
                                                                            for="perechisleniya{{ $application->id }}">
                                                                            <i
                                                                                class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                                                Перечисление
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio mb-3 ml-2">

                                                                        <input type="radio" class="custom-control-input"
                                                                            value="4" name="type_sum"
                                                                            id="dollor{{ $application->id }}">

                                                                        <label class="custom-control-label rashod-radio"
                                                                            data-rashod="4"
                                                                            data-app_id="{{ $application->id }}"
                                                                            for="dollor{{ $application->id }}">
                                                                            <i
                                                                                class="icon-checkmark3 text-success ml-1 mr-2"></i>
                                                                            Доллар
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                                <div id="app_id{{ $application->id }}"
                                                                    class="removeKurs"></div>
                                                                <div class="mb-3">
                                                                    <input type="hidden" name="application_id"
                                                                        value="{{ $application->id }}">
                                                                    <label for="sum">Сумма</label>
                                                                    <input type="number" name="sum" id="sum"
                                                                        class="form-control" placeholder="Сумма">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="description">Описание</label>
                                                                    <textarea type="number" name="description" id="description" class="form-control" placeholder="Описание"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-row-reverse mr-2">
            {{ $applications->links() }}
        </div>
    </div>
    <script>
        $('.rashod-radio').click(function() {

            let rashod = $(this).data('rashod');
            if (rashod == 4) {

                let app_id = $(this).data('app_id');
                console.log(true, app_id);
                $(`#kurs`).append(`<div class="mb-3" id="kurs_remove">
                                            <label for="sum">Курс доллара</label>
                                            <input type="text" name="kurs" id="kurs" class="form-control"
                                                placeholder="Курс доллара">
                                        </div>`);
                $(`#app_id${app_id}`).append(`<div class="mb-3" id="removeKursremove">
                                            <label for="sum">Курс доллара</label>
                                            <input type="text" name="kurs" id="kurs" class="form-control"
                                                placeholder="Курс доллара">
                                        </div>`);
            } else {
                console.log(false);
                $(`#kurs_remove`).remove();
                $(`#removeKursremove`).remove();
            }
            console.log(rashod);
        })
    </script>
@endsection
