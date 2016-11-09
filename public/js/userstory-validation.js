/*
 validations are handled here using jQuery Validation Plugin
 */

//custom method to check whether all inputs are spaces
jQuery.validator.addMethod('allWhiteSpaces', function(value, element) {
    if($(element).val() == '') {
        return true;
    }
    return ($.trim( $(element).val() ) != '');
}, 'Cannot have only spaces');

//custom method to check whether all inputs are digits
jQuery.validator.addMethod('checkDigits', function(value, element, regexpr) {
    return !(regexpr.test(value));
}, 'Cannot have only digits');

//custom method to check whether all inputs are digits
jQuery.validator.addMethod('checkName', function(value, element, regexpr) {
    return (regexpr.test(value));
}, 'Name cannot contain digits &/ special characters');

//initializing the validator, rules and custom messages
$(document).ready(function() {
    $('#userStoryForm').validate({
        ignore: '.ignore',
        rules : {
            title : {
                required : true,
                minlength : 10,
                allWhiteSpaces : true,
                checkDigits : /^[\d ]+$/
            },
            description : {
                required : true,
                minlength : 20,
                allWhiteSpaces : true,
                checkDigits : /^[\d ]+$/
            },
            effort : {
                required : true,
                range: [1,12],
                allWhiteSpaces : true
            },
            delete : {
                required : true,
                minlength : 10,
                allWhiteSpaces : true,
                checkDigits : /^[\d ]+$/
            },
            userId : {
                required : true
            },
            userName : {
                required : true,
                checkName : /^[A-z\s]*$/,
                minlength : 5,
                allWhiteSpaces : true
            },
            address : {
                minlength : 5,
                allWhiteSpaces : true
            },
            job : {
                checkName : /^[A-z\s]*$/,
                allWhiteSpaces : true
            },

            currentPassword : {
                required : true,
                minlength : 5
            },
            newPassword : {
                required : true,
                minlength : 5
            },
            confirmPassword : {
                required : true,
                minlength : 5
            },
            CaptchaCode:{
                required : true,
            }
        },
        messages : {
            title : {
                required : 'Title is required'
            },
            description : {
                required : 'Description is required'
            },
            effort : {
                required : 'Effort(hrs) is required'
            },
            delete : {
                required : 'Please provide a valid reason to delete!'
            },
            userId : {
                required: 'Select a developer to assign'
            },
            userName : {
                required : 'Full Name is required'
            },
            currentPassword : {
                required : 'Current Password is required'
            },
            newPassword : {
                required : 'New Password is required'
            },
            confirmPassword : {
                required : 'Confirm New Password is required'
            },

            CaptchaCode:{
                required :'Enter the Recaptcha',
            }
        }
    });
});

