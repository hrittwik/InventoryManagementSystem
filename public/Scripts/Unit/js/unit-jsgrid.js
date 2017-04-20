$(document).ready(function () {

    $("#jsGrid").jsGrid({
        height: "auto",
        width: "100%",

        editing: true,
        autoload: true,
        paging: true,
        sorting: true,

        deleteConfirm: function(item) {
            return "The unit \"" + item.name + "\" will be removed. Are you sure?";
        },
        rowClick: function(args) {
            showDetailsDialog("Edit", args.item);
        },

        controller: {
            loadData: function () {

                return $.ajax({
                    type: "GET",
                    url: "/unit/GetAll"
                });

            },
            insertItem: function (item) {

                var CSRF_TOKEN = $('input[name="_token"]').attr('value');

                var jsonData = {
                    _token: CSRF_TOKEN,
                    name: item.name,
                    short_name: item.short_name
                };

                return $.ajax({
                    type: "POST",
                    url: "/unit/store",
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

                return $.ajax({
                    type: "PATCH",
                    url: "/unit/update",
                    dataType: "JSON",
                    data: {
                        _token: CSRF_TOKEN,
                        id: item.id,
                        name: item.name,
                        contact: item.contact,
                        address: item.address
                    },
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
                    url: "/unit/delete",
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
            { name: "name", title: "Name", type: "text", css: "text-transform:capitalize", width: "33.3%" },
            { name: "short_name", title: "Short Name", type: "text", css: "text-transform:capitalize", width: "33.3%" },
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
        console.log(id);
        console.log(value);

        var isUnique = true;

        $.ajax({
            type: "GET",
            url: "/unit/CheckUniqueShortName",
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
            }
        },
        messages: {
            name: "Please enter Name information",
            short_name: {
                required: "This field is required",
                unique: "Short Name must be a unique",
            },

        },
        submitHandler: function() {
            formSubmitHandler();
        }
    });

    var formSubmitHandler = $.noop;

    var showDetailsDialog = function(dialogType, unit) {


        $('#id').val(unit.id);
        $("#name").val(unit.name);
        $("#short_name").val(unit.short_name);

        formSubmitHandler = function() {
            saveunit(unit, dialogType === "Add");
        };

        $("#detailsDialog").dialog("option", "title", dialogType + " Unit")
            .dialog("open");
    };

    var saveunit = function(unit, isNew) {

        $.extend(unit, {
            name: $("#name").val(),
            short_name: $("#short_name").val(),
        });

        $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", unit);

        $("#detailsDialog").dialog("close");
    };

});
