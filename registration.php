<?php
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
        //declaring input variables
		$fName = $lName = $phNum = $uE_mail = $uPass = $cPass = "";
		$errorFN = $errorLN = $errorPhN = $errorEmail = $errorPass = $errorCPass = "";
		//declaring a counter
        $counter = 0;

		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			$fName = $_POST['fname'];
			$fName = clear($fName);

			$lName = $_POST['lname'];
			$lName = clear($lName);

			$phNum = $_POST['phnum'];
			$phNum = clear($phNum);

			$uE_mail = $_POST['email'];
			$uE_mail = clear($uE_mail);

			$uPass = $_POST['userpass'];
			$uPass = clear($uPass);

			$cPass = $_POST['conpass'];
			$cPass = clear($cPass);


			//1_ First name processing
			if (empty($fName)){
				$errorFN = '* Please enter your first name!';
			}
			// preg_match ~ allows ONLY letters
			else if (!preg_match( "/^([^[:punct:]\d]+)$/", $fName )){
				$errorFN = '* Use letters only for First Name!';
			}
			else{
				$counter++;
			}

			//2_ Last name processing
			if (empty($lName)){
				$errorLN = '* Please enter your Last Name!';
			}
			// preg_match ~ allows ONLY letters
			else if (!preg_match( "/^([^[:punct:]\d]+)$/", $lName )){
				$errorLN = '* Use letters only for Last Name!';
			}
			else{
				$counter++;
			}

			//3_ Phone number processing
			if (empty($phNum)){
				$errorPhN = '* Please enter your Phone number!';
			}
			// preg_match ~ allows valid phone number formats only
			else if (!preg_match( "/^([\+]?[0-9\s]{10,17})$/" , $phNum )){
				$errorPhN = '* Invalid Phone number!';
			}
			else{
				$counter++;
			}

			//4_ Email address processing
			if (empty($uE_mail)){
				$errorEmail = '* Please enter your Email address!';
			}
			// preg_match ~ allows valid email addresses only
			else if (!preg_match( "/^[a-zA-Z0-9._%+-]+@(?:[a-zA-Z0-9-]+\.)+(?:[a-zA-Z]{2}|aero|biz|com|coop|edu|gov|info|jobs|mil|mobi|museum|name|net|org|travel)$/i", $uE_mail )){
				$errorEmail = '* Invalid Email address!';
			}
			else{
			    // CHECK IF EMAIL ADDRESS ALREADY EXISTS IN THE USERS_ACCOUNTS TABLE!!
				include("dbc.php");
			    $emailCheckQuery = "SELECT * FROM customers_accounts WHERE email_address = '$uE_mail'";

				if($result = mysqli_query($dbc, $emailCheckQuery)){
				    $row = mysqli_fetch_array($result);
                    if($row['email_address'] == $uE_mail){
                        $errorEmail = '* Please enter another Email!';
	                    echo '<script language="javascript">alert("Email address already exists in our database!"); </script>';
                    }
                    else{
                        $counter++;
                    }
				}
				else{
					echo "<p style='color: red;'> Couldn't retrieve emails from the customers_accounts table because :<br />" . $dbc->connect_error ."</p>";
				}
				$dbc->close();
			}

			//5_ Password processing
			if (empty($uPass)){
				$errorPass = '* Please enter your Password!';
				$errorCPass = '* Please Confirm your Password!';
			}
			// preg_match ~ allows only passwords more than 5 characters long and must contain both letters and numbers
			else if (!preg_match( "~(?=.*[0-9])(?=.*[a-zA-Z])^[a-zA-Z0-9@_&=%/-/?/+/*/./$]{6,50}$~", $uPass )){
				$errorPass = '* Please enter a valid Password!';
				$errorCPass = '* Please Confirm your Password!';
				echo '<script language="javascript">alert("Password has to be at least 6 characters long and must contain both letters and numbers!"); </script>';
			}
			else{
			    if ($uPass == $cPass){
				    //Password md5 hashing
				    $uPass = md5($uPass);
				    $counter++;
                }
                else if (empty($cPass)){
	                $errorCPass = '* Please Confirm your Password!';
                }
                else{
	                $errorCPass = '* Confirmation incorrect!';
                }
			}

			if($counter == 5){

				include("dbc.php");
				$query = "INSERT INTO customers_accounts (customer_id, first_name, last_name, phone_number, email_address, password, date_inserted) 
                          VALUES (NULL, '$fName', '$lName', '$phNum', '$uE_mail', '$uPass', CURRENT_TIMESTAMP); ";

				if($result = mysqli_query($dbc, $query)){
					$_SESSION['name'] = $fName;
					$_SESSION['email'] = $uE_mail;
					header("Location: login.php");
				}
				else{
					echo "<p style='color: red;'> Couldn't insert data into customers_accounts table because :<br />" . $dbc->connect_error ."</p>";
				}
				$dbc->close();
			}
		}
	?>
        <div id="logo">
            <a href="index.php"><img src="style/logo.png" alt="Logo" width="100px" height="97px" style="margin-top: 5px"></a>
        </div>
		<div id="registration">
			<h2 style="text-align: center; margin-bottom: 15px; font-size: 28px;">Register to <span id="brand">Happy</span> online store!</h2>
			<form action="registration.php" method="POST">

				<input type="text" placeholder="First Name" id="fname" name="fname" value="<?php if(!empty($fName)) echo $fName?>">
				<?php echo '<span id="alert">' . $errorFN . '</span>'; ?>
				<br/><br/>

				<input type="text" placeholder="Last Name" id="lname" name="lname" value="<?php if(!empty($lName)) echo $lName?>">
				<?php echo '<span id="alert">' . $errorLN . '</span>'; ?>
				<br/><br/>

				<input type="text" placeholder="Phone Number" id="phnum" name="phnum" value="<?php if(!empty($phNum)) echo $phNum?>">
				<?php echo '<span id="alert">' . $errorPhN . '</span>'; ?>
				<br/><br/>

				<input type="text" placeholder="Email Address" id="email" name="email" value="<?php if(!empty($uE_mail)) echo $uE_mail?>">
				<?php echo '<span id="alert">' . $errorEmail . '</span>'; ?>
				<br/><br/>

				<input type="password" placeholder="Password" id="userpass" name="userpass">
				<?php echo '<span id="alert">' . $errorPass . '</span>'; ?>
				<br/><br/>

				<input type="password" placeholder="Confirm Password" id="conpass" name="conpass">
				<?php echo '<span id="alert">' . $errorCPass . '</span>'; ?>
				<br/><br/>

				<input type="submit" id="rsubmit" name="submit" value="Register">
                <br/>

                <h4 style="text-align: center;"><a href="login.php">Login</a> </h4>
			</form>
		</div>
	</body>
</html>