@extends('../index')

@section('title', 'Список сотрудников')

@section('con')
    <!-- Content area -->
    <div class="content pt-0 mt-4">
        {{-- {{ Auth::user()->roles->pluck('name')->implode(', ') }} --}}
        @if (Auth::user()->hasPermissionTo('user.create'))
            <a href="{{ route('staf.list') }}" class="btn btn-light mb-2"><i class="icon-arrow-left52 mr-2"></i> Список
                Сотрудник</a>
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
                                        @if ($staf->img != null)
                                            <img class="profile-user-img img-fluid img-circle" src="{{ asset($staf->img) }}"
                                                alt="{{ $staf->name }}">
                                        @else
                                            {{ 'Нет изображения' }}
                                        @endif

                                    </div>

                                    <h3 class="profile-username text-center">{{ $staf->name }}</h3>

                                    <p class="text-center">Отделы : {{ $staf->department->name }}</p>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Имя</th>
                                                <th>{{ $staf->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Телефон</th>
                                                <th><a href="tel:{{ $staf->phone }}">{{ $staf->phone }}</a></th>
                                            </tr>
                                            {{-- <tr>
                                                <th>Телефон login</th>
                                                <th><a href="tel:{{ $staf->user->phone !== null ? $staf->user->phone : ''}}">{{ $staf->user->phone !== null ? $staf->user->phone : ''}}</a></th>
                                            </tr> --}}
                                            <tr>
                                                <th>Отделение</th>
                                                <th>{{ $staf->department->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Рабочее время</th>
                                                <th>{{ $staf->working_time }}</th>
                                            </tr>
                                            <tr>
                                                <th>Тип зарплаты</th>
                                                <th>{{ $staf->salary_type->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Зарплата</th>
                                                <th>{{ number_format($staf->sum) }}</th>
                                            </tr>
                                            <tr>
                                                <th>Файл</th>
                                                <th>
                                                    @if ($staf->file != null)
                                                        <a href="{{ asset($staf->file) }}" target="_blank">Файл</a>
                                                    @else
                                                        {{ 'Нет файла' }}
                                                    @endif
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Адрес</th>
                                                <th>{{ $staf->adres }}</th>
                                            </tr>
                                            {{-- <tr>
                                                <th>Удалить</th>
                                                <th>
                                                    <form action="{{ route('staf.delete', $staf->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                                    </form>
                                                </th>
                                            </tr> --}}
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
                            {{-- <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <!-- Post -->
                                            <div class="post">
                                                <h3>Описание</h3>
                                                <p>
                                                    {{ $staf->text }}
                                                </p>
                                            </div>
                                            <!-- /.post -->
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div> --}}
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">Пользователя : {{ $staf->name }}</h6>
                                </div>

                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                                        <li class="nav-item"><a href="#solid-justified-tab2" class="nav-link active"
                                                data-toggle="tab">Пользовательский</a></li>

                                        <li class="nav-item"><a href="#solid-justified-tab3" class="nav-link"
                                                data-toggle="tab">Пароль устанавит</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active mt-2" id="solid-justified-tab2">

                                            <fieldset class="mb-3">

                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-2">Имя</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" name="name" value="{{ $staf->name }}"
                                                            disabled class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label lang="user" class="col-form-label col-lg-2">Роли
                                                        пользователей</label>
                                                    <div class="col-lg-10">
                                                        @forelse ($staf->user->user->roles ?? [] as $item)
                                                            <span class="btn btn-info">{{ $item->name }}</span>
                                                        @empty
                                                            <span class="btn btn-info">Нет роли пользователя и пароля</span>
                                                        @endforelse

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-2">Телефон</label>
                                                    <div class="col-lg-10">
                                                        <input type="text"
                                                            value="{{ $staf->user && $staf->user->user ? $staf->user->user->phone : $staf->phone }}"
                                                            name="phone" required class="form-control"
                                                            placeholder="Тел : {{ $staf->user && $staf->user->user ? $staf->user->user->phone : $staf->phone }}"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="tab-pane fade mt-2" id="solid-justified-tab3">
                                            <form
                                                action="{{ $staf->user && $staf->user->user ? route('update.role', $staf->id) : route('add.user', $staf->id) }}"
                                                method="post">
                                                @csrf

                                                <fieldset class="mb-3">

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-2">Имя</label>
                                                        <div class="col-lg-10">
                                                            <input type="text" name="name"
                                                                value="{{ $staf->name }}" readonly class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label lang="user" class="col-form-label col-lg-2">Роли
                                                            пользователей</label>
                                                        <div class="col-lg-10">
                                                            <select multiple="multiple" name="roles[]" id="user"
                                                                required class="form-control select" data-fouc>
                                                                @foreach ($roles as $role)
                                                                    <option
                                                                        {{ $staf->user && $staf->user->user ? (collect($staf->user->user->roles)->contains('name', $role->name) ? 'selected' : '') : '' }}
                                                                        value="{{ $role->name }}">
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-2">Телефон</label>
                                                        <div class="col-lg-10">
                                                            <input type="text"
                                                                value="{{ $staf->user && $staf->user->user ? $staf->user->user->phone : $staf->phone }}"
                                                                name="phone" required class="form-control"
                                                                placeholder="Тел : {{ $staf->user && $staf->user->user ? $staf->user->user->phone : $staf->phone }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-2">Пароль</label>
                                                        <div class="col-lg-10">
                                                            <input type="password" name="pas" class="form-control"
                                                                placeholder="Пароль">
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">
                                                        Сохранить <i class="icon-paperplane ml-2"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    <script>
        // $(document).ready(function() {
        //     $('.click').on('click', function() {
        //         $('.select-multiple-tags').select2({
        //             tags: true
        //         });
        //     });
        // })
    </script>
@endsection
