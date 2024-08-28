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
                        <input type="hidden" name="id" value="{{ $group_data->id ?? 0 }}">
                        <hr/>
                    </div>

                    <!--Select Group Name -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Group Name<span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" name="group_id" data-live-search="true">
                                <option value="">Select</option>
                                @foreach($user_groups as $group)
                                   <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Members Handsontable -->
                    <div class="col-12 mt-4">
                        <h4>Members</h4>
                        <div id="members-handsontable"></div>
                        <input type="hidden" name="members" id="members-data">
                    </div>


                    <!--submit -->
                    <div class="col-12 text-right py-2">
                        <div class="form-group text-right">
                            <button type="submit" id="group_submit" class="btn btn-info">Submit </button>
                        </div>
                    </div>

                </form>
             </div>
         </div>
     </div>
</div>
<script type="module">
   $(document).ready(function() {
    $('.selectpicker').selectpicker();
   });
</script>

@endsection
