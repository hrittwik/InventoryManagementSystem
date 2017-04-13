@extends('master')

@section('CSS')

    <style>
        .jsgrid-cell {
            overflow: hidden;
        }

        .jsgrid-pager { text-align: center; }

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
        <form id="detailsForm">
            <div class="form-group row">
                <label for="name" class="col-md-4">Name:</label>
                <input class="col-md-8" id="name" name="name" type="text" />
            </div>
            <div class="form-group row">
                <label for="contact" class="col-md-4">Contact:</label>
                <input class="col-md-8" id="contact" name="contact" type="number" />
            </div>
            <div class="form-group row">
                <label for="address" class="col-md-4">Address:</label>
                <input class="col-md-8" id="address" name="address" type="text" />
            </div>
            <div class="form-group row" style="text-align: center">
                <button type="submit" id="save">Save</button>
            </div>
        </form>
    </div>
@endsection

@section('JavaScript')

    {{-- JS for jquery-UI --}}
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    {{-- JS for jquery validator --}}
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

    {{-- JS for jsGrid --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>

    <script type="text/javascript">

        $("#jsGrid").jsGrid({
            width: "100%",
            hight: "70%",

            editing: true,
            sorting: true,
            paging: true,
            autosearch: true,

            pageSize: 10,
            pageButtonCount: 5,

            noDataContent: "No data found",

            deleteConfirm: function(item) {
                return "The vendor \"" + item.Name + "\" will be removed. Are you sure?";
            },
            rowClick: function(args) {
                showDetailsDialog("Edit", args.item);
            },

            fields: [
                { name: "Name", type: "text", width: "33.3%", validate: "required" },
                { name: "Contact", type: "text", width: "33.3%", validate: "required" },
                { name: "Address", type: "text", width: "33.3%", validate: "required" },
                {
                    type: "control",
                    width: "16.66%",
                    modeSwitchButton: false,
                    editButton: false,
                    headerTemplate: function() {
                        return $("<button>").attr("type", "button").text("Add")
                            .on("click", function () {
                                showDetailsDialog("Add", {});
                            });
                    }
                }
            ]
        });

        $("#detailsDialog").dialog({
            autoOpen: false,
            width: 400,
            close: function() {
                $("#detailsForm").validate().resetForm();
                $("#detailsForm").find(".error").removeClass("error");
            }
        });

        $("#detailsForm").validate({
            rules: {
                name: "required",
                contact: { required: true },
            },
            messages: {
                name: "<span style='color: red; font-size: smaller'>Please enter name</span>",
                contact: "<span style='color: red; font-size: smaller'>Please enter contact</span>",
            },
            submitHandler: function() {
                formSubmitHandler();
            }
        });

        var formSubmitHandler = $.noop;

        var showDetailsDialog = function(dialogType, vendor) {
            $("#name").val(vendor.Name);
            $("#Contact").val(vendor.Contact);
            $("#address").val(vendor.Address);

            formSubmitHandler = function() {
                saveClient(vendor, dialogType === "Add");
            };

            $("#detailsDialog").dialog("option", "title", dialogType + " Vendor")
                .dialog("open");
        };

        var saveClient = function(vendor, isNew) {
            $.extend(vendor, {
                Name: $("#name").val(),
                Contact: parseInt($("#contact").val(), 10),
                Address: $("#address").val(),
            });

            $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", client);

            $("#detailsDialog").dialog("close");
        };
    </script>

@endsection