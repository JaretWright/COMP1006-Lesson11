<?php

    $email = $_POST['email'];
    $password = $email;
    $password = password_hash($password, PASSWORD_DEFAULT);

    //Step 1 - connect to the DB
    require_once ('db.php');

    //Step 2 - create a sql statement to update the account with a new password
    $sql = "UPDATE users
            SET password = :password
            WHERE email = :email;";

    //Step 3 - prepare the sql
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
    $cmd->bindParam(':password',$password, PDO::PARAM_STR, 255);

    //step 4 - execute the command
    $cmd ->execute();
    $conn = null;

    //step 5 - send email to user with new password in it
    // this will only work on a server that has a mail server (such as AWS or Dreamhost)
    $to = $email;
    $subject = 'Password has been reset for COMP1006';
    $message = 'Your password has been reset to '.$email.'. Login into the system and reset your'.
                'password.<br /><br />Regards,<br />The COMP1006 team';

    $from = 'COMP1006@GC.CA';
    mail($to, $subject, $message,$from);

    //step 6 - redirect to the login page
    header('location:login.php?pwReset=true');
?>
