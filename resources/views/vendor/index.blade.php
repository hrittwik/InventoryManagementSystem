@extends('layouts.master')

@section('CSS')

    {{--CSS for input error --}}
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/input-error.css" />

    {{-- CSS for responsive jsgrid --}}
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/jsgrid/jsGrid-responsive.css" />

    {{-- CSS for jsGrid Capitalization--}}
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/jsgrid/jsGrid-Capitalization.css" />

    {{-- CSS for jsGrid --}}
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/jsgrid/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="Scripts/Common/css/jsgrid/jsgrid-theme.min.css" />

    {{-- CSS for jquery-UI --}}
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/cupertino/jquery-ui.css">

@endsection

@section('page-title')
    Vendor
@endsection

@section('content')

    <div id="jsGrid" class="jsgrid-cell jsgrid-pager"></div>

    <div id="detailsDialog">

        {{ Form::open( array('id' => 'detailsForm', 'autocomplete' => 'off') ) }}

            <div class="container-fluid">
                <br/>
                <div class="row form-group">

                    {{ Form::label('name', 'Name:', array('class' => 'col-md-4', 'style' => 'text-align: center')) }}
                    {{ Form::text('name', null, array('class' => 'col-md-8', 'id' => 'name') ) }}

                    {{ Form::hidden('id', null, array('id' => 'id')) }}

                </div>

                <div class="row form-group">

                    {{ Form::label('contact', 'Contact:', array('class' => 'col-md-4', 'style' => 'text-align: center')) }}
                    {{ Form::text('contact', null, array('class' => 'col-md-8', 'id' => 'contact') ) }}

                </div>

                <div class="row form-group">

                    {{ Form::label('address', 'Address:', array('class' => 'col-md-4', 'style' => 'text-align: center')) }}
                    {{ Form::text('address', null, array('class' => 'col-md-8', 'id' => 'address') ) }}

                </div>


                <div class="row form-group" style="text-align: center">

                    {{ Form::submit('Save', array('id' => 'save') ) }}

                </div>
            </div>

        {{ Form::close() }}

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

    {{-- Vendor jsgrid with input dialog and validation --}}
    <script type="text/javascript" src="Scripts/Vendor/js/vendor-jsgrid.js"></script>

@endsection