@extends('layouts.master')

@section('CSS')

    <style>

        .jsgrid-cell {
            overflow: hidden;
        }

        .jsgrid-pager { text-align: center; }

    </style>

    <style>

        input.error, select.error {
            border: 1px solid #ff9999;
            background: #ffeeee;
        }

        label.error {
            float: right;
            margin-left: 100px;
            /*font-size: .8em;*/
            color: #ff6666;
        }

    </style>

    <style>
        .capitalize {
            text-transform: capitalize;
        }
    </style>

    {{-- CSS for jquery-UI --}}
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/cupertino/jquery-ui.css">


    {{-- CSS for jsGrid --}}
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />

@endsection

@section('page-title')
    Vendor
@endsection

@section('content')

    <div id="jsGrid" class="jsgrid-cell jsgrid-pager"></div>

    <div id="detailsDialog">
        <form id="detailsForm" autocomplete="off">
            {{ csrf_field() }}
            <div class="container-fluid">
                <br/>
                <div class="row form-group">
                    <label class="col-md-4" for="name" style="text-align: center">Name:</label>
                    <input class="col-md-8" id="name" name="name" type="text" />
                    <input id="id" name="id" type="hidden" />
                </div>

                <div class="row form-group">
                    <label class="col-md-4" for="contact" style="text-align: center">Contact:</label>
                    <input class="col-md-8" id="contact" name="contact" type="text" />
                </div>

                <div class="row form-group">
                    <label class="col-md-4" for="address" style="text-align: center">Address:</label>
                    <input class="col-md-8" id="address" name="address" type="text" />
                </div>


                <div class="row form-group" style="text-align: center">
                    <button type="submit" id="save">Save</button>
                </div>
            </div>

        </form>
    </div>

@endsection

@section('JavaScript')

    {{-- JS for jquery-UI --}}
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    {{-- JS for jquery validator --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    {{-- JS for jsGrid --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>

    {{-- jsGrid with dialog--}}
    <script type="text/javascript">

        $(document).ready(function () {

            $("#jsGrid").jsGrid({
                height: "auto",
                width: "100%",

                editing: true,
                autoload: true,
                paging: true,
                sorting: true,

                deleteConfirm: function(item) {
                    return "The vendor \"" + item.name + "\" will be removed. Are you sure?";
                },
                rowClick: function(args) {
                    showDetailsDialog("Edit", args.item);
                },

                controller: {
                    loadData: function () {

                        return $.ajax({
                            type: "GET",
                            url: "/vendor/GetAll",
                        });

                    },
                    insertItem: function (item) {

                        var CSRF_TOKEN = $('input[name="_token"]').attr('value');

                        var jsonData = {
                            _token: CSRF_TOKEN,
                            name: item.name,
                            contact: item.contact,
                            address: item.address
                        };

                        return $.ajax({
                            type: "POST",
                            url: "/vendor/store",
                            dataType: "JSON",
                            data: jsonData,
                            error: function (data) {
                                console.log(data);
                                alert("Something went wrong!");
                            }
                        });
                    },
                    updateItem: function (item) {

                        var CSRF_TOKEN = $('input[name="_token"]').attr('value');

                        return $.ajax({
                            type: "PATCH",
                            url: "/vendor/update",
                            dataType: "JSON",
                            data: {
                                _token: CSRF_TOKEN,
                                id: item.id,
                                name: item.name,
                                contact: item.contact,
                                address: item.address
                            },
                            error: function (response) {
                                alert('Something went wrong!');
                            }

                        });
                    },
                    deleteItem: function (item) {

                        var CSRF_TOKEN = $('input[name="_token"]').attr('value');

                        return $.ajax({
                            type: "DELETE",
                            url: "/vendor/delete",
                            data: {
                                _token: CSRF_TOKEN,
                                id: item.id
                            },
                            success: function (response) {
                                console.log('success');
                                alert(response);
                            },
                            error: function (response) {
                                console.log('error');
                                alert("Something went wrong!");
                            }
                        });

                    },
                },

                fields: [
                    { name: "name", type: "text", css: "text-transform: capitalize", width: "33.3%" },
                    { name: "contact", type: "text", css: "text-transform: capitalize", width: "33.3%" },
                    { name: "address", type: "text", css: "text-transform: capitalize", width: "33.3%" },
                    {
                        width: "16.67%",
                        type: "control",
                        modeSwitchButton: false,
                        editButton: false,
                        headerTemplate: function() {
                            return $("<button>").attr("type", "button").text("Add")
                                .on("click", function () {
                                    showDetailsDialog("Add", {});
                                });
                        },
                    }
                ]
            });

            $("#detailsDialog").dialog({
                autoOpen: false,
                width: "40%",
                close: function() {
                    $("#detailsForm").validate().resetForm();
                    $("#detailsForm").find(".error").removeClass("error");
                }
            });




            $.validator.addMethod("unique", function (value, element) {
                var id = ($('#id').val() != '' ? $('#id').val() : '');

                var isUnique = true;

                $.ajax({
                    type: "GET",
                    url: "/vendor/CheckUniqueName",
                    data: {
                        id: id,
                        name: value
                    },
                    async: false,
                    success: function (response) {

                        isUnique = (response == 'false' ? false : true);
                    }
                });

                return isUnique;
            });


            $("#detailsForm").validate({
                rules: {
                    name: {
                        required: true,
                        unique: true,
                    },
                    contact: "required"
                },
                messages: {
                    name: {
                        required: "This field is required",
                        unique: "Name must be a unique",
                    },
                    contact: "Please enter contact number",
                },
                submitHandler: function() {
                    formSubmitHandler();
                }
            });

            var formSubmitHandler = $.noop;

            var showDetailsDialog = function(dialogType, vendor) {

                $('#id').val(vendor.id);
                $("#name").val(vendor.name);
                $("#contact").val(vendor.contact);
                $("#address").val(vendor.address);

                formSubmitHandler = function() {
                    saveVendor(vendor, dialogType === "Add");
                };

                $("#detailsDialog").dialog("option", "title", dialogType + " vendor")
                    .dialog("open");
            };

            var saveVendor = function(vendor, isNew) {

                $.extend(vendor, {
                    name: $("#name").val(),
                    contact: $("#contact").val(),
                    address: $("#address").val(),
                });

                $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", vendor);

                $("#detailsDialog").dialog("close");
            };

        });

    </script>


@endsection