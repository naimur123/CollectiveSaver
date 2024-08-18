@extends('masterPage')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5>{{ ucfirst( str_replace(['_','-'], ' ', $pageTitle) ) }}</h5>
                    </div>
                    @if( isset($create) && $create )
                        <div class="col-4 text-right">
                            <a class="btn btn-primary btn-sm" href="{{ $create }}">Create new</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
&nbsp;
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered nowrap">
                        <thead class="{{ isset($tableStyleClass) ? $tableStyleClass : 'bg-success'}}">
                            <tr>
                                @foreach($tableColumns as $column)
                                    <th> @lang('table.'.$column)</th>
                                @endforeach
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="loader" style="display: none;">
    <img src="{{ asset('loading.gif') }}" width="70" alt="Loading">
</div>

<script type="module">
    let table;
    $(document).ready(function() {
        $.noConflict();
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            // ajax: '{{ isset($dataTableUrl) && !empty($dataTableUrl) ? $dataTableUrl : URL::current() }}',
            ajax:{
                url: '{{ isset($dataTableUrl) && !empty($dataTableUrl) ? $dataTableUrl : URL::current() }}',
                beforeSend: function() {
                    $('#loader').show();
                },
                complete: function() {
                    $('#loader').hide();
                }
            },
            columns: [
                @foreach($dataTableColumns as $column)
                    { data: '{{ $column }}', name: '{{ $column }}' },
                @endforeach
            ],
            "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
        });
    });
</script>

@endsection
