	<?php

	?>
        <div id="footer">
            <img src="style/happy.png" alt="slogan" width="240px" height="220px" style="margin-top: 20px;">
            <div id="contact">
                <h2 style="text-align: left; margin-bottom: 15px; margin-left: 20px;">Contact Us</h2>
                <iframe name="votar" style="display:none;"></iframe>
                <form action="index.php" method="POST" id="contactform" target="votar" name="message_form">
                    <input type="text" placeholder="Name" id="name" name="name" value="<?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?>">
                    <input type="text" placeholder="Email" id="mail" name="mail" value="<?php if(isset($_SESSION['email_address'])) echo $_SESSION['email_address'];?>">
                    <textarea rows="4" placeholder="Message" id="message" name="message"></textarea>
                    <input type="submit" id="submitM" name="submitM" value="Submit">
                </form>
            </div>
            <div id="social">
                <h2 style="text-align: left; margin-bottom: 15px; margin-left: 20px;">Social Media</h2>
                <a href=""><img src="style/facebook.png" title="FaceBook" width="35px" height="35px" style="margin-top: 6px; margin-left: 20px;"></a><br />
                <a href=""><img src="style/instagram.png" title="Instagram" width="35px" height="35px" style="margin-top: 6px; margin-left: 20px;"></a><br />
                <a href=""><img src="style/twitter.png" title="Twitter" width="35px" height="35px" style="margin-top: 6px; margin-left: 20px;"></a><br />
                <a href=""><img src="style/linkedin.png" title="LinkedIn" width="35px" height="35px" style="margin-top: 6px; margin-left: 20px;"></a>
            </div>
            <div id="contactUs">
                <h2 style="text-align: left; margin-bottom: 15px; margin-left: 20px;">Get In Touch</h2>
                <p style="margin: 20px; text-align: left;"><b>Location: </b>3 Rocklands Road, Three Anchor Bay, Sea Point, Cape Town, South Africa.<br><br>
                <b>Office: </b>+27 21 366 56 65<br><br>
                <b>Mobile: </b>+27 81 714 08 14<br><br>
                <b>Email: </b>customer_service@happy.co.za</p>
            </div>
            <div id="navigate">
                <h2 style="text-align: left; margin-bottom: 15px;">Navigate</h2>
                <p id="nav">
                <a href="index.php">Home</a><br /><br />
                <a href="surfBoards.php">Surf Boards</a><br /><br />
                <a href="wetSuits.php">Wet Suits</a><br /><br />
                <a href="about.php">About Our Store</a>
                </p>
            </div>
            <p id="copyright">&copy; 2017 Happy.co.za | All Rights Reserved | <span id="date"></span></p>
        </div>
	</body>
        <script type="text/javascript">
            var date = new Date();
            var month = date.getUTCMonth();
            var day = date.getUTCDate();
            var year = date.getUTCFullYear();
            var monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"];
            document.getElementById("date").innerHTML = day + " " + monthNames[month] + " " + year;
        </script>
        <?php
		    if(isset($_POST['submitM'])){

		        $mmessage = $_POST['message'];
		        if(!empty($mmessage)) {
		            //echo '<script> document.getElementById("message").value = "";';
			        //mail($_SESSION['email_address'], 'MESSAGE', 'You recieved a message from HAPPY', 'From: customer_service@happy.co.za');
			        echo '<script language="javascript">alert("Thanks, your message has been sent!"); </script>';

		        }
		    }
        ?>
</html>