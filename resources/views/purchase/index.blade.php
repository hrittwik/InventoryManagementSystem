@extends('layouts.master')

@section('CSS')
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('page-title')
    Purchase
@endsection

@section('content')
    <div class="container-fluid">

        {{-- purchase header --}}
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('date', 'Date') !!}
                    {!! Form::input('text', 'date', date('m/d/Y'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('vendor_id', 'Vendor') !!}
                    {!! Form::input('text', 'vendor_id', null, ['class' => 'form-control']) !!}
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
                    {!! Form::label('product_id', 'Product Short Name') !!}
                    {!! Form::input('product_id', 'product_id', null, ['class' => 'form-control']) !!}
                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">
                    {!! Form::label('product', 'Product') !!}
                    {!! Form::input('text', 'product_id', null, ['class' => 'form-control']) !!}
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
        $( function() {
            $( "#date" ).datepicker();
        } );
    </script>

@endsection