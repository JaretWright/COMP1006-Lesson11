/**
 * Created by JWright on 5/26/2017.
 */

//use jQuery for a Delete confirmation pop-up
$('.confirmation').on('click', function(){
    return confirm('Are you sure you want to delete this item?');
});

// check the password has been entered the same way twice
$('.btnRegister').on('click', function(){
    if ($('#password').val() != $('#confirm').val()){
        $('#message').html('Passwords do not match');
        $('#message').removeClass();
        $('#message').addClass('alert alert-danger');
        return false;
    }
    else
        return true;
});

//This will check the strength of the password
// passwords - https://www.formget.com/password-strength-checker-in-jquery/
$(document).ready(function() {
    $('#password').keyup(function() {
        $('#result').html(checkStrength($('#password').val()))
    })
    function checkStrength(password) {
        var strength = 0
        if (password.length < 6) {
            $('#result').removeClass()
            $('#result').addClass('alert-danger')
            return 'Too short'
        }
        if (password.length > 7) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2
        if (strength < 2) {
            $('#result').removeClass()
            $('#result').addClass('alert-warning')
            return 'Weak'
        } else if (strength == 2) {
            $('#result').removeClass()
            $('#result').addClass('alert-info')
            return 'Good'
        } else {
            $('#result').removeClass()
            $('#result').addClass('alert-success')
            return 'Strong'
        }
    }
});