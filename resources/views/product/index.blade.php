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

    <div id="jsGrid"></div>

    {{-- dialog form --}}
    <div id="detailsDialog">

        {{ Form::open(array('id' => 'detailsForm', 'autocomplete' => 'off') ) }}

        <div class="container-fluid">
            <div class="row form-group">
                {!! Form::label('name', 'Name:', ['class' => 'col-md-4 col-xs-12']) !!}
                {!! Form::input('text', 'name', null, ['class' => 'col-md-8 col-xs-12']) !!}

                {{ Form::hidden('id', null, array('id' => 'id')) }}
            </div>

            <div class="row form-group">
                {!! Form::label('short_name', 'Short Name:', ['class' => 'col-md-4 col-xs-12']) !!}
                {!! Form::input('text', 'short_name', null, ['class' => 'col-md-8 col-xs-12']) !!}
            </div>

            <div class="row form-group">
                {!! Form::label('unit_id', 'Unit:', ['class' => 'col-md-4 col-xs-12']) !!}
                {!! Form::select('unit_id', [], null, ['class' => 'col-md-8 col-xs-12']) !!}
            </div>

            <div class="row form-group">
                {!! Form::label('description', 'Description:', ['class' => 'col-md-4 col-xs-12']) !!}
                {!! Form::textarea('description', null, array('class' => 'col-md-8 col-xs-12', 'rows' => '4', 'style' => 'resize: none') ) !!}
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

    {{-- Product jsgrid with input dialog and validation --}}
    <script type="text/javascript" src="Scripts/Product/js/product-jsgrid.js"></script>

@endsection

