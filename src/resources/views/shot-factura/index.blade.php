@extends('../index')

@section('title', 'Счёт-фактура')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">

        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Заявки</h5>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="10%">Продавец</th>
                        <th width="10%">Фирма</th>
                        <th width="">Фирма Тел.</th>
                        <th width="15%">Количество Модель</th>
                        <th width="10%">Стоимость</th>
                        <th width="10%">Процент</th>
                        <th width="10%">Сумма</th>
                        <th width="15%">Долг</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->id }}</td>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->firma->name }}</td>
                            <td>
                                <a href="tel:{{ $application->firma->prone1 }}">{{ $application->firma->prone1 }}</a> ,
                                <a href="tel:{{ $application->firma->prone2 }}">{{ $application->firma->prone2 }}</a>
                            </td>
                            <td>
                                <span class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#modal_default{{ $application->id }}">{{ number_format($application->application_model_products->count()) }}</span>
                                <!-- Basic modal -->
                                <div id="modal_default{{ $application->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Заявка</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="border p-3 rounded">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Имя продукта</th>
                                                            <th>Количество</th>
                                                        </tr>
                                                        @foreach ($application->application_model_products as $application_model_product)
                                                            <tr>
                                                                <td>{{ $application_model_product->id }}</td>
                                                                <td>{{ $application_model_product->model_product->name_size }}
                                                                </td>
                                                                <td>{{ $application_model_product->count }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
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
                            <td>{{ number_format($application->sum) }}</td>
                            <td>{{ number_format($application->protsent) }}</td>
                            <td>{{ number_format($application->payment) }}</td>
                            <td>{{ number_format($application->debtor) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $applications->links() }}
        </div>
    </div>
    <!-- /content area -->
@endsection
