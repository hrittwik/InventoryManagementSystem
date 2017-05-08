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

        <form id="purchaseHeaderForm" method="POST" action="/purchase/store" autocomplete="off">
            {!! csrf_field() !!}
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
                <div class="col-md-6">

                    <div class="form-group">
                        {!! Form::label('amountPaid', 'Amount paid') !!}
                        {!! Form::input('text', 'amountPaid', null, ['class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
        </form>
            {{-- ./ end of purchase header --}}
            <hr />

        <form id="purchaseDetails" method="POST" action="/purchase/store">
            {!! csrf_field() !!}
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
                        {!! Form::input('text', 'quantity', null, ['class' => 'form-control']) !!}
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        {!! Form::label('rate', 'Rate') !!}
                        {!! Form::input('text', 'rate', null, ['class' => 'form-control', 'placeholder' => 'Price per unit']) !!}
                    </div>

                </div>

            </div>

            <div class="row container-fluid" >
                <div class="form-group pull-right">
                    <input id="addBtn" type="button" class="btn btn-primary btn-lg" style="margin: 5px" value="Add" onclick="addRow()"/>
                    <input type="reset" class="btn btn-default btn-lg" style="margin: 5px" value="Cancel" onclick="resetForm()"/>

                </div>
            </div>
        </form>
        {{-- ./ end of purchase header --}}

        {{-- table div --}}
        {!! Form::open(array('id' => 'tableForm', 'method' => 'post', 'files' => true , 'action' => 'PurchaseController@store', 'onsubmit' => 'return Validate()')) !!}

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
        }).on('change', function (event) {
            $('#date').valid();
        });

        $(document).ready(function () {

            $('#amountPaid').keyup(function () {
                var amount_paid = ($('#amountPaid').val() != '' ? $('amountPaid').val() : 0);
                $('#amount_paid').text(amount_paid);
            });
            /* calling method to load vendor ddl */
            GetVendorDDL();

            /* calling method to load product ddl and get unit name array */
            var unit_arr = GetProductDDL();

            /* js to load unit name in unit field based on option selected on product ddl */
            $('#product_id').change(function () {

                var key = $('#product_id option:selected').text();

                $('#unit').val(unit_arr[key]);
            });


            /* call addRow method on Enter keypress */
            $('#product_id, #unit, #quantity, #rate').keypress(function (e) {
                if (e.which == 13) {
                    addRow();
                }
            });

            $.validator.addMethod("date_before_tomorrow", function (value, element) {
                var date_valid = true;

                var currentDate = new Date();
                var givenDate = new Date(value);

                if(givenDate.getTime() > currentDate.getTime()) {
                    date_valid = false;
                }

                return date_valid;

            }, "The date must be a date before tomorrow");

            /* for validating purchase header form  */
            $('#purchaseHeaderForm').validate({
                rules: {
                    date: {
                        required: true,
                        date: true,
                        date_before_tomorrow: true
                    }
                    // purchased_by: {
                    //     required: true,
                    //     lettersonly: true
                    // },
                    // document: {
                    //     required: true,
                    //     extension: "png|jpeg|jpg"
                    // },
                    // vendor_id: "required",
                    // amountPaid: "number"
                },
                messages: {
                    document: {
                        extension: "The document must be a file of type: png, jpeg, jpg"
                    },
                    amountPaid: "The value should be a number"
                }
            });

            /* for validating purchase details form */
            $('#purchaseDetails').validate({
                rules: {
                    product_id: "required",
                    // rate: {
                    //     required: true,
                    //     number: true
                    // },
                    // quantity: {
                    //     required: true,
                    //     number: true
                    // }
                }
            });
        });


    </script>

    {{-- method to  remove row from table --}}
    <script>
        /* method validates purchase header form before posting */
        function Validate() {
            /*
            *  $('#purchaseHeaderForm').valid() is jquery validation plugin method
            * */
            var purchase_header_validation = $('#purchaseHeaderForm').valid();

            if(purchase_header_validation == true) {

                /* GetPurchaseHeaderInfo() adds the header input fields to the form for posting */
                GetPurchaseHeaderInfo();

                return true;
            }

            return false;
        }

        /* method to reset purchasde details form */
        function resetForm() {
            $('#purchaseDetails').validate().resetForm();
        }

        /* method reference to load purchase header info */
        function GetPurchaseHeaderInfo() {

            var date_field = $('#date').clone();
            date_field.attr('style', 'display: none');

            var purchased_by_field = $('#purchased_by').clone();
            purchased_by_field.attr('style', 'display: none');

            var vendor_id_field = $('#vendor_id').clone();
            vendor_id_field.attr('style', 'display: none');

            var document_field = $('#document').clone();
            document_field.attr('style', 'display: none');

            var amount_paid_field = $('#amountPaid').clone();
            var amountPaid = ($('#amountPaid').val() != '' ? $('#amountPaid').val() : 0);
            amount_paid_field.attr('value', amountPaid);
            amount_paid_field.attr('style', 'display: none');

            $('#tableForm').append(date_field);
            $('#tableForm').append(purchased_by_field);
            $('#tableForm').append(vendor_id_field);
            $('#tableForm').append(document_field);
            $('#tableForm').append(amount_paid_field);
        }

        /* method to make table */
        function makeTable() {
            var boxDiv = document.createElement('div');
            boxDiv.className = 'box';
            boxDiv.setAttribute('id', 'boxDiv');

            var boxHeaderDiv = document.createElement('div');
            boxHeaderDiv.className = 'box-header';

            var boxBodyDiv = document.createElement('div');
            boxBodyDiv.className = 'box-body';

            var containerDiv = document.createElement('div');

            var amount_paid = ($('#amountPaid').val() != '' ? $('#amountPaid').val() : 0);

            var tableHtml = '<div class="row container-fluid" style="overflow-x:auto"><table class="table table-bordered table-striped">' +
                '<thead>' +
                '<tr style="background-color: lightskyblue">' +
                '<th>SL</th>' +
                '<th>Product</th>' +
                '<th>Unit</th>' +
                '<th>Quantity</th>' +
                '<th>Rate</th>' +
                '<th>Price (&#x9f3;)</th>' +
                '<th></th>' +
                '</tr>' +
                '</thead>' +
                '<tbody id="tableBody"></tbody></table></div>' +
                '<div class="row form-group container-fluid"><div class="col-lg-4 col-lg-offset-8 col-md-6 col-md-offset-6 col-sm-6 col-sm-offset-6 col-xs-6 col-xs-offset-6">' +
                '<b>Amount Paid:&nbsp;&nbsp;<span id="amount_paid">' + amount_paid + '</span></b><br/>' +
                '<b>Total Amount:&nbsp;&nbsp;<span id="total_amount"></span></b>' +
                '</div></div>' +
                '<div class="row container-fluid">' +
                '<div class="form-group pull-right">' +
                '<input id="submit_btn" type="submit" class="btn btn-success btn-lg" style="margin: 5px" value="Save" onclick="if(confirm(\'Do you want to continue?\')) return true; else return false;"/>' +
                '</div></div>';

            containerDiv.innerHTML = tableHtml;

            boxBodyDiv.appendChild(containerDiv);

            boxHeaderDiv.appendChild(boxBodyDiv);

            boxDiv.appendChild(boxHeaderDiv);

            document.getElementById('tableForm').appendChild(boxDiv);
        }

        /* method adds row with purchase details data */
        function addRow() {
            /*
            * $('#purchaseHeaderForm').valid() & $('#purchaseDetails').valid()
            * is jquery validation plugin method
            * */
            var purchaseHeaderForm = $('#purchaseHeaderForm').valid();
            var purchaseDetailsForm = $('#purchaseDetails').valid();

            if(!(purchaseHeaderForm == true && purchaseDetailsForm == true)) {
                return false;
            }

            /*
            * if no table tag exist the page a table is created
            * */
            if(!$('#boxDiv').length) {
                makeTable();
            } else {
                /*
                * enable save button if save button is disabled
                * */
                if(document.getElementById('submit_btn').disabled) {
                    document.getElementById('submit_btn').disabled = false;
                }
            }



            var product_name = $('#product_id option:selected').text();
            var product_id = $('#product_id').val();
            var unit = $('#unit').val();
            var quantity = ($('#quantity').val() != '' ? $('#quantity').val() : 0);
            var rate = ($('#rate').val() != '' ? $('#rate').val() : 0);
            var price = rate * quantity;

            var index = $('#tableBody>tr').length;
            var row_id = "tr-"+index;

            var hidden_input = '<input type="hidden" name="purchase_details[' + index + '][product_id]" value="' + product_id + '" />' +
                '<input type="hidden" name="purchase_details[' + index + '][unit]" value="' + unit + '" />' +
                '<input type="hidden" name="purchase_details[' + index + '][quantity]" value="' + quantity + '" />' +
                '<input type="hidden" name="purchase_details[' + index + '][rate]" value="' + rate + '" />' +
                '<input type="hidden" name="purchase_details[' + index + '][price]" value="' + price + '" />';


            /* update total_price */
            var total_amount = $('#total_amount').text();
            if(total_amount == '') total_amount = 0;
            total_amount = parseInt(total_amount, 10) + parseInt(price, 10);
            $('#total_amount').text(total_amount);

            var trData = "<tr id='" + row_id + "'>" +
                "<td><b>" + (index + 1) + "</b>" + hidden_input + "</td>" +
                "<td>" + product_name + "</td>" +
                "<td>" + unit + "</td>" +
                "<td>" + quantity + "</td>" +
                "<td>" + rate + "</td>" +
                "<td>" + price + "</td>" +
                "<td style='text-align: center'><i class='btn btn-xs btn-danger fa fa-times' onclick=removeRow(\'" + row_id + "\')></i></td>" +
                "</tr>";

            $('#tableBody').append(trData);

            /* reset form after adding row and focusing on product for next input */
            $('#product_id').focus();
            document.getElementById('purchaseDetails').reset();

            $('#purchaseDetails').validate().resetForm();
        }

        /* method removes row from table; takes row_id as a parameter */
        function removeRow(row_id) {
            if(row_id !== '') {
                var row = $(document.getElementById(row_id));
                var siblings = row.siblings();

                /*
                * if last row is removed from the table save button is disabled
                * */
                if(siblings.length == 0) {
                    document.getElementById('submit_btn').disabled = true;
                }

                /*
                * price for the row removed is deducted from the total price
                * */
                var reduce_amount = $('#' + row_id + ' td:nth-last-child(2)').text();
                var total_amount = $('#total_amount').text();
                total_amount = parseInt(total_amount, 10) - parseInt(reduce_amount, 10);
                if(isNaN(total_amount)) total_amount = 0;
                $('#total_amount').text(total_amount);

                /*
                * to remove row from table
                * */
                var parent = document.getElementById("tableBody");
                var child = document.getElementById(row_id);
                parent.removeChild(child);

                /*
                * get the last row id
                * */
                var last_row_id = 'tr-' + $('#tableBody>tr').length;

                /* if last row is removed re-index isn't necessary  */
                if(last_row_id != row_id) {
                    /*
                    * re-indexing sibling rows of the row removed
                    * */
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
