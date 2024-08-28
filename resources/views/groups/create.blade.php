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

                    <!-- Group Name -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Group Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("name") ?? ($group_data->name ?? "")}}" name="name" required >
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account type -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account type<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("account_type") ?? ($group_data->account_type ?? "")}}" name="account_type" required >
                            @error('short_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account name -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("account_name") ?? ($group_data->account_name ?? "")}}" name="account_name" required >
                            @error('account_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account number -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("account_number") ?? ($group_data->account_number ?? "")}}" name="account_number" required >
                            @error('account_number')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Account details -->
                    <div class="col-12 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Account details<span class="text-danger">*</span></label>
                            <input type="textarea" class="form-control " value="{{ old("details") ?? ($group_data->details ?? "")}}" name="details" >
                            @error('details')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
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
    $(document).ready(function(){
        var membersData = [
            @if(old('members_data'))
                {!! old('members_data') !!}
            @elseif(isset($group_data->members))
                @foreach($group_data->members as $member)
                  ["{{ $member[0] }}", "{{ $member[1] }}", "{{ $member[2] }}"],
                @endforeach
            @else
                ["", "", ""]
            @endif
        ];
        var container = document.getElementById('members-handsontable');
        var hot = new Handsontable(container, {
            licenseKey: 'non-commercial-and-evaluation',
            data: membersData,
            startRows: 1,
            startCols: 3,
            rowHeaders: true,
            colHeaders: ['Name', 'Email', 'Phone'],
            columns: [
                {data: 0, type: 'text'},
                {data: 1, type: 'text'},
                {data: 2, type: 'text'}
            ],
            stretchH: 'all',
            minSpareRows: 1,
            minSpareRows: 1,
            autoWrapRow: true,
            autoWrapCol: true,
            contextMenu: true
        });

        $('form').on('submit', function(e) {
            // var members = hot.getData();
            var members_data = $('#members-data');
            members_data.val(JSON.stringify(hot.getData()));
        });
    });
</script>

@endsection
