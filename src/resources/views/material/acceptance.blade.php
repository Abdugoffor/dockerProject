@extends('../index')

@section('title', 'Acceptance materials list')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-5">


        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Qabul qilingan / Acceptance</h5>
            </div>

            <table class="table datatable-show-all">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Qabul qilgan Sklad</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Value</th>
                        <th>Expiration date</th>
                        <th>Malumot almashish</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $transfer)
                        @foreach ($transfer->material_stok_values as $material_stok_value)
                            <tr>
                                <td>{{ $material_stok_value->id }}</td>
                                <td>{{ $transfer->from->name }}</td>
                                <td>{{ $material_stok_value->material->name }}</td>
                                <td>{{ $material_stok_value->material->unit }}</td>
                                <td>{{ $material_stok_value->material->price }}</td>
                                <td>{{ $material_stok_value->value }}</td>
                                <td>{{ $material_stok_value->material->expiration_date }}</td>
                                <td>
                                    <!-- Shaer modal -->
                                    <button type="button" class="btn btn-outline-teal mb-2" data-toggle="modal"
                                        data-target="#modal_defaultroleshare{{ $material_stok_value->material->id }}"><i
                                            class="icon-share3"></i></button>
                                    <!-- Shaer modal -->
                                    <div id="modal_defaultroleshare{{ $material_stok_value->material->id }}"
                                        class="modal fade" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Basic modal</h5>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>
                                                <form
                                                    action="{{ route('material.share', [$material_stok_value->material->id, $material_stok_value->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="Name">Name</label>
                                                            <input type="text" name="name" id="Name" disabled
                                                                value="{{ $material_stok_value->material->name }}"
                                                                class="form-control" placeholder="Mame">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Unit">Unit</label>
                                                            <input type="text" id="Unit" name="unit" disabled
                                                                value="{{ $material_stok_value->material->unit }}"
                                                                class="form-control" placeholder="Mame">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Value">Value</label>
                                                            <input type="text" id="Value" name="value"
                                                                max="{{ $material_stok_value->value }}"
                                                                maxlength="{{ $material_stok_value->value }}"
                                                                class="form-control"
                                                                placeholder="Value max ({{ $material_stok_value->value }})">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price">Price</label>
                                                            <input type="text" name="price" disabled id="price"
                                                                value="{{ $material_stok_value->material->price }}"
                                                                class="form-control" placeholder="Price">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Material Stok</label>
                                                            <select class="form-control" name="material_stok_id"
                                                                id="exampleFormControlSelect1">
                                                                <option selected="" disabled="">Material Stok</option>
                                                                @foreach ($material_stoks as $material_stok)
                                                                    <option value="{{ $material_stok->id }}">
                                                                        {{ $material_stok->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-link"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Shaer modal -->
                                </td>
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
