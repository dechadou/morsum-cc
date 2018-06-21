var app = {
    init: function () {
        this.buttons();
        this.tooltips();
    },
    tooltips: function () {
        $("[data-toggle=tooltip]").tooltip();
    },
    buttons: function () {
        $(document).on("click", ".delete-button", function () {
            var id = $(this).data('id');
            $("#delete #user_id").val(id);
            $('#delete').modal('show');
        });

        $(document).on("click", ".edit-button", function () {
            var id = $(this).data('id');
            $("#edit #user_id").val(id);

            $.ajax({
                type: 'POST',
                url: BASEPATH+'home/view/' + id,
            })
                .done(function (data) {
                    $('#edit input[name="name"]').val(data.name);
                    $('#edit input[name="lastname"]').val(data.lastname);
                    $('#edit textarea[name="address"]').val(data.address);
                    $('#edit input[name="email"]').val(data.email);
                    $('#edit input[name="phone"]').val(data.phone);
                    $('#edit').modal('show');
                });
        });

        $(document).on("click", ".confirm-edit-button", function () {
            var id = $("#edit #user_id").val();
            var name = $('#edit input[name="name"]').val();
            var lastname = $('#edit input[name="lastname"]').val();
            var address = $('#edit textarea[name="address"]').val();
            var email = $('#edit input[name="email"]').val();
            var phone = $('#edit input[name="phone"]').val();

            $.ajax({
                type: 'POST',
                url: BASEPATH+'home/update',
                data: {id: id, name: name, lastname: lastname, address: address, email: email, phone: phone}
            })
                .done(function (msg) {
                    location.reload();
                });

        });

        $(document).on("click", ".confirm-delete-button", function () {
            var id = $("#delete #user_id").val();
            $.ajax({
                type: 'POST',
                url: BASEPATH+'home/destroy',
                data: {user_id: id}
            })
                .done(function (msg) {
                    $('*[data-user=' + id + ']').fadeOut();
                });
            $('#delete').modal('toggle');
        });


        $('#search-bar').on('keypress', function (e) {
            if (e.which == 13) {
                var term = $(this).val();
                window.location.href = BASEPATH+'home/search/' + term;
            }
        });
    }
};

$(document).ready(function () {
    app.init();
});
