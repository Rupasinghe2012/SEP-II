/*
 modals(alert,confirm,prompt...) are displayed using Bootbox Plugin
 */

$(document).ready(function() {
    //AJAX request for profile update(users) to ProfileController.update
    $('#profileSubmit').click(function() {
        if($("#fullName").valid()  && $("#job").valid() && $("#address").valid()) {
            var userId = $('#userId').val();
            var type = $('#type').val();
            $.ajax({
                url: '/my-profile/' + userId + '/edit',
                type: 'PUT',
                data: {
                    name: $('#fullName').val(),
                    BOD: $('#BOD').val(),
                    address: $('#address').val(),
                    job: $('#job').val(),
                    mobile: $('#mobile').val()

                },

            success: function (data) {
                    bootbox.alert({
                        title: 'Information',
                        message: data,
                        callback: function () {
                                window.location.href = '/my-profile/' + userId;
                        }
                    });
                },
                error: function (jqXHR, textStatus) {
                    bootbox.alert({
                        title: 'Information',
                        message: 'Request was not successful, Please try again!'
                    });
                }
            });
        }
    });

    //AJAX request for password update(users) to ProfileController.updatePass
    $('#passwordConfirm').click(function() {
        if($('input[name=currentPassword]').valid() & $('input[name=newPassword]').valid() & $('input[name=confirmPassword]').valid()) {
            if ($('#newPass').val() == $('#confirmPass').val()) {
                $('#error').hide(1000);
                var userId = $('#userId').val();
                var type = $('#type').val();
                $.ajax({
                    url: '/my-profile/' + userId + '/edit/password',
                    type: 'PUT',
                    data: {
                        password: $('#currentPass').val(),
                        newPassword: $('#newPass').val(),
                        confirmPassword: $('#confirmPass').val()
                    },
                    success: function (data) {
                        $('#currentPass').val('');
                        $('#newPass').val('');
                        $('#confirmPass').val('');
                        if(data == 'false') {
                            bootbox.alert({
                                title: 'Information',
                                message: 'Current Password is invalid'
                            });
                        }
                        else {
                            bootbox.alert({
                                title: 'Information',
                                message: 'Your Password has been successfully updated'
                            });
                            $('#passwordModal').modal('hide');
                        }
                    },
                    error: function (jqXHR, textStatus) {
                        bootbox.alert({
                            title: 'Information',
                            message: 'Request was not successful, Please try again!'
                        });
                    }
                });
            }
            else {
                $('#error').show(1000);
            }
        }
    });
});