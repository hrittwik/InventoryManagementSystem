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

    {{-- dialog form --}}
    <div id="detailsDialog">

        {{ Form::open(array('id' => 'detailsForm', 'autocomplete' => 'off') ) }}

            <div class="container-fluid">
                <br/>

                <div class="row form-group">

                    {{ Form::label('name', 'Name:', array('class' => 'col-md-4', 'style' => 'text-align: center')) }}
                    {{ Form::text('name', null, array('class' => 'col-md-8', 'id' => 'name') ) }}

                    {{ Form::hidden('id', null, array('id' => 'id')) }}

                </div>

                <div class="row form-group">

                    {{ Form::label('short_name', 'Short Name:', array('class' => 'col-md-4', 'style' => 'text-align: center')) }}
                    {{ Form::text('short_name', null, array('class' => 'col-md-8', 'id' => 'short_name') ) }}

                </div>

                <div class="row form-group">

                    {{ Form::label('unit_id', 'Unit:', array('class' => 'col-md-4', 'style' => 'text-align: center')) }}
                    {!! Form::select('unit_id', [], null, ['class' => 'col-md-8']) !!}

                </div>

                <div class="row form-group">

                    {{ Form::label('description', 'Description:', array('class' => 'col-md-4', 'style' => 'text-align: center')) }}
                    {{ Form::textarea('description', null, array('class' => 'col-md-8', 'rows' => '4', 'style' => 'resize: none') ) }}

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

