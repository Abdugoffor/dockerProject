@extends('../index')

@section('title', 'Обновление телефона и пароля')

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
        @if (session('text'))
            <div class="alert bg-teal alert-rounded alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <span class="font-weight-semibold">{{ session('text') }}!</span>
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active mt-2" id="solid-justified-tab2">
                                        <form action="{{ route('edit.password') }}" method="post">
                                            @csrf
                                            <fieldset class="mb-3">
                                                <label class="col-form-label col-lg-2">Телефон</label>
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="text" name="phone" class="form-control"
                                                        placeholder="Телефон" value="{{ Auth::user()->phone }}">
                                                    <div class="form-control-feedback">
                                                        <i class="icon-phone2 text-muted"></i>
                                                    </div>
                                                </div>
                                                <label class="col-form-label col-lg-2">Пароль</label>
                                                <div class="form-group form-group-feedback form-group-feedback-left">
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Пароль">
                                                    <div class="form-control-feedback">
                                                        <i class="icon-lock2 text-muted"></i>
                                                    </div>
                                                </div>

                                            </fieldset>
                                            <input type="submit" class="btn btn-primary" value="Обновлять" name="ok"
                                                id="">
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
    <!-- /content area -->
@endsection
