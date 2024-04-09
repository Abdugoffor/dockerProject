@extends('../index')

@section('title', 'Acceptance materials list')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">


        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Yuborilgan / Acceptance</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Yuborilgangan Sklad</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Value</th>
                        <th>Expiration date</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $transfer)
                        @foreach ($transfer->material_stok_values as $material_stok_value)
                            <tr>
                                <td>{{ $material_stok_value->id }}</td>
                                <td>{{ $transfer->to->name }}</td>
                                <td>{{ $material_stok_value->material->name }}</td>
                                <td>{{ $material_stok_value->material->unit }}</td>
                                <td>{{ $material_stok_value->material->price }}</td>
                                <td>{{ $material_stok_value->value }}</td>
                                <td>{{ $material_stok_value->material->expiration_date }}</td>
                                <td>{{ $material_stok_value->created_at }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
