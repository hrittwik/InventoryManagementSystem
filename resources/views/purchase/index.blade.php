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

    {{-- vendor dropdownlist --}}
    <script>
        function GetVendorDDL() {

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
        }
    </script>

    {{-- product dropdownlist and unit disabled name --}}
    <script>

        function GetProductDDL() {
            var unit_arr = new Array();

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

            return unit_arr;
        }

    </script>

    <script>
        $(function() {
            $("#date").datepicker();
        });

        $(document).ready(function () {

            GetVendorDDL();
            var unit_arr = GetProductDDL();

            $('#product_id').change(function () {

                var key = $('#product_id option:selected').text();

                $('#unit').val(unit_arr[key]);
            });

            function makeTable() {
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
                                            '<th></th>' +
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

                if(!(validForm == true && purchaseDetailsForm == true)) {
                    return false;
                }

                if(!$('table').length) {
                    makeTable();
                }

                var purchase_header_input_fields = getPurchaseHeaderInfo();

                var product_name_field = $('#product_id option:selected').text();
                var product_id_field = $('#product_id').val();
                var unit_field = $('#unit').val();
                var quantity_field = $('#quantity').val();
                var price_field = $('#price').val();

                var product_id_input = "<input type='hidden' name='product_id' value='" + product_id_field + "' />";
                var unit_input = "<input type='hidden' name='unit' value='" + unit_field + "' />";
                var quantity_input = "<input type='hidden' name='quantity' value='" + quantity_field + "' />";
                var price_input = "<input type='hidden' name='price' value='" + price_field + "' />";

                var index = $('#tableBody>tr').length;
                var row_id = "tr-"+index;

                var trData = "<tr id='" + row_id + "'>" +
                                "<td>" + (index + 1) + "</td>" +
                                "<td>" + product_name_field + "</td>" +
                                "<td>" + unit_field + "</td>" +
                                "<td>" + quantity_field + "</td>" +
                                "<td>" + price_field + "</td>" +
                                "<td>" + price_field + "</td>" +
                                "<td style='text-align: center'><i class='btn btn-xs btn-danger fa fa-times' onclick=removeRow(\'" + row_id + "\')></i></td>" +
                            "</tr>";

                $('#tableBody').append(trData);

            });

            function getPurchaseHeaderInfo() {

                var date_field = $('#date').val();
                var purchased_by_field = $('#purchased_by').val();
                var vendor_id_field = $('#vendor_id').val();
                var file_path_field = $('#document').val();

                var form_input_string = "<input type='hidden' name='date' value='" + date_field +"' />" +
                                    "<input type='hidden' name='purchased_by' value='" + purchased_by_field +"' />" +
                                    "<input type='hidden' name='vendor_id' value='" + vendor_id_field +"' />" +
                                    "<input type='hidden' name='file_path' value='" + file_path_field +"' />";

                return form_input_string;
            }

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
                    //product_id: "required"
                },
                messages: {
                    product_id: "Please enter contact information"
                }
            });
        });


    </script>

    {{-- row remove from table --}}
    <script>
        function removeRow(row_id) {
            if(row_id !== '') {
                var row = $(document.getElementById(row_id));
                var siblings = row.siblings();

                $('#'+row_id).remove();

                siblings.each(function(index) {
                    var new_row_id = 'tr-' + index;
                    $(this).children('td').first().text(index + 1);
                    $(this).children('td').last().children('i').attr('onclick', 'removeRow(\'' + new_row_id+ '\')');
                    this.setAttribute('id', new_row_id);
                });
            }
        }
    </script>
@endsection