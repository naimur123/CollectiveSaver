@extends('masterPage')

@section('content')

<div class="row">
        <div class="col-md-4 col-12">
            <div class="card bg-c-green">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white mx-2 my-2">320</h4>
                            <h6 class="text-white mx-2">Total Customer</h6>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <a href="#" class="text-white text-decoration-none">Customers</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card bg-warning bg-gradient">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white mx-2 my-2"></h4>
                            <h6 class="text-white mx-2">Total Vendor</h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="text-white text-decoration-none">Vendors</a>
                </div>
            </div>
        </div>
</div>


@endsection
