<?php
    /*
     *      *********************************************************
     *      * PROGRAMMER:                                           *
     *      *             Mohamed Abulgasem - 215067762             *
     *      *                                                       *
     *      *********************************************************
     *      # This class serves the LOGIN page content and functionality
     *      *********************************************************
     */
    session_start();

    include('functions.php');
?>
<!doctype html>
<html>
    <head>
        <title>Happy Online Store</title>
        <meta charset="UTF-8">
        <link rel="icon" href="style/logo.png">
        <link rel="stylesheet" type="text/css" href="style/css.css" />
    </head>
    <body>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

	        //declaring input variables
	        $email = $_POST['user'];
	        $email = clear($email);

	        $pass = $_POST['pass'];
	        $pass = clear($pass);


	        if ( empty( $email ) || empty( $pass ) ) {
		        echo '<script language="javascript">alert("Email address or Password NOT Entered, Try again!"); </script>';
	        }
	        else {
	            // md5 password hashing to compare with the hashed password in the DB
		        $pass = md5($pass);

		        include("dbc.php");
		        $query = "SELECT * FROM customers_accounts WHERE email_address = '$email' AND password = '$pass'";

		        if($result = mysqli_query($dbc, $query)){
			        $row = mysqli_fetch_array($result);
			        if($row['email_address'] == $email && $row['password'] == $pass){
			            //assign first name, email & id to session variables
			            $_SESSION['user_name'] = $row['first_name'];
				          $_SESSION['email_address'] = $row['email_address'];
                  $_SESSION['customer_id'] = $row['customer_id'];
			            //redirect to the home page
				        header("Location: index.php");
			        }
                    else{
	                    echo '<script language="javascript">alert("Incorrect Email address or Password, Try again!"); </script>';
                    }
                }
		        else{
			        echo "<p style='color: red;'> Couldn't retrieve data because :<br />" . $dbc->connect_error ."</p>";
		        }
		        $dbc->close();

	        }
        }
            ?>
        <div id="logo">
            <a href="index.php"><img src="style/logo.png" alt="Logo" width="100px" height="97px" style="margin-top: 5px"></a>
        </div>
        <div id="login">
            <h1 style="text-align: center; margin-bottom: 10px;">Login</h1>
            <form action="login.php" method="POST">
                <input type="text" placeholder="Email address" id="user" name="user" value="<?php if(!empty($email)) echo $email; else if (isset($_SESSION['email'])){ echo $_SESSION['email'];}?>"><br/><br/>
                <input type="password" placeholder="Password" id="pass" name="pass"><br/><br/>
                <input type="submit" id="submit" name="submit" value="Submit">
            </form>
        </div>
        <?php
            if(isset($_SESSION['name'])){
	            echo'<p style="text-align: center;">Thanks for registering to our store, <b>' . $_SESSION['name'] . '</b>. You can now login to <span id="brand">Happy</span></p>';
	            unset($_SESSION['name']);
	            unset($_SESSION['email']);
            }
            else{
                echo '<p style="text-align: center;">Not a member? ... you can register <a href="registration.php">HERE</a></p>';
            }
        ?>

    </body>

</html>
