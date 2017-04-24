@extends('layouts.master')

@section('CSS')

    {{-- jquery ui css --}}
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

   {{--CSS for input error --}}
   <link type="text/css" rel="stylesheet" href="Scripts/Common/css/input-error.css" />
@endsection

@section('page-title')
    Purchase
@endsection

@section('content')
    <div class="container-fluid">

        <form id="addForm" autocomplete="off">
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
        </form>
            {{-- ./ end of purchase header --}}
            <hr />

        <form id="purchaseDetails">
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

            <div class="row container-fluid" >
                <div class="form-group pull-right">
                    <input type="reset" class="btn btn-default btn-lg" style="margin: 5px" value="Cancel" />
                    <input id="addBtn" type="reset" class="btn btn-primary btn-lg" style="margin: 5px" value="Add"/>

                </div>
            </div>
        </form>
        {{-- ./ end of purchase header --}}

        <div id="addTable">
            {{-- purchase details table here --}}

        </div>

    </div>

@endsection

@section('JavaScript')

    {{-- jquery ui js --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- JS for jquery validator --}}
    <script src="Scripts/Common/js/jquery.validate.min.js"></script>
    <script src="Scripts/Common/js/additional-methods.min.js"></script>

    <script>
        $(function() {
            $("#date").datepicker();
        });

        $(document).ready(function () {

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

            var unit_arr = new Array();
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

            var makeTable = $.noop;

            makeTable = function() {
                var boxDiv = document.createElement('div');
                boxDiv.className = 'box';

                var boxHeaderDiv = document.createElement('div');
                boxHeaderDiv.className = 'box-header';

                var boxBodyDiv = document.createElement('div');
                boxBodyDiv.className = 'box-body';

                var containerDiv = document.createElement('div');
                containerDiv.className = 'row container-fluid';
                containerDiv.setAttribute('style', 'overflow-x:auto');

                var tableHtml = '<table class="table table-bordered table-striped">' +
                                    '<thead>' +
                                        '<tr style="background-color: lightskyblue">' +
                                            '<th>SL</th>' +
                                            '<th>Product</th>' +
                                            '<th>Unit</th>' +
                                            '<th>Quantity</th>' +
                                            '<th>Price</th>' +
                                            '<th>Total Price</th>' +
                                        '</tr>' +
                                    '</thead>' +
                                    '<tbody id="tableBody"></tbody>';

                containerDiv.innerHTML = tableHtml;

                boxBodyDiv.appendChild(containerDiv);

                boxHeaderDiv.appendChild(boxBodyDiv);

                boxDiv.appendChild(boxHeaderDiv);

                document.getElementById('addTable').appendChild(boxDiv);
            };

            $('#addBtn').click(function () {

                var validForm = $('#addForm').valid();
                var purchaseDetailsForm = $('#purchaseDetails').valid();

                if(!$('table').length && validForm && purchaseDetailsForm) {
                    makeTable();
                }


            });

            $('#addForm').validate({
                rules: {
                    vendor_id: "required"
                },
                messages: {
                    vendor_id: "Please enter contact information",
                }
            });

            $('#purchaseDetails').validate({
                rules: {
                    product_id: "required"
                },
                messages: {
                    product_id: "Please enter contact information",
                }
            });
        });
    </script>

@endsection