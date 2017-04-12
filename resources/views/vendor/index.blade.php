@extends('master')

@section('CSS')
    <style>
        .jsgrid-cell {
            overflow: hidden;
        }

        .jsgrid-pager { text-align: center; }
    </style>
    {{-- CSS for jsGrid --}}
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />

@endsection

@section('page-title')
    Vendor
@endsection

@section('content')

    <div id="jsGrid" class="jsgrid-cell jsgrid-pager"></div>

@endsection

@section('JavaScript')

    {{-- JS for jsGrid --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>

    <script type="text/javascript">

        $("#jsGrid").jsGrid({
            width: "100%",
            hight: "70%",

            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autosearch: true,

            pageSize: 10,
            pageButtonCount: 5,

            deleteConfirm: "Do you really want to delete the vendor?",

            noDataContent: "No data found",

            controller: {
                loadData: function (filter) {
                    return $.ajax({
                        type: "GET",
                        url: "Loader/"
                    });
                }  
            },

            fields: [
                { name: "Name", type: "text", width: "33.3%", validate: "required" },
                { name: "Contact", type: "text", width: "33.3%", validate: "required" },
                { name: "Address", type: "text", width: "33.3%", validate: "required" },
                { type: "control", width: "16.66%" }
            ]
        });
    </script>

@endsection