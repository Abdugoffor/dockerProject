@extends('../index')

@section('title', '403')

@section('con')
    <div class="content">

        <div class="content d-flex justify-content-center align-items-center pt-0">

            <div class="flex-fill">

                <!-- Error title -->
                <div class="text-center mb-4">
                    <img src="../../../../global_assets/images/error_bg.svg" class="img-fluid mb-3" height="230"
                        alt="">
                    <h1 class="display-2 font-weight-semibold line-height-1 mb-2">403</h1>
                    <h6 class="w-md-25 mx-md-auto">Oops, an error has occurred. <br> The resource requested
                        could not be found on this server.</h6>
                </div>
                <!-- /error title -->


                <!-- Error content -->
                <div class="text-center">
                    <a href="/login" class="btn btn-primary"><i class="icon-home4 mr-2"></i>Login</a>
                </div>
                <!-- /error wrapper -->

            </div>
        </div>
    </div>

@endsection
