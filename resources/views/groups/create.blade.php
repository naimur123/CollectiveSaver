@extends('masterPage')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
        <div class="card">
           <div class="card-body">
                <form class="row form-horizontal" action="{{ $form_url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mt-10">
                        <h3>{{ $title ?? "" }}</h3>
                        <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
                        <hr/>
                    </div>
    
                    <!-- Group Name -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Group Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("name") ?? ($data->name ?? "")}}" name="name" required >
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account type -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account type<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("account_type") ?? ($data->account_type ?? "")}}" name="account_type" required >
                            @error('short_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account name -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("account_name") ?? ($data->account_name ?? "")}}" name="account_name" required >
                            @error('account_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account number -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("account_number") ?? ($data->account_number ?? "")}}" name="account_number" required >
                            @error('account_number')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account details -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account details<span class="text-danger">*</span></label>
                            <input type="textarea" class="form-control " value="{{ old("details") ?? ($data->details ?? "")}}" name="details" >
                            @error('details')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
    
                  
                    
                    
                    <!--submit -->
                    <div class="col-12 text-right py-2">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-info">Submit </button>
                        </div>
                    </div>
    
                </form>
             </div>
         </div>
     </div>
</div>

@endsection