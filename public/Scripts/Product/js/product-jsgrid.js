$(document).ready(function () {

    var GetUnitDDL = $.noop;

    GetUnitDDL = function() {

        $('#unit_id').empty();
        var defaultOption = "<option value=''>Select a unit</option>";
        $('#unit_id').append(defaultOption);
        
        $.ajax({
            type: "GET",
            url: "/unit/GetAll",
            success: function(data) {

                $.each(data, function(key, object) {
                    
                    var text = object.short_name;
                    var value = object.id;
                    
                    var option = "<option value='" + value + "'>" + text + "</option>";
                    $('#unit_id').append(option);

                }); 
            }
        });
    }

    GetUnitDDL();

    $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",

        editing: true,
        autoload: true,
        paging: true,
        sorting: true,

        deleteConfirm: function(item) {
            return "The product \"" + item.name + "\" will be removed. Are you sure?";
        },
        rowClick: function(args) {
            showDetailsDialog("Edit", args.item);
        },

        controller: {
            loadData: function () {

                return $.ajax({
                    type: "GET",
                    url: "/product/GetAll"
                });

            },
            insertItem: function (item) {

                var CSRF_TOKEN = $('input[name="_token"]').attr('value');

                var jsonData = {
                    _token: CSRF_TOKEN,
                    name: item.name,
                    short_name: item.short_name,
                    unit_id: item.unit_id,
                    description: item.description
                };

                console.log(jsonData);

                return $.ajax({
                    type: "POST",
                    url: "/product/store",
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
                    short_name: item.short_name,
                    unit_id: item.unit_id,
                    description: item.description
                };

                return $.ajax({
                    type: "PATCH",
                    url: "/product/update",
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
                    url: "/product/delete",
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
            { name: "name", title: "Name", type: "text", css: "text-transform: capitalize", width: "21.9%" },
            { name: "short_name", title: "Short Name", type: "text", css: "text-transform: capitalize", width: "21.9%" },
            { name: "unit.short_name", title: "Unit", type: "text", css: "text-transform: capitalize", width: "21.9%" },
            { name: "description", title: "Description", type: "text", css: "text-transform: capitalize", width: "21.9%" },
            {
                width: "12.5%",
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
            url: "/product/CheckUniqueShortName",
            data: {
                id: id,
                short_name: value
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
            name: "required",
            short_name: {
                required: true,
                unique: true,
                maxlength: 10
            },
            unit_id: "required"
        },
        messages: {
            name: {
                required: "This field is required",
                unique: "Name must be a unique",
            },
            short_name: {
                required: "This field is required",
                unique: "Short name must be unique",
                maxlength: "Please enter no more than 10 characters"
            },
            unit_id: "Please select a unit for the product",
        },
        submitHandler: function() {
            formSubmitHandler();
        }
    });

    var formSubmitHandler = $.noop;

    var showDetailsDialog = function(dialogType, product) {

        $('#id').val(product.id);
        $("#name").val(product.name);
        $("#short_name").val(product.short_name);
        $("#unit_id").val(product.unit_id);
        $("#description").val(product.description);

        formSubmitHandler = function() {
            saveProduct(product, dialogType === "Add");
        };

        $("#detailsDialog").dialog("option", "title", dialogType + " Product")
            .dialog("open");
    };

    var saveProduct = function(product, isNew) {

        $.extend(product, {
            name: $("#name").val(),
            short_name: $("#short_name").val(),
            unit_id: $("#unit_id").val(),
            description: $("#description").val()
        });

        $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", product);

        $("#detailsDialog").dialog("close");
    };

});