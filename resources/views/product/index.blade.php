@extends('layouts.master')

@section('CSS')

    {{--CSS for input error --}}
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/input-error.css" />

    {{-- CSS for responsive jsgrid --}}
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/jsgrid/jsGrid-responsive.css" />

    {{-- CSS for jsGrid --}}
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/jsgrid/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/jsgrid/jsgrid-theme.min.css" />

    {{-- CSS for jquery-UI --}}
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/cupertino/jquery-ui.css">

@endsection

@section('page-title')
    Product
@endsection

@section('content')

    <div id="jsGrid" class="jsgrid-cell jsgrid-pager"></div>

    <div id="detailsDialog">
        <form id="detailsForm" autocomplete="off">
            {{ csrf_field() }}
            <div class="container-fluid">
                <br/>
                <div class="row form-group">
                    <label class="col-md-4" for="name" style="text-align: center">Name:</label>
                    <input class="col-md-8" id="name" name="name" type="text" />
                    <input id="id" name="id" type="hidden" />
                </div>

                <div class="row form-group">
                    <label class="col-md-4" for="short_name" style="text-align: center">Short Name:</label>
                    <input class="col-md-8" id="short_name" name="short_name" type="text" />
                </div>

                <div class="row form-group">
                    <label class="col-md-4" for="unit_id" style="text-align: center">Unit:</label>
                    <input class="col-md-8" id="unit_id" name="unit_id" type="text" />
                </div>

                <div class="row form-group">
                    <label class="col-md-4" for="description" style="text-align: center">Description:</label>
                    <input class="col-md-8" id="description" name="description" type="text" placeholder="Optional"/>
                </div>


                <div class="row form-group" style="text-align: center">
                    <button type="submit" id="save">Save</button>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('JavaScript')

    {{-- JS for jquery-UI --}}
    <script src="Scripts/Common/js/jquery-ui.js"></script>

    {{-- JS for jquery validator --}}
    <script src="Scripts/Common/js/jquery.validate.min.js"></script>
    <script src="Scripts/Common/js/additional-methods.min.js"></script>

    {{-- JS for jsGrid --}}
    <script type="text/javascript" src="Scripts/Common/js/jsgrid.min.js"></script>

    {{-- Product jsgrid with input dialog and validation --}}
    <script type="text/javascript" src="Scripts/Product/js/product-jsgrid.js"></script>

@endsection

