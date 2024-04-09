@extends('../index')

@section('title', 'Список Касса')

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
        <!-- Cart dashbort -->
        <div class="row">
            <div class="col-lg-6">
                <div class="alert alert-info">Между датой : {{ date('d-m-Y', strtotime($startDate)) }} -
                    {{ date('d-m-Y', strtotime($endDate)) }}</div>

                <a href="{{ route('kassa.status', ['key' => 1, 'startDate' => date('d-m-Y', strtotime($startDate)), 'endDate' => date('d-m-Y', strtotime($endDate))]) }}"
                    class="text-white">
                    <!-- Members online -->
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">
                                    {{ number_format($allModels->where('type', 1)->count()) }}
                                </h3>
                                {{-- <span class="badge badge-teal badge-pill align-self-center ml-auto">{{ number_format($models->count()) }}</span> --}}
                            </div>

                            <div>
                                Платежи произведены
                                {{--                                <div class="font-size-sm opacity-75">489 avg</div> --}}
                            </div>
                        </div>

                        <div class="container-fluid">
                            {{-- <div id="members-online"></div> --}}
                        </div>
                    </div>
                    <!-- /members online -->
                </a>
                <a href="{{ route('kassa.status', ['key' => 2, 'startDate' => date('d-m-Y', strtotime($startDate)), 'endDate' => date('d-m-Y', strtotime($endDate))]) }}"
                    class="text-white">
                    <!-- Today's revenue -->
                    <div class="card bg-danger">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">
                                    {{ number_format($allModels->where('type', 2)->count()) }}
                                </h3>
                            </div>

                            <div>
                                Расходы
                                {{--                                <div class="font-size-sm opacity-75">$37,578 avg</div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- /today's revenue -->
                </a>
            </div>

            <div class="col-lg-6">
                <!-- Application status -->
                <div class="card">
                    <div class="card-header header-elements-inline">

                    </div>
                    @php
                        $jami = $allModels->where('type', 1)->sum('sum');

                        // $sum = $allModels->where('type', $key)->where('type_sum', 'Сум')->sum('sum');
                        $sum = $allModels->where('type', 1)->where('type_sum', 'Сум')->sum('sum');
                        
                        // $a1 = $allModels->where('type', 1)->where('type_sum', 'Сум')->sum('sum');
                        $b1 = $allModels->where('type', 2)->where('type_sum', 'Сум')->sum('sum');
                        $sumQ = $sum - $b1;

                        $dollr = $allModels->where('type', 1)->where('type_sum', 'Доллар')->sum('sum');

                        // $a2 = $allModels->where('type', 1)->where('type_sum', 'Доллар')->sum('sum');
                        $b2 = $allModels->where('type', 2)->where('type_sum', 'Доллар')->sum('sum');
                        $dollrQ = $dollr - $b2;

                        $karta = $allModels->where('type', 1)->where('type_sum', 'Карта')->sum('sum');

                        // $a3 = $allModels->where('type', 1)->where('type_sum', 'Карта')->sum('sum');
                        $b3 = $allModels->where('type', 2)->where('type_sum', 'Карта')->sum('sum');
                        $kartaQ = $karta - $b3;

                        $perechesleniya = $allModels->where('type', 1)->where('type_sum', 'Перечесление')->sum('sum');

                        // $a4 = $allModels->where('type', 1)->where('type_sum', 'Перечесление')->sum('sum');
                        $b4 = $allModels->where('type', 2)->where('type_sum', 'Перечесление')->sum('sum');
                        $perechesleniyaQ = $perechesleniya - $b4;

                        if ($jami > 0) {
                            $s1 = ($sum / $jami) * 100;
                            $d1 = ($dollr / $jami) * 100;
                            $k1 = ($karta / $jami) * 100;
                            $p1 = ($perechesleniya / $jami) * 100;
                        } else {
                            $s1 = 0;
                            $d1 = 0;
                            $k1 = 0;
                            $p1 = 0;
                        }
                    @endphp
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <div class="d-flex align-items-center mb-1">Сум , Платежи : {{ number_format($sum) }} , <span class="text-danger">Расходы</span> :
                                    {{ number_format($b1) }}<span
                                        class="text-muted ml-auto">{{ number_format($s1) }}%</span></div>
                                <div class="progress" style="height: 0.375rem;">
                                    <div class="progress-bar bg-info" style="width: {{ $s1 }}%">
                                        <span class="sr-only">{{ $s1 }}% Complete</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-3">
                                <div class="d-flex align-items-center mb-1">Доллар , Платежи : {{ number_format($dollr) }} ,
                                    Расходы : {{ number_format($b2) }}<span
                                        class="text-muted ml-auto">{{ number_format($d1) }}%</span></div>
                                <div class="progress" style="height: 0.375rem;">
                                    <div class="progress-bar bg-danger" style="width: {{ $d1 }}%">
                                        <span class="sr-only">{{ $d1 }}% Complete</span>
                                    </div>
                                </div>
                            </li>

                            <li class="mb-3">
                                <div class="d-flex align-items-center mb-1">Карта , Платежи : {{ number_format($karta) }} , Расходы
                                    : {{ number_format($b3) }}<span
                                        class="text-muted ml-auto">{{ number_format($k1) }}%</span></div>
                                <div class="progress" style="height: 0.375rem;">
                                    <div class="progress-bar bg-success" style="width: {{ $k1 }}%">
                                        <span class="sr-only">{{ $k1 }}% Complete</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="d-flex align-items-center mb-1">Перечесление , Платежи :
                                    {{ number_format($perechesleniya) }} , Расходы :
                                    {{ number_format($b4) }}<span
                                        class="text-muted ml-auto">{{ number_format($p1) }}%</span></div>
                                <div class="progress" style="height: 0.375rem;">
                                    <div class="progress-bar bg-primary" style="width: {{ $p1 }}%">
                                        <span class="sr-only">{{ $p1 }}% Complete</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /application status -->

            </div>
        </div>

        <!-- Cart dashbort -->
        <!-- Page length options -->
        <div class="card mt-3">
            <form action="{{ route('kassa.search', $key) }}" method="get">
                <div class="d-flex m-0 mt-3">
                    @csrf
                    <div class="col-3">
                        <!-- Select All option -->
                        <div class="form-group">
                            <label for="ot">От дата</label>
                            <input type="date" name="start" id="ot" class="form-control">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="do">До дата</label>
                            <input type="date" name="end" id="do" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group col-2 mt-4">
                        <button type="submit" class="btn btn-primary">Поиск</button>
                    </div>
                </div>
            </form>
            <div class="card-header">
                <h2>
                    {{ $key == 1 ? ' Платежи произведены' : ($key == 2 ? ' Расходы' : ($key == 3 ? ' Выгода' : '')) }} ,
                    {{-- Общая сумма : {{ number_format($allModels->where('type', $key)->sum('sum')) }} --}}
                </h2>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Тип</th>
                        <th>Фирма Имя</th>
                        <th>Сумма </th>
                        <th>Описание</th>
                        {{-- <th class="text-center">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ ($models->currentPage() - 1) * $models->perPage() + $loop->iteration }}</td>
                            <td>{{ $model->type == 1 ? 'Платежи ' : 'Расходы' }}</td>
                            <td>
                                {{ $model->application != null
                                    ? $model->application->firma->name
                                    : ($model->nakladnoy != null
                                        ? $model->nakladnoy->shipper
                                        : ($model->boshqa != null
                                            ? $model->boshqa
                                            : '')) }}

                            </td>
                            <td>{{ $model->sum }} , {{ $model->type_sum }}</td>
                            <td>{{ $model->text }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $models->links() }}
        <!-- /page length options -->

    </div>

@endsection
