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

        <form id="purchaseHeaderForm" autocomplete="off">
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

            <div class="row">
                <div class="form-check col-md-6">

                    <legend>Purchase option:</legend>
                    <div class="form-group">
                        {!! Form::radio('price_type', '1', true, ['class' => 'form-check-input']) !!}
                        {!! Form::label('price_type', 'On credit') !!}
                    </div>

                    <div class="form-group">
                        {!! Form::radio('price_type', '1', false, ['class' => 'form-check-input']) !!}
                        {!! Form::label('price_type', 'On account') !!}
                    </div>

                    <div class="form-group">
                        {!! Form::radio('price_type', '1', false, ['class' => 'form-check-input']) !!}
                        {!! Form::label('price_type', 'On cash') !!}
                    </div>

                </div>
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
                    <input id="addBtn" type="reset" class="btn btn-primary btn-lg" style="margin: 5px" value="Add"/>
                    <input type="reset" class="btn btn-default btn-lg" style="margin: 5px" value="Cancel" />

                </div>
            </div>
        </form>
        {{-- ./ end of purchase header --}}

        {{--<div id="addTable">
            --}}{{-- purchase details table here --}}{{--
            <input type="hidden" id="csrf_token" name="_token" value="{{ csrf_token() }}"/>
        </div>--}}
        {!! Form::open(array('id' => 'addTable', 'method' => 'post', 'action' => 'PurchaseController@store', 'onsubmit' => 'return Validate()')) !!}

        {!! Form::close() !!}
    </div>

@endsection

@section('JavaScript')

    {{-- jquery ui js --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- JS for jquery validator --}}
    <script src="Scripts/Common/js/jquery.validate.min.js"></script>
    <script src="Scripts/Common/js/additional-methods.min.js"></script>

    {{-- method reference to load vendor dropdownlist --}}
    <script>
        function Validate() {

            var purchase_header_validation = $('#purchaseHeaderForm').valid();

            //alert(purchase_header_validation);

            if(purchase_header_validation == true) {
                var header_inputs = GetPurchaseHeaderInfo();

                console.log(header_inputs);

                $('#addTable').append(header_inputs);

                return true;
            }

            return false;
        }

        /* method reference to load purchase header info */
        function GetPurchaseHeaderInfo() {

            var date_field = $('#date').val();
            var purchased_by_field = $('#purchased_by').val();
            var vendor_id_field = $('#vendor_id').val();
            var file_path_field = $('#document').val();

            var form_input_string = "<input type='hidden' name='purchase_header[0][date]' value='" + date_field +"' />" +
                "<input type='hidden' name='purchase_header[0][purchased_by]' value='" + purchased_by_field +"' />" +
                "<input type='hidden' name='purchase_header[0][vendor_id]' value='" + vendor_id_field +"' />" +
                "<input type='hidden' name='purchase_header[0][file_path]' value='" + file_path_field +"' />";

            return form_input_string;
        }

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

    {{-- method reference for product dropdownlist and unit disabled name --}}
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

    {{-- page specific js --}}
    <script>
        $(function() {
            $("#date").datepicker();
        });

        $(document).ready(function () {

            /* calling method to load vendor ddl */
            GetVendorDDL();

            /* calling method to load product ddl and get unit name array */
            var unit_arr = GetProductDDL();

            /* js to load unit name in unit field based on option selected on product ddl */
            $('#product_id').change(function () {

                var key = $('#product_id option:selected').text();

                $('#unit').val(unit_arr[key]);
            });

            /* method to make talbe */
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
                                    '<tbody id="tableBody"></tbody></table>' +
                                    '<div class="container-fluid" style="text-align: center">' +
                                        '<input id="submit_btn" type="submit" class="btn btn-success btn-lg" value="Save"/>' +
                                    '</div>';

                containerDiv.innerHTML = tableHtml;

                boxBodyDiv.appendChild(containerDiv);

                boxHeaderDiv.appendChild(boxBodyDiv);

                boxDiv.appendChild(boxHeaderDiv);

                document.getElementById('addTable').appendChild(boxDiv);
            }

            /* on click event of add button making a table if doesn't exist and forms are valid */
            $('#addBtn').click(function () {

                var purchaseHeaderForm = $('#purchaseHeaderForm').valid();
                var purchaseDetailsForm = $('#purchaseDetails').valid();

                if(!(purchaseHeaderForm == true && purchaseDetailsForm == true)) {
                    return false;
                }

                if(!$('table').length) {
                    makeTable();
                }

                if(document.getElementById('submit_btn').disabled) {
                    document.getElementById('submit_btn').disabled = false;
                }

                var product_name = $('#product_id option:selected').text();
                var product_id = $('#product_id').val();
                var unit = $('#unit').val();
                var quantity = $('#quantity').val();
                var price = $('#price').val();

                var index = $('#tableBody>tr').length;
                var row_id = "tr-"+index;

                var hidden_input = '<input type="hidden" name="purchase_details[' + index + '][product_id]" value="' + product_id + '" />' +
                            '<input type="hidden" name="purchase_details[' + index + '][unit]" value="' + unit + '" />' +
                            '<input type="hidden" name="purchase_details[' + index + '][quantity]" value="' + quantity + '" />' +
                            '<input type="hidden" name="purchase_details[' + index + '][price]" value="' + price + '" />';

                var trData = "<tr id='" + row_id + "'>" +
                                "<td><b>" + (index + 1) + "</b>" + hidden_input + "</td>" +
                                "<td>" + product_name + "</td>" +
                                "<td>" + unit + "</td>" +
                                "<td>" + quantity + "</td>" +
                                "<td>" + price + "</td>" +
                                "<td>" + price + "</td>" +
                                "<td style='text-align: center'><i class='btn btn-xs btn-danger fa fa-times' onclick=removeRow(\'" + row_id + "\')></i></td>" +
                            "</tr>";

                $('#tableBody').append(trData);

            });

            /* for validating purchase header form  */
            $('#purchaseHeaderForm').validate({
                rules: {
                    vendor_id: "required"
                },
                messages: {
                    vendor_id: "Please select a vendor"
                }
            });

            /* for validating purchase details form */
            $('#purchaseDetails').validate({
                rules: {
                    //product_id: "required"
                },
                messages: {
                    product_id: "Please select a product"
                }
            });
        });

    
    </script>

    {{-- method to  remove row from table --}}
    <script>
        function removeRow(row_id) {
            if(row_id !== '') {
                var row = $(document.getElementById(row_id));
                var siblings = row.siblings();

                if(siblings.length == 0) {
                    document.getElementById('submit_btn').disabled = true;
                }

                var parent = document.getElementById("tableBody");
                var child = document.getElementById(row_id);

                parent.removeChild(child);

                var last_row_id = 'tr-' + $('#tableBody>tr').length;

                if(last_row_id != row_id) {
                    /* doesnt require to reindex each row and hidden inputs */

                    siblings.each(function(index) {
                        var new_row_id = 'tr-' + index;

                        this.setAttribute('id', new_row_id);
                        var no_hidden_inputs = $(this).children('td').first().children('b').siblings();

                        no_hidden_inputs.each(function () {
                            /* update hidden input indexes */

                            var hidden_input_name = this.name;
                            hidden_input_name = hidden_input_name.replace(/[0-9]/g, index);

                            this.setAttribute('name', hidden_input_name);
                        });

                        $(this).children('td').first().children('b').text(index + 1);
                        $(this).children('td').last().children('i').attr('onclick', 'removeRow(\'' + new_row_id+ '\')');
                    });
                }

            }
        }
    </script>
@endsection