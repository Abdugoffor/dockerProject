@extends('../index')

@section('title', 'Invoce list')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">


        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Yuboruvchi : {{ $model->yuboruvchi }} , Qabulqiluvchi : {{ $model->qabulqiluvchi }} ,
                    Date : {{ $model->date }}</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Stok</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Value</th>
                        <th>Sum</th>
                        <th>Expiration date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model->materials as $material)
                        <tr>
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->material_stok->name }}</td>
                            <td>{{ $material->name }}</td>
                            <td>{{ $material->unit }}</td>
                            <td>{{ $material->price }}</td>
                            <td>{{ $material->value }}</td>
                            <td>{{ $material->sum }}</td>
                            <td>{{ $material->expiration_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
