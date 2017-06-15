<?php
$pageTitle = 'Registration';
require_once('header.php');
?>

<main class="container">
    <h1>User Registration</h1>
        <?php
            if (!empty($_GET['errorMessage']))
                echo '<div class="alert alert-danger" id="message">Email address already exists</div>';
            else
                echo '<div class="alert alert-info" id="message">Please create your account</div>';
        ?>

        <form method="post" action="save-registration.php">
            <fieldset class="form-group">
                <label for="email" class="col-sm-2">Email: *</label>
                <input name="email" id="email" type="email" required
                        placeholder="email@email.com"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="username" class="col-sm-2">User Name: </label>
                <input name="username" id="username" placeholder="your name"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="password" class="col-sm-2">Password: </label>
                <input name="password" id="password" type="password" placeholder="Password"
                    required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autofocus
                       title="Passwords must contain uppercase, lowercase, numbers and be at least 8 characters"/>
                <span id="result"></span>
            </fieldset>
            <fieldset class="form-group">
                <label for="confirm" class="col-sm-2">Re-enter Password: </label>
                <input name="confirm" id="confirm" type="password" placeholder="Confirm Password"
                       required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" autofocus
                       title="Passwords must contain uppercase, lowercase and numbers"/>
            </fieldset>
            <button class="btn btn-success col-sm-offset-2 btnRegister">Register</button>
        </form>
    </main>
</body>

<?php require_once('footer.php') ?>
