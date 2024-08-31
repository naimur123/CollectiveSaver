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
                    <div class="col-8 col-sm-6 col-md-4 my-2">
                        <div class="form-group">
                            <label>Group Name<span class="text-danger">*</span></label>
                            <select class="form-control" name="group_id" id="group_id">
                                <option value="">Select</option>
                                @foreach($user_groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Fund Handsontable -->
                    <div class="col-12 mt-4">
                        <h4>Fund</h4>
                        <div id="fund-handsontable"></div>
                        <input type="hidden" name="fund_info" id="fund-data">
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
        var container = document.getElementById('fund-handsontable');
        var hot = new Handsontable(container, {
            licenseKey: 'non-commercial-and-evaluation',
            data: [],
            startRows: 1,
            startCols: 3,
            rowHeaders: true,
            colHeaders: ['Member Name', 'Amount', 'Transfered From'],
            columns: [
                {
                    type: 'dropdown',
                    source: [],
                    data: 0
                },
                { data: 1 },
                { data: 2 }
            ],
            stretchH: 'all',
            minSpareRows: 1,
            minSpareRows: 1,
            autoWrapRow: true,
            autoWrapCol: true,
            contextMenu: true,
            rowHeights: 40,
            readOnly: true
        });

        $('#group_id').change(function() {
            var group_id = $(this).val();
            var url = '{{ isset($group_fund_individual) ? $group_fund_individual : URL::current() }}';
            hot.loadData([]);
            $.ajax({
                url: url,
                type: 'GET',
                data: { id: group_id },
                success: function(response) {
                    var members = response.members_name || [];
                    if (members.length > 0) {
                        hot.updateSettings({
                            columns: [
                                {
                                    type: 'dropdown',
                                    source: members,
                                    data: 0
                                },
                                { data: 1 },
                                { data: 2 }
                            ],
                            readOnly: false
                        });
                    } else {
                        set_alert('warning', 'No members found');
                    }
                },
                error: function(xhr) {
                    set_alert('error', xhr);
                }
            });
        });
    });
</script>

@endsection
