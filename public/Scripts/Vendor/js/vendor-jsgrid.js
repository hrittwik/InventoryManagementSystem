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
                    error: function (response) {
                        if(response.status == 422) {
                            alert('Server Side Error!');
                        } else {
                            alert("Something went wrong!");
                        }
                    }
                });
            },
            updateItem: function (item) {

                var CSRF_TOKEN = $('input[name="_token"]').attr('value');

                var jsonData = {
                    _token: CSRF_TOKEN,
                    id: item.id,
                    name: item.name,
                    contact: item.contact,
                    address: item.address
                };

                return $.ajax({
                    type: "PATCH",
                    url: "/vendor/update",
                    dataType: "JSON",
                    data: jsonData,
                    error: function (response) {
                        if(response.status == 422) {
                            alert('Server Side Error!');
                        } else {
                            alert("Something went wrong!");
                        }
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
            { name: "name", type: "text", css: "capitalize", width: "33.3%" },
            { name: "contact", type: "text", css: "capitalize", width: "33.3%" },
            { name: "address", type: "text", css: "capitalize", width: "33.3%" },
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
        width: "auto",
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
                unique: true
            },
            contact: "required"
        },
        messages: {
            name: {
                required: "This field is required",
                unique: "Name must be a unique"
            },
            contact: "Please enter contact information",
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