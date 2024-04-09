@extends('../index')

@section('title', 'Список Рашод')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-4">
        @if (Auth::user()->hasPermissionTo('user.create'))
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
                                                    Перечесление
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
                            <button type="button" class="btn btn-link" data-dismiss="modal">Закрывать</button>
                            <button type="submit" class="btn btn-primary">Сохранять</button>
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
                                Ожидаемый платеж
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
                                Платежи произведены
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
                        <th>Тип</th>
                        <th>Куда</th>
                        <th>Сумма</th>
                        <th>Описание</th>
                        {{-- <th>Функция</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rashods as $rashod)
                        <tr>
                            <td>{{ ($rashods->currentpage() - 1) * $rashods->perpage() + $loop->index + 1 }}</td>
                            <td>{{ $rashod->type == 1 ? 'Приход' : 'Расходы' }}</td>
                            <td>
                                {{ $rashod->application_id != null ? 'Заявки : ' . $rashod->application->firma->name : ($rashod->nakladnoy_id != null ? 'Накладной : ' . $rashod->nakladnoy->shipper : 'Другой : ' . $rashod->boshqa) }}
                            </td>
                            <td>{{ $rashod->sum }} , {{ $rashod->type_sum }}</td>
                            <td>
                                <p>
                                    {{ $rashod->text }} 
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-row-reverse mr-2">
            {{ $rashods->links() }}
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
            } else {
                console.log(false);
                $(`#kurs_remove`).remove();
            }
            console.log(rashod);
        })
    </script>
@endsection
