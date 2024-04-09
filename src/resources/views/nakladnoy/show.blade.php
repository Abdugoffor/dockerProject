@extends('../index')

@section('title', $model->shipper)

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">
        <a href="{{ route('nakladnoy.list') }}" class="btn btn-light mb-2"><i class="icon-arrow-left52 mr-2"></i> Список накладной</a>
        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Список накладной</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Накладной</th>
                        <th>Материал</th>
                        <th>Ед. изм.</th>
                        <th>Количество</th>
                        <th>Цена, за единицу</th>
                        <th>Сумма</th>
                        {{-- <th>Срок годности</th> --}}
                        <th class="text-center">Функция</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model->prixods as $prixod)
                        <tr>
                            <td>{{ $prixod->id }}</td>
                            <td>{{ $prixod->nakladnoy->shipper }}</td>
                            <td>{{ $prixod->material->name }}</td>
                            <td>{{ $prixod->unit }}</td>
                            <td>{{ number_format($prixod->quantity) }}</td>
                            <td>{{ number_format($prixod->price) }}</td>
                            <td>{{ number_format($prixod->sum) }}</td>
                            {{-- <td>{{ $prixod->term }}</td> --}}
                            <td>{{ $prixod->created_at->format('Y-m-d H-i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
