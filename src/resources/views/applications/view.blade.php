@extends('../index')

@section('title', 'Список Вид')

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
        <a href="{{ route('applications.list') }}" class="btn btn-light mb-2"><i class="icon-arrow-left52 mr-2"></i>Список
            Заявка</a>
        <!-- Page length options -->
        <div class="card mt-3">


            <table class="table datatable-show-all">
                <tbody>
                    <tr>
                        <th>Имя</th>
                        <th>{{ $application->name }}</th>
                    </tr>
                    <tr>
                        <th>Клиент</th>
                        <th>{{ $application->customer->name }}</th>
                    </tr>
                    <tr>
                        <th>Фирма</th>
                        <th>{{ $application->firma->name }} , Долг - {{ number_format($application->firma->test()) }}</th>
                    </tr>
                    <tr>
                        <th>Количество</th>
                        <th>
                            {{ $application->application_model_products->count() }} - штуки
                            @foreach ($application->application_model_products as $application->application_model_product)
                                <p class="dropdown-item">
                                    {{ $application->application_model_product->model_product->name_size }} /
                                    {{ $application->application_model_product->count }} - штуки <br>
                                    @if (count($application->application_model_product->model_product->model_structures) > 0)
                                        @foreach ($application->application_model_product->model_product->model_structures as $model_structure)
                                            @if (
                                                $materials->where('material_id', $model_structure->material_id)->first()->quantity <
                                                    str_replace(',', '.', $model_structure->value) * $application->application_model_product->count)
                                                <span
                                                    class="badge badge-danger ml-1">{{ $materials->where('material_id', $model_structure->material_id)->first()->material->name }},
                                                    {{ number_format($model_structure->value * $application->application_model_product->count - $materials->where('material_id', $model_structure->material_id)->first()->quantity) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </p>
                            @endforeach
                           
                        </th>
                    </tr>
                    <tr>
                        <th>Стоимость</th>
                        <th>{{ number_format($application->sum) }}</th>
                    </tr>
                    <tr>
                        <th>Процент</th>
                        <th>{{ $application->protsent }} %</th>
                    </tr>
                    <tr>
                        <th>Сумма</th>
                        <th>{{ number_format($application->payment) }}</th>
                    </tr>
                    <tr>
                        <th>Долг</th>
                        <th>{{ number_format($application->debtor) }}</th>
                    </tr>
                    <tr>
                        <th>Фирма Тел.</th>
                        <th><a href="tel:{{ $application->firma->prone1 }}">{{ $application->firma->prone1 }}</a></th>
                    </tr>
                    <tr>
                        <th>Отправить администратору</th>
                        <th>
                            <div class="custom-control custom-switch custom-control-info mb-2">
                                <input type="checkbox" class="custom-control-input" name="status" id="sc_r_info"
                                    {{ $application->status > 1 ? 'checked' : '' }} data-appid={{ $application->id }}>
                                <label class="custom-control-label" for="sc_r_info"></label>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Счет-фактура Бугалтеру</th>
                        <th>
                            @if ($application->bugalter_status == 1)
                                <span class="badge badge-primary ml-1">Отправлено бухгалтеру</span>
                            @elseif ($application->bugalter_status == 2)
                                <span class="badge badge-primary ml-1">Бухгалтер принял</span>
                            @else
                                {{-- <span class="badge badge-primary ml-1">Бухгалтер принял</span> --}}
                            @endif

                        </th>
                    </tr>
                    <tr>

                        <th>Выберите курьера</th>
                        <th>
                            @if (isset($application->delivery_type))
                                @if ($application->delivery_type == 1)
                                    <span class="badge badge-warning ml-1">Отправка с Яндекса</span>
                                @elseif($application->delivery_type == 2)
                                    <span class="badge badge-warning ml-1">Клиент сам заберет</span>
                                @elseif($application->delivery_type == 3)
                                    <span class="badge badge-warning ml-1">{{ $application->courier->staf->name }}</span>
                                @endif
                            @endif
                            <div class="media-body">
                                <a href="#" class="btn btn-primary mt-2" data-toggle="modal"
                                    data-target="#modal_defaultstanok">Тип доставки</a>
                                <!-- Large modal -->
                                <div id="modal_defaultstanok" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Тип доставки</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('add.curier', $application->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="border p-3 rounded">

                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" class="custom-control-input"
                                                                value="1" name="type_curyer" id="yangex">
                                                            <label class="custom-control-label curyer-radio" data-curyer="1"
                                                                for="yangex">Отправка с Яндекса</label>
                                                        </div>

                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" class="custom-control-input"
                                                                value="2" name="type_curyer" id="klient">
                                                            <label class="custom-control-label curyer-radio" data-curyer="2"
                                                                for="klient">Клиент сам заберет</label>
                                                        </div>

                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" class="custom-control-input"
                                                                value="3" name="type_curyer" id="kuryer">
                                                            <label class="custom-control-label curyer-radio" data-curyer="3"
                                                                for="kuryer">Курьер доставит</label>
                                                        </div>
                                                        <div class="form-group" id="selectKuryer">

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрывать</button>
                                                    <button type="submit" class="btn btn-primary">Сохранять <i
                                                            class="icon-paperplane ml-2"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /page length options -->



    </div>
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

            $('#sc_r_info').click(function() {
                let appId = $(this).data('appid');
                console.log(appId);
                $.ajax({
                    url: '/status/' + appId,
                    type: 'get',
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.error('Ajax Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
