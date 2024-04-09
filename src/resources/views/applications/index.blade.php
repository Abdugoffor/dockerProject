@extends('../index')

@section('title', 'Список Заявка')

@section('con')
    <!-- Content area -->

    <div class="content pt-0 mt-5">
        @if (Auth::user()->hasPermissionTo('applications.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Добавить заявок</button>
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
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Заявки</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{ route('applications.create') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="customer">Клиент</label>
                                <select class="form-control" name="customer_id" id="customer">
                                    <option selected disabled>Клиент</option>
                                    @foreach ($custemers as $custemer)
                                        <option value="{{ $custemer->id }}">{{ $custemer->name }} / Limit :
                                            {{ $custemer->balans }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="firm">Фирма</label>
                                <select class="form-control" name="firm_id" id="firm">
                                </select>
                            </div>
                            <div id="selectOptions"></div>

                            <div class="row" id="ButtonAdd">
                                <div class="col-12">
                                    <span class="btn btn-info mb-3" id="addOptionBtn">Добавить клиента</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="model_onklik">Название модели 1</label>
                                        <select name="model_ids[0]['model_id']" id="model_onklik1"
                                            class="form-control select-multiple-tags" multiple="multiple" data-fouc>
                                            @foreach ($models as $model)
                                                <option value="{{ $model->id }}">
                                                    {{ $model->name_size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label for="Count">Цена 1</label>
                                        <input type="text" name="tan_narxi1" readonly id="tan_narxi1"
                                            class="form-control" placeholder="Цена">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="user">Количество 1</label>
                                        <input type="number" name="model_ids[0]['count']" id="count1"
                                            onchange="kalichestvaOrqaliXisoblash(1)" required class="form-control"
                                            placeholder="Количество">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="user">Итог 1</label>
                                        <input type="text" name="sum" readonly id="itodo_summa1" class="form-control"
                                            placeholder="Итог">
                                    </div>
                                </div>
                                <div class="col-lg-4 min-w-1" id="razmer_1">

                                </div>
                            </div>
                            <div id="NewModel"></div>
                            <div class="row">
                                <div class="col-12">
                                    <span class="btn btn-info mb-3" id="addModel">Добавить модели</span>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="Count">Настоящая цена</label>
                                        <input type="text" name="sum" step="any" readonly id="natija"
                                            class="form-control" placeholder="Цена">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="stanok">Скидка в %</label>
                                        <select name="protsent" id="skidka" class="form-control select-multiple-tags"
                                            multiple="multiple" data-fouc>
                                            <option value="0" selected>0 %</option>
                                            <option value="-10">-10</option>
                                            <option value="-20">-20</option>
                                            <option value="-30">-30</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="sotilish_narx">Цена</label>
                                <input type="text" name="payment" id="sotish_narxi" class="form-control"
                                    placeholder="Summa">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Имя заказчика</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Имя заказчика">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="delivery_time">Срок поставки</label>
                                        <input type="datetime-local" name="delivery_time" id="delivery_time"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Описание</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="3"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="bugalter_status" value="1" class="form-check-input"
                                    id="dc_ls_c">
                                <label class="form-check-label" for="dc_ls_c">Счёт фактура для бухгалтера</label>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
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
                <h3 class="card-title">Заявки</h3>
            </div>
            <form action="{{ route('salary.search') }}" method="get">
                <div class="d-flex m-0">
                    @csrf

                    <div class="form-group col-2">
                        <!-- Select All option -->
                        <div class="form-group">
                            <input type="date" name="date" class="form-control">
                        </div>
                        <!-- /select All option -->
                    </div>

                    <div class="form-group col-2">
                        <button type="submit" class="btn btn-primary">Фильтр</button>
                    </div>
                </div>
            </form>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        {{-- <th width="15%">Имя</th> --}}
                        <th width="10%">Фирма</th>
                        <th width="10%">Количество</th>
                        <th width="10%">Сумма</th>
                        <th width="10%">Процент</th>
                        {{-- <th width="10%">Оплата</th> --}}
                        <th width="15%">Фирма Тел.</th>
                        {{-- <th>Доставка</th> --}}
                        <th width="15%">Курьер</th>
                        <th width="15%">Статус</th>
                        <th width="15%">Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->id }}</td>
                            <td>{{ $application->firma->name }}</td>
                            <td>{{ $application->application_model_products->count() }}</td>
                            <td>{{ $application->sum }}</td>
                            <td>{{ $application->protsent }}</td>
                            <td>
                                <a href="tel:{{ $application->firma->prone1 }}">{{ $application->firma->prone1 }}</a>
                            </td>
                            {{-- <td>
                                <form action="{{ route('delivery.bot', ['application' => $application->id]) }}"
                                    method="post">
                                    @csrf
                                    <input type="submit" name="ok" class="btn btn-info" value="Доставка">
                                </form>
                            </td> --}}
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
                            <td>
                                <span class="badge badge-primary">
                                    {{ $application->status == 1 ? 'Принято' : ($application->status == 2 ? 'Отправлено администратору' : ($application->status == 3 ? 'Отправлено в производство' : ($application->status == 4 ? 'В процессе производства' : ($application->status == 5 ? 'Готовый продукт' : '')))) }}
                                </span>
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('applications.show'))
                                    <a href="{{ route('applications.show', $application->id) }}" target="_blank"
                                        class="btn btn-outline-teal mb-2">
                                        <i class="icon-file-text2"></i>
                                    </a>
                                @endif
                                @if (Auth::user()->hasPermissionTo('applications.update'))
                                    <button type="button" class="btn btn-outline-teal mb-2 app_count edit_modal"
                                        data-toggle="modal" data-target="#modal_default_update{{ $application->id }}"
                                        data-app_count="{{ $application->id }}, {{ $application->application_model_products->count() }}"><i
                                            class="icon-pencil3"></i></button>
                                @endif
                                <!-- Update modal -->
                                <div id="modal_default_update{{ $application->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Заявки</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form
                                                action="{{ route('applications.update', ['applications' => $application->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="customer">Клиент</label>
                                                        <select class="form-control" name="customer_id" id="customer">
                                                            @foreach ($custemers as $custemer)
                                                                <option value="{{ $custemer->id }}"
                                                                    {{ $custemer->id == $application->customer_id ? 'selected' : '' }}>
                                                                    {{ $custemer->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="firm">Фирма</label>
                                                        <select class="form-control" name="firm_id" id="firm">
                                                            @foreach ($firms as $firm)
                                                                <option value="{{ $firm->id }}"
                                                                    {{ $firm->id == $application->firm_id ? 'selected' : '' }}>
                                                                    {{ $firm->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @foreach ($application->application_model_products as $application_model_product)
                                                        <div class="row"
                                                            id="update-model-delete{{ $application->id }}{{ $loop->index + 1 }}">
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label for="model_onklik_up">Название модели
                                                                        {{ $loop->index + 1 }}</label>
                                                                    <select
                                                                        name="model_ids[{{ $loop->index + 1 }}]['model_id']"
                                                                        id="model_onklik_up{{ $application->id }}{{ $loop->index + 1 }}"
                                                                        class="form-control">
                                                                        <option
                                                                            value="{{ $application_model_product->model_product_id }}">
                                                                            {{ $application_model_product->model_product->name_size }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label for="user">Цена
                                                                        {{ $loop->index + 1 }}</label>
                                                                    <input type="text"
                                                                        name="model_ids[{{ $loop->index + 1 }}]['price']"
                                                                        id="price_up{{ $application->id }}{{ $loop->index + 1 }}"
                                                                        class="form-control" readonly
                                                                        value="{{ $application_model_product->model_product->price }}"
                                                                        placeholder="Цена">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label for="user">Количество
                                                                        {{ $loop->index + 1 }}</label>
                                                                    <input type="number"
                                                                        name="model_ids[{{ $loop->index + 1 }}]['count']"
                                                                        value="{{ $application_model_product->count }}"
                                                                        id="count_up{{ $application->id }}{{ $loop->index + 1 }}"
                                                                        required class="form-control"
                                                                        onchange="kalichestvaOrqaliXisoblashUp({{ $application->id }}{{ $loop->index + 1 }})"
                                                                        placeholder="Количество">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label for="user">Итог
                                                                        {{ $loop->index + 1 }}</label>
                                                                    <input type="text" name="sum"
                                                                        value="{{ $application_model_product->model_product->price * $application_model_product->count }}"
                                                                        readonly
                                                                        id="itogo_up{{ $application->id }}{{ $loop->index + 1 }}"
                                                                        class="form-control" placeholder="Итог">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group">
                                                                    <label for="user">Размер
                                                                        {{ $loop->index + 1 }}</label>
                                                                    <input type="text"
                                                                        name="model_ids[{{ $loop->index + 1 }}]['size']"
                                                                        id="size_up{{ $loop->index + 1 }}"
                                                                        class="form-control"
                                                                        value="{{ $application_model_product->model_product->size }}"
                                                                        placeholder="Размер">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-1">
                                                                <div class="form-group">
                                                                    <span
                                                                        class="btn btn-outline-danger model-delete-update-id mt-4"
                                                                        data-delete_id="{{ $application->id }},{{ $loop->index + 1 }},{{ $application_model_product->model_product_id }},{{ $application_model_product->id }}">
                                                                        <i class="icon-cross3"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="Count">Настоящая цена</label>
                                                                <input type="text" name="sum" step="any"
                                                                    readonly id="natija_update{{ $application->id }}"
                                                                    class="form-control" value="{{ $application->sum }}"
                                                                    placeholder="Цена 1">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="stanok">Скидка в %</label>
                                                                <select name="protsent"
                                                                    id="skidka_update{{ $application->id }}"
                                                                    class="form-control select-multiple-tags"
                                                                    multiple="multiple" data-fouc>
                                                                    <option value="{{ $application->protsent }}" selected>
                                                                        {{ $application->protsent }}</option>
                                                                    <option value="0">0 %</option>
                                                                    <option value="-10">-10</option>
                                                                    <option value="-20">-20</option>
                                                                    <option value="-30">-30</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="sotilish_narx">Цена</label>
                                                        <input type="text" name="payment"
                                                            id="sotish_narxi{{ $application->id }}" class="form-control"
                                                            value="{{ $application->payment }}" placeholder="Summa">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="name">Имя заказчика</label>
                                                                <input type="text" name="name"
                                                                    value="{{ $application->name }}" id="name"
                                                                    class="form-control" placeholder="Имя заказчика">
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="delivery_time">Срок поставки</label>
                                                                <input type="datetime-local" name="delivery_time"
                                                                    value="{{ $application->delivery_time }}"
                                                                    id="delivery_time" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="description">Описание</label>
                                                            <textarea name="description" class="form-control" id="description" value="{{ $application->description }}"
                                                                cols="30" rows="3">{{ $application->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="bugalter_status" value="1"
                                                            {{ $application->bugalter_status == 1 ? 'checked' : '' }}
                                                            class="form-check-input"
                                                            id="dc_ls_c_u{{ $application->id }}">
                                                        <label class="form-check-label"
                                                            for="dc_ls_c_u{{ $application->id }}">Счёт фактура для бухгалтера</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-primary">Обновлять</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Update End Modal -->
                                @if (Auth::user()->hasPermissionTo('applications.delete'))
                                    <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal"
                                        data-target="#modal_default_delete{{ $application->id }}"><i
                                            class="icon-bin"></i></button>
                                @endif
                                <!-- Delete Basic modal -->
                                <div id="modal_default_delete{{ $application->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Заявки</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form
                                                action="{{ route('applications.delete', ['applications' => $application->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <h2>Вы хотите удалить</h2>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Delete basic modal -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $applications->links() }}
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
    <script>
        let data = @json($models);
        let materials = @json($materials);
        // console.log(data);
        // console.log(materials);

        $(document).ready(function() {

            let natija = $('#natija').val(0);

            function calculate(DeleteModel) {
                $(`#model_onklik${DeleteModel}`).change('click', function() {


                    let model_id = $(this).val()[0];
                    let found = false;
                    let found_data = null;

                    for (let i = 0; i < data.length; i++) {
                        if (data[i]['id'] == model_id) {
                            found = true;
                            found_data = data[i];
                            break;
                        }
                    }

                    if (found) {
                        // console.log(found_data['price']);

                        $(`#tan_narxi${DeleteModel}`).val(found_data['price']);

                        // console.log(found_data['model_structures']);
                        let array = [];
                        found_data['model_structures'].forEach(element => {
                            const materialInBase = materials.find((material) => material
                                .material_id === element.material_id)
                            const nimadir = materialInBase.quantity / element.value;
                            // console.log(nimadir);
                            array.push(nimadir);
                        });
                        // console.log(array);
                        // console.log(array.sort()[0]);

                        const formattedMaxNumber = array.sort()[0].toLocaleString('en-US');
                        $(`#count${DeleteModel}`).attr('placeholder', `Макс. ${formattedMaxNumber}`);
                        // $(`#count${DeleteModel}`).attr('max', array.sort()[0]);
                    } else {
                        // console.log(model_id, DeleteModel, $(`#razmer_${DeleteModel}`));
                        $(`#razmer_${DeleteModel}`).append(`<div class="form-group">
                                        <label for="user">Размер ${DeleteModel}</label>
                                        <input type="text" name="model_ids[${DeleteModel-1}]['size']" id="size1" class="form-control"
                                            placeholder="Размер">
                                    </div>`);
                    }
                })
                // let natija = $('#natija').val(0);
                // Add
                for (let i = 1; i <= DeleteModel; i++) {
                    const count = $(`#count${i}`)

                    count.change(function() {

                        let natija = $('#natija').val(0);
                        let sotish_narxi = $('#sotish_narxi').val(0);
                        let skidka = $('#skidka').val();
                        // console.log(natija, sotish_narxi, skidka);
                        for (let k = 1; k <= DeleteModel; k++) {

                            for (let index = 1; index <= data.length; index++) {

                                let count1 = Number($(`#count${k}`).val());

                                let model1 = Number($(`#model_onklik${k}`).val());

                                // console.log(model1, count1);

                                if (data[index - 1].id == model1) {

                                    let totalPrice = data[index - 1].price * count1;
                                    let test = Number(natija.val()) + Number(totalPrice);
                                    // console.log(totalPrice);
                                    natija.val(test);
                                    sotish_narxi.val(test + (test / 100 * Number(skidka)));
                                }

                            }
                        }

                    });

                }
            }

            $('.app_count').click(function() {

                let words = $(this).data('app_count').split(", ");

                // console.log($(this).data('app_count'));

                // console.log(words[0]);

                // Edit Model Protsent
                $(`#skidka_update${words[0]}`).change(function() {

                    // console.log($(this).val()[0]);

                    let skidka_update = Number($(this).val()[0]);
                    let natija_update = Number($(`#natija_update${words[0]}`).val());
                    let sotish_narxi = $(`#sotish_narxi${words[0]}`);

                    // console.log(skidka_update, natija_update);

                    sotish_narxi.val(natija_update + natija_update / 100 * skidka_update);

                    // console.log(sotish_narxi.val());

                });

                $(`#sotish_narxi${words[0]}`).change(function() {

                    let sotish_narxi = Number($(this).val());

                    let natija_update = Number($(`#natija_update${words[0]}`).val());

                    let skidka_update = $(`#skidka_update${words[0]}`);

                    let protsent = ((sotish_narxi / natija_update * 100) - 100).toFixed(2);
                    skidka_update.empty();
                    skidka_update.append(`
                    <option value="${protsent}" selected>${protsent} %</option>
                    <option value="0">0 %</option>
                    <option value="-10">-10</option>
                    <option value="-20">-20</option>
                    <option value="-30">-30</option>
                    `);

                    // console.log(sotish_narxi, natija_update, protsent);

                });

                $('.edit_modal').click(function() {
                    // alert(123);
                    $(`#skidka${words[0]})`).select2({
                        tags: true
                    });
                });

                // console.log(words[1]);

                let app_count = $(this).data('app_count');

                // Update
                for (let l = 1; l <= words[1]; l++) {

                    $(`#count_up${words[0]}${l}`).change(function() {

                        // let count_up = $(this).val();
                        let natija_update = $(`#natija_update${words[0]}`).val(0);

                        let skidka_update = Number($(`#skidka_update${words[0]}`).val());

                        let sotish_narxi = Number($(`#sotish_narxi${words[0]}`).val());


                        for (let k = 1; k <= words[1]; k++) {


                            let model_onklik_up_id = $(`#model_onklik_up${words[0]}${k}`).val();

                            let count_up = $(`#count_up${words[0]}${k}`).val();

                            // console.log('Model : ', model_onklik_up_id, ' Count : ', count_up);

                            for (let i = 0; i < data.length; i++) {
                                if (data[i]['id'] == model_onklik_up_id) {

                                    let date_price = data[i]['price'];

                                    let update_price = natija_update.val() * 1 + count_up *
                                        date_price;

                                    let nat1 = Number(natija_update.val(update_price));

                                    $(`#sotish_narxi${words[0]}`).val(update_price + update_price /
                                        100 * skidka_update);

                                    // console.log(skidka_update, update_price,
                                    //     sotish_narxi);
                                }
                            }
                        }


                        // console.log(count_up, model_onklik_up_id, ' Value : ', natija_update.val());

                    });

                }

            });

            $('#customer').change(function() {
                var customerId = $(this).val();
                console.log(customerId);
                $.ajax({
                    url: '/applications/' + customerId,
                    type: 'get',
                    success: function(data) {
                        var firmDropdown = $('#firm');
                        firmDropdown.empty();
                        console.log(data.firms);
                        $.each(data.firms, function(index, firm) {
                            firmDropdown.append('<option value="' + firm.id + '">' +
                                firm.name + " |  Итого долги : " +
                                firm.debtors_sum +
                                '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Ajax Error:', error);
                    }
                });

            });

            let optionCounter = 2; // Start with 2 or any initial value

            // Button qo'shish
            $('#addOptionBtn').on('click', function() {
                const newSelect = `<div class="row" id="optionRow${optionCounter}">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="name">Имя клиента</label>
                                        <input type="text" id="name" name="customer_name" class="form-control" placeholder="Имя клиента">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="Phone">Телефон</label>
                                        <input type="text" name="phone" id="Phone" class="form-control" placeholder="Телефон (+998 94 105 04 05)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="Phone">Фирма</label>
                                        <input type="text" name="firma" id="Firma" class="form-control" placeholder="Фирма">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-4">
                                <span class="btn btn-outline-danger delete-model-input"
                                    data-id="${optionCounter}">
                                    <i class="icon-cross3"></i>
                                </span>
                            </div>
                        </div>`;

                $('#addOptionBtn').toggleClass('d-none');
                $('#selectOptions').append(newSelect);
                // optionCounter++;
            });
            // Tugma uchun o'chirish
            $('#selectOptions').on('click', '.delete-model-input', function() {

                const rowId = $(this).data('id');

                $('#optionRow' + rowId).remove();
                $('#addOptionBtn').toggleClass('d-none');

            });

            let DeleteModel = 1;
            $('#addModel').on('click', function() {

                const newModel = `
                <div class="row" id="DeleteModelCoutn${DeleteModel+1}">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="model">Название модели ${DeleteModel+1}</label>
                            <select name="model_ids[${DeleteModel}]['model_id']" id="model_onklik${DeleteModel+1}" class="form-control select-multiple-tags"
                                multiple="multiple" data-fouc>
                                @foreach ($models as $model)
                                    <option value="{{ $model->id }}">
                                        {{ $model->name_size }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="user">Цена  ${DeleteModel+1}</label>
                            <input type="number" name="tan_narxi" id="tan_narxi${DeleteModel+1}" readonly class="form-control"
                                placeholder="Цена">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="user">Количество ${DeleteModel+1}</label>
                            <input type="number" name="model_ids[${DeleteModel}]['count']" id="count${DeleteModel+1}" onchange="kalichestvaOrqaliXisoblash(${DeleteModel+1})" required class="form-control"
                                placeholder="Количество">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="user">Итог ${DeleteModel+1}</label>
                            <input type="text" name="sum" readonly id="itodo_summa${DeleteModel+1}" class="form-control"
                                placeholder="Итог">
                        </div>
                    </div>
                    <div class="col-lg-2" style="min-width: 100px !important;" id="razmer_${DeleteModel + 1}">

                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <span class="btn btn-outline-danger model-delete-count mt-4"
                                    data-id="${DeleteModel+1}">
                                    <i class="icon-cross3"></i>
                                </span>
                        </div>
                    </div>
                </div>
                `;
                DeleteModel++;


                $('#NewModel').append(newModel);

                calculate(DeleteModel)

                $('.select-multiple-tags').select2({
                    tags: true
                });

            });

            calculate(DeleteModel)


            $('#NewModel').on('click', '.model-delete-count', function() {

                const rowId = $(this).data('id');
                console.log(DeleteModel);
                let count1 = $(`#count${rowId}`).val();
                let model1 = $(`#model_onklik${rowId}`).val()[0];

                let natija = $('#natija');
                console.log(count1);
                let sotish_narxi = $('#sotish_narxi');

                let tan_narxi = $(`#tan_narxi${rowId}`).val();
                let skidka = $(`#skidka`).val();

                let totalPrice = Number(tan_narxi) * Number(count1);
                let updatedTotal = Number(natija.val()) - totalPrice;
                natija.val(updatedTotal);
                sotish_narxi.val(updatedTotal + (updatedTotal / 100 * skidka));
                $.ajax({
                    url: '/applicationPrice/' + model1,
                    type: 'get',
                    success: function(data) {
                        let totalPrice = data.model.price * count1;
                        let updatedTotal = Number(natija.val()) - totalPrice;
                        natija.val(updatedTotal);
                        console.log('delete');
                    },
                    error: function(error) {
                        console.error('Ajax Error:', error);
                    }
                });

                $('#DeleteModelCoutn' + rowId).remove();

            });


            $('#skidka').change(function() {
                let skidka = parseFloat($(this).val()); // Convert to a number
                let natija = parseFloat($('#natija').val());

                if (!isNaN(skidka) && !isNaN(natija)) {
                    let sotish_narxi = parseFloat((natija + (natija / 100 * skidka)).toFixed(0));
                    $('#sotish_narxi').val(sotish_narxi);
                } else {
                    console.error('Invalid input for skidka or natija');
                }
            });


            $('#sotish_narxi').change(function() {

                let sotish_narxi = $(this).val();
                let natija = $('#natija').val();
                let ayirma = Number(sotish_narxi) - Number(natija);

                let protsent = (ayirma / natija * 100);

                protsent = Number(protsent).toFixed(2);
                let node = `<option value="${protsent}" selected>${protsent} %</option>
                            <option value="0">0 %</option>
                            <option value="10">10 %</option>
                            <option value="20">20 %</option>
                            <option value="30">30 %</option>`;
                $('#skidka').empty();
                $('#skidka').append(node);
                // console.log(sotish_narxi, natija, ayirma, protsent);
            });

            $('.model-delete-update-id').click(function() {

                let natijaString = $(this).data('delete_id');

                natijaString = natijaString.split(',');

                let count_model = Number($(`#count_up${natijaString[0] + natijaString[1]}`).val());

                let model_product_id = Number(natijaString[2]);

                let application_model_product = Number(natijaString[3]);

                // console.log(application_model_product);

                // console.log(natijaString[0] + natijaString[1], count_model, model_product_id);

                $(`#update-model-delete${natijaString[0] + natijaString[1]}`).remove();

                $.ajax({
                    url: 'delete-application-model-product/' +
                        application_model_product,
                    type: 'get',
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.error('Ajax Error:', error);
                    }
                });

                let skidka_update = Number($(`#skidka_update${natijaString[0]}`).val());

                let natija_update = Number($(`#natija_update${natijaString[0]}`).val());

                let sotish_narxi = Number($(`#sotish_narxi${natijaString[0]}`).val());

                for (let modal_id = 0; modal_id < data.length; modal_id++) {

                    if (data[modal_id].id == model_product_id) {

                        // console.log(data[modal_id]);

                        let oxrgi_natija = $(`#natija_update${natijaString[0]}`).val(natija_update - (
                            Number(data[
                                    modal_id]
                                .price) *
                            count_model));

                        console.log('oxrgi_natija : ', oxrgi_natija.val(), 'Sotilish narxi : ', $(
                            `#sotish_narxi${natijaString[0]}`).val());

                        $(`#sotish_narxi${natijaString[0]}`).val(Number(oxrgi_natija.val()) + (Number(
                            oxrgi_natija
                            .val()) / 100 * skidka_update));

                    }

                }

            });


        });

        function kalichestvaOrqaliXisoblash(id) {
            console.log(id);
            const count = document.getElementById(`count${id}`);
            const tan_narxi = document.getElementById(`tan_narxi${id}`);
            const itodo_summa = document.getElementById(`itodo_summa${id}`);

            let itogoSumma = Number(count.value) * Number(tan_narxi.value);
            itodo_summa.value = itogoSumma;
            console.log('Count - ', count.value);
            console.log('Itogo - ', itodo_summa.value);
            console.log('Tannarx - ', tan_narxi.value);

            // count.change(function() {
            //     console.log('bu function orqali logs');
            // });
        }

        function kalichestvaOrqaliXisoblashUp(id) {
            console.log(id);
            const count = document.getElementById(`count_up${id}`);
            const tan_narxi = document.getElementById(`price_up${id}`);
            const itodo_summa = document.getElementById(`itogo_up${id}`);

            let itogoSumma = Number(count.value) * Number(tan_narxi.value);
            itodo_summa.value = itogoSumma;
            console.log('Count - ', count.value);
            console.log('Itogo - ', itodo_summa.value);
            console.log('Tannarx - ', tan_narxi.value);

            // count.change(function() {
            //     console.log('bu function orqali logs');
            // });
        }
    </script>
@endsection
