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
        return false;
    }
    else
        return true;
});