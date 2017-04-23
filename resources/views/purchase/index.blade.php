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
                    {!! Form::label('short_name', 'Product Short Name') !!}
                    {!! Form::input('short_name', 'short_name', null, ['class' => 'form-control']) !!}
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('product_id', 'Product') !!}
                    {!! Form::select('product_id', [], null, ['class' => 'form-control']) !!}
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
                <button class="btn btn-primary btn-lg" style="margin: 5px">Add</button>
            </div>
        </div>
        {{-- ./ end of purchase header --}}

        {{-- purchase details table --}}
        <hr/>

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

        </div>
        {{--./ end of purchase details table --}}

    </div>

@endsection

@section('JavaScript')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#date").datepicker();
        });

        $(document).ready(function () {
            var GetVendorDDL = function () {

                $('#vendor_id').empty();
                var defaultOption = "<option value='' selected>Select a vendor</option>";
                $('#vendor_id').append(defaultOption);
            };

            var GetProductDDL = function () {

                $('#product_id').empty();
                var defaultOption = "<option value='' selected>Select a product</option>";
                $('#product_id').append(defaultOption);
            };

            GetVendorDDL();
            GetProductDDL();
        });
    </script>

@endsection