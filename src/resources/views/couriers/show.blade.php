@extends('../index')

@section('title', 'Список курьеров')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-4">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <a href="{{ route('courier.list') }}" class="btn btn-light mb-2"><i class="icon-arrow-left52 mr-2"></i> Список
                курьеров</a>
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


        <!-- /basic modal -->

        <!-- Page length options -->
        <div class="card mt-3">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset($courier->staf->img) }}" alt="{{ $courier->staf->name }}">
                                    </div>

                                    <h3 class="profile-username text-center">{{ $courier->staf->name }}</h3>

                                    <p class="text-center">{{ $courier->staf->department->name }}</p>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Имя</th>
                                                <th>{{ $courier->staf->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Телефон</th>
                                                <th><a href="tel:{{ $courier->phone }}">{{ $courier->phone }}</a></th>
                                            </tr>
                                            <tr>
                                                <th>Отделение</th>
                                                <th>{{ $courier->car_number }}</th>
                                            </tr>
                                            <tr>
                                                <th>Рабочее время</th>
                                                <th>{{ $courier->staf->working_time }}</th>
                                            </tr>
                                            <tr>
                                                <th>Тип зарплаты</th>
                                                <th>{{ $courier->staf->salary_type->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Зарплата</th>
                                                <th>{{ number_format($courier->staf->sum) }}</th>
                                            </tr>
                                            <tr>
                                                <th>Файл</th>
                                                <th><a href="{{ $courier->staf->file }}" target="_blank">Файл</a></th>
                                            </tr>
                                            <tr>
                                                <th>Адрес</th>
                                                <th>
                                                    <p>
                                                        {{ $courier->staf->adres }}
                                                    </p>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Статус</th>
                                                <th>
                                                    @if ($courier->status == 1)
                                                        <a href="{{ route('courier.status', $courier->id) }}"
                                                            class="badge badge-success">
                                                            Активный
                                                        </a>
                                                    @else
                                                        <a href="{{ route('courier.status', $courier->id) }}"
                                                            class="badge badge-danger">
                                                            Приостановленный
                                                        </a>
                                                    @endif
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <!-- Post -->
                                            <div class="post">
                                                <h3>Описание</h3>
                                                <p>
                                                    {{ $courier->staf->text }}
                                                </p>
                                            </div>
                                            <!-- /.post -->
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /page length options -->


    </div>
    <!-- /content area -->

@endsection
