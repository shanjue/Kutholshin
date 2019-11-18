@extends('layouts.app')

@section('css')
<style>
    td.details-control {
        background: url('/images/details_open.png') no-repeat center center;
        cursor: pointer;
        width: 18px;
        background-size:1rem 1rem; 
    }
    tr.shown td.details-control {
        background: url('/images/details_close.png') no-repeat center center;
        cursor: pointer;
        width: 18px;
        background-size:1rem 1rem; 
    },
    
</style>
@endsection

@section('content')

<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th></th>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Count</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

@endsection

@section('js')

<script id="details-template" type="text/x-handlebars-template">
        <div class="label label-info">User @{{ name }}'s Posts</div>
        <table class="table details-table" id="posts-@{{id}}">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </script>
<script>
    var template = Handlebars.compile($("#details-template").html());

    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('laraveldatatable3.data') !!}',
        columns: [{
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": ''
            },
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'postcount',
                name: 'postcount',
                orderable: false, searchable: false
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [
            [1, 'asc']
        ]
    });

    // Add event listener for opening and closing details
    $('#users-table tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'posts-' + row.data().id;

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(template(row.data())).show();
            initTable(tableId, row.data());
            tr.addClass('shown');
            tr.next().find('td').addClass('no-padding bg-gray');
        }
    });

     function initTable(tableId, data) {
        $('#' + tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: data.details_url,
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        })
    }
</script>
@endsection