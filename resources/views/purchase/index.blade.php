@extends('layouts.master')

@section('CSS')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('page-title')
    Purchase
@endsection

@section('content')
    <div class="container-fluid">
        {{ Form::open(array('autocomplete' => 'off') ) }}
        {{-- purchase header --}}
        <div class="row">
            <div class="col-md-6">

                <?php date_default_timezone_set('Asia/Dhaka') ?>
                <div class="form-group">
                    {!! Form::label('date', 'Date') !!}
                    {!! Form::input('text', 'date', date('m/d/Y'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('vendor_id', 'Vendor') !!}
                    {!! Form::select('vendor_id', [], null, ['class' => 'form-control']) !!}
                </div>

            </div>
            {{-- ./ col-md-6 --}}
            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('purchased_by', 'Purchased By') !!}
                    {!! Form::input('text', 'purchased_by', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('document', 'Attach Document') !!}
                    {{ Form::file('document', ['class' => 'form-control']) }}
                </div>

            </div>
            {{-- ./ col-md-6 --}}
        </div>
        {{-- ./ end of purchase header --}}
        <hr />

        {{-- purchase details --}}
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('product_id', 'Product') !!}
                    {!! Form::select('product_id', [], null, ['class' => 'form-control']) !!}
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('unit', 'Unit') !!}
                    {!! Form::input('unit', 'unit', null, ['class' => 'form-control', 'readonly']) !!}
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('quantity', 'Quantity') !!}
                    {!! Form::input('quantity', 'quantity', null, ['class' => 'form-control']) !!}
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('price', 'Price') !!}
                    {!! Form::input('text', 'price', null, ['class' => 'form-control']) !!}
                </div>

            </div>
        </div>

        {{ Form::close() }}

        <div class="row container-fluid" >
            <div class="form-group pull-right">
                <button class="btn btn-default btn-lg" style="margin: 5px">Cancel</button>
                <button id="addBtn" class="btn btn-primary btn-lg" style="margin: 5px">Add</button>
            </div>
        </div>
        {{-- ./ end of purchase header --}}

        {{-- purchase details table --}}
        
        <div id="addTable"></div>
{{-- <hr/>

        <div class="box">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="row container-fluid">
                    <div style="overflow-x:auto;">

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr style="background-color: lightskyblue">
                                <th>SL</th>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row" style="text-align: center">
                    <button class="btn btn-success btn-lg">Save</button>
                </div>
            </div>

        </div> --}}
    </div>

@endsection

@section('JavaScript')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#date").datepicker();
        });

        $(document).ready(function () {

            var unit_arr = new Array();

            var GetVendorDDL = function () {

                $('#vendor_id').empty();
                var defaultOption = "<option value='' selected>Select a vendor</option>";
                $('#vendor_id').append(defaultOption);

                $.ajax({
                    type: "GET",
                    url: "/vendor/GetAll",
                    success: function (data) {
                        
                        $.each(data, function (key, object) {

                            var value = object.id;
                            var text = object.name;

                            var option = "<option value=" + value + ">" + text + "</option>";
                            $('#vendor_id').append(option);
                        });
                    }
                });
            };

            var GetProductDDL = function () {

                $('#product_id').empty();
                var defaultOption = "<option value='' selected>Select a product</option>";
                $('#product_id').append(defaultOption);

                $.ajax({
                    type: "GET",
                    url: "/product/GetAll",
                    success: function (data) {
                        
                        $.each(data, function (key, object) {

                            unit_arr[object.name] = object.unit.short_name;
                            var value = object.id;
                            var text = object.name;

                            var option = "<option value=" + value + ">" + text + "</option>";
                            $('#product_id').append(option);
                        });
                    }
                });

            };

            GetVendorDDL();
            GetProductDDL();

            $('#product_id').change(function () {

                var key = $('#product_id option:selected').text();

                $('#unit').val(unit_arr[key]);
            });

            var addTable = $.noop;

            
            
            $('#addBtn').click(function () {
                
                var boxDiv = document.createElement('div');
                boxDiv.className = 'box';

                var boxHeaderDiv = document.createElement('div');
                boxHeaderDiv.className = 'box-header';

                var boxBodyDiv = document.createElement('div');
                boxBodyDiv.className = 'box-body';

                var containerDiv = document.createElement('div');
                containerDiv.className = 'row container-fluid';
                containerDiv.setAttribute('style', 'overflow-x:auto');

                var tableHtml = '<table class="table table-bordered table-striped">'+
                                    '<thead>'+
                                        '<tr style="background-color: lightskyblue">'+
                                            '<th>SL</th>'+
                                            '<th>Product</th>'+
                                            '<th>Unit</th>'+
                                            '<th>Quantity</th>'+
                                            '<th>Price</th>'+
                                            '<th>Total Price</th>'+
                                        '</tr>'+
                                    '</thead>';

                containerDiv.innerHTML = tableHtml;

                boxBodyDiv.appendChild(containerDiv);

                boxHeaderDiv.appendChild(boxBodyDiv);

                boxDiv.appendChild(boxHeaderDiv);

                document.getElementById('addTable').appendChild(boxDiv);
            });
            
            
        });
    </script>

@endsection