@extends('../index')

@section('title', 'Ежемесячно зарплат')

@section('con')
    <!-- Content area -->

    <div class="content pt-0 mt-5">
        {{-- @if (Auth::user()->hasPermissionTo('user.create'))
            <button type="button" class="btn btn-light mb-2" data-toggle="modal" data-target="#modal_default">Equipment
                create</button>
        @endif --}}
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

        <!-- Page length options -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Зарплата</h3>
                <h2 class="card-title">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h2>
            </div>
            @if (Auth::user()->hasPermissionTo('salary.search'))
                <form action="{{ route('salary.search') }}" method="get">
                    <div class="d-flex m-0">
                        @csrf

                        <div class="col-2">
                            <!-- Select All option -->
                            <div class="form-group">
                                <input type="date" id="ot" name="date" class="form-control">
                            </div>
                        </div>

                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-primary">Фильтр</button>
                        </div>
                    </div>
                </form>
            @endif

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Зарплата</th>
                        <th>Отделение</th>
                        <th>Сумма</th>
                        <th>Рабочее время</th>
                        <th>Оплата</th>
                        <th>Штраф</th>
                        @foreach ($salaryTypes as $type)
                            <th style="min-width: 15%">{{ $type->name }}</th>
                        @endforeach
                        <th>Штрафы</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stafs as $staf)
                        <tr>
                            <td>{{ $staf->id }}</td>
                            <td>{{ $staf->name }}</td>
                            <td>
                                <a href="#" class="mb-2" data-toggle="modal"
                                    data-target="#modal_default1{{ $staf->id }}">{{ $staf->salary_type->name }}
                                </a>
                                <!-- Basic modal -->
                                <div id="modal_default1{{ $staf->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content pb-5">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ежемесячно и штрафы</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <h2 class="text-center">
                                                {{-- {{ \Carbon\Carbon::parse($salary->date)->format('M-Y') }} --}}
                                            </h2>
                                            <div class="table-responsive mb-5">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>#</th>
                                                            <th>Тип</th>
                                                            <th>Сумма</th>
                                                            <th>Дата</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($staf->salary->count() > 0)
                                                            @php
                                                                $s = 0;
                                                            @endphp
                                                            @foreach ($staf->salary as $salary)
                                                                <tr class="text-center">
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $salary->type->name }}</td>
                                                                    <td>{{ number_format($salary->value) }}</td>
                                                                    <td>{{ $salary->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $s = $s + $salary->value;
                                                                @endphp
                                                            @endforeach
                                                            {{-- <tr>
                                                                <td colspan="4" class="text-center">Jami : {{ number_format($s, 0, '.', ' , ') }}</td>
                                                            </tr> --}}
                                                        @else
                                                            <tr colspan="4">
                                                                <td>Ежемесячно не указано</td>
                                                            </tr>
                                                        @endif
                                                        @php
                                                            $k = 0;
                                                        @endphp
                                                        @if ($staf->fines->count() > 0)
                                                            @foreach ($staf->fines as $fine)
                                                                <tr class="bg-danger text-center">
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>Штраф</td>
                                                                    <td>{{ number_format($fine->valeu) }}</td>
                                                                    <td>{{ $fine->created_at->format('d-m-Y H:i:s') }}
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $k = $k + $fine->valeu;
                                                                @endphp
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <table class="table table-bordered mt-2">
                                                    <tr>
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>Ежемесячно</th>
                                                                <th>Сумма</th>
                                                                <th>Штраф</th>
                                                                <th>Осталось</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="text-center">
                                                                <td>
                                                                    Время - {{ $staf->dateTabels->sum('clock') }},<br>
                                                                    В час - {{ number_format($staf->hourly) }}, <br>
                                                                    Зарплата - {{ number_format($staf->dateTabels->sum('clock') * $staf->hourly) }}
                                                                </td>
                                                                <td>{{ isset($s) ? number_format($s) : '' }}</td>
                                                                <td>{{ number_format($k) }}</td>
                                                                <td>
                                                                    {{ number_format(isset($s) ? $staf->sum - $s - $k : $staf->sum - $k) }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </tr>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
                            </td>
                            <td>{{ $staf->department->name }}</td>
                            <td>{{ number_format($staf->sum, 0, '.', ' , ') }}</td>
                            <td>
                                время : {{ $staf->working_time }} / в час : {{ number_format($staf->hourly) }}
                                {{-- {{ number_format($staf->working_time * $staf->sum, 0, '.', ' , ') }} <br> --}}
                                {{-- Soat - {{ $staf->dateTabels->sum('clock') }},<br>
                                Soatiga - {{ number_format($staf->sum) }}, <br>
                                Oylik - {{ number_format($staf->dateTabels->sum('clock') * $staf->sum) }} --}}
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('salary.create'))
                                    <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                        data-target="#modal_default{{ $staf->id }}">Оплата</button>
                                @endif
                                <!-- Oylik berish modal -->
                                <div id="modal_default{{ $staf->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Оплата</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('salary.create') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect12">Cотрудников</label>
                                                        <input type="text" value="{{ $staf->name }}"
                                                            class="form-control" readonly>
                                                        <input type="hidden" name="staf_id" id="exampleFormControlSelect12" value="{{ $staf->id }}">
                                                    </div>
                                                    
                                                    <div class="mb-3 position-relative">
                                                        <label for="date">Дата</label>
                                                        <input type="date" id="date" name="date"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Виды зарплат</label>
                                                        <select class="form-control" name="type_id"
                                                            id="exampleFormControlSelect1">
                                                            <option selected disabled>Виды зарплат</option>
                                                            @foreach ($salaryTypes as $type)
                                                                <option value="{{ $type->id }}">
                                                                    {{ $type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="sum">Сумма</label>
                                                        <input type="text" id="sum" name="summa"
                                                            class="form-control" placeholder="Сумма">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="com">Комментарий</label>
                                                        <textarea class="form-control" id="com" name="comment" placeholder="Комментарий" rows="3"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрывать</button>
                                                    <button type="submit" class="btn btn-primary">Сохранять</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
                            </td>
                            <td>
                                @if (Auth::user()->hasPermissionTo('fines.create'))
                                    <button type="button" class="btn btn-light mb-2" data-toggle="modal"
                                        data-target="#modal_defaultjarima{{ $staf->id }}">Штраф</button>
                                @endif
                                <!-- Jarima berish modal -->
                                <div id="modal_defaultjarima{{ $staf->id }}" class="modal fade" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Штраф</h5>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('fines.create') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Cотрудников</label>
                                                        <input type="text" value="{{ $staf->name }}"
                                                            class="form-control" readonly>
                                                        <input type="hidden" name="staf_id"
                                                            value="{{ $staf->id }}">
                                                    </div>

                                                    <div class="mb-3 position-relative">
                                                        <label for="date">Дата</label>
                                                        <input type="date" id="date" name="date"
                                                            class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="sum">Сумма</label>
                                                        <input type="text" id="sum" name="summa"
                                                            class="form-control" placeholder="Сумма">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="com">Комментарий</label>
                                                        <textarea class="form-control" id="com" name="comment" placeholder="Комментарий" rows="3"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-dismiss="modal">Закрывать</button>
                                                    <button type="submit" class="btn btn-primary">Сохранять</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /basic modal -->
                            </td>
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($salaryTypes as $type)
                                @if (!empty($staf->salary))
                                    <td>
                                        @foreach ($staf->salary as $salary)
                                            @if ($salary->type_id == $type->id)
                                                @php
                                                    $sum = $sum + $salary->value;
                                                @endphp
                                                <li class="media">
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#modal_defaultoylik{{ $salary->id }}">{{ number_format($salary->value, 0, '.', ' , ') }}
                                                        sum</a>
                                                    <div id="modal_defaultoylik{{ $salary->id }}" class="modal fade"
                                                        tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{ $staf->name }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">×</button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <h3>
                                                                        {{ $salary->created_at->format('d - M - Y H:i') }}
                                                                    </h3>
                                                                    <h1>
                                                                        {{ $type->name }} :
                                                                        {{ number_format($salary->value, 0, '.', ' , ') }}
                                                                        sum
                                                                    </h1>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal"
                                                                        class="btn btn-primary">Закрывать</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            {{-- <span>Jami : {{ $sum }}</span> --}}
                                        @endforeach

                                    </td>
                                @else
                                    <td>0</td>
                                @endif
                            @endforeach
                            <td>
                                @foreach ($staf->fines as $fine)
                                    <li class="media">
                                        <a href="#" data-toggle="modal" class="text-danger"
                                            data-target="#modal_defaultoylikjarima{{ $fine->id }}">{{ number_format($fine->valeu, 0, '.', ' , ') }}
                                            sum</a>
                                        <div id="modal_defaultoylikjarima{{ $fine->id }}" class="modal fade"
                                            tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $staf->name }}</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">×</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <h3>
                                                            {{ $fine->created_at->format('d - M - Y H:i') }}
                                                        </h3>
                                                        <h1>
                                                            Штраф :
                                                            {{ number_format($fine->valeu, 0, '.', ' , ') }}
                                                            sum
                                                        </h1>
                                                        <p><b>Комментарий : </b>{{ $fine->comment }}</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-primary">Закрывать</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->
@endsection
