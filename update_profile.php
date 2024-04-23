<?php
		session_start();
		//connect to database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "audio_news";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		//check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		//update user info if form submitted
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
      $password= $_POST['password'];

			$sql = "UPDATE user_details SET username='$name', email='$email', mobile='$mobile' , password='$password' WHERE id='$user_id'";
			if (mysqli_query($conn, $sql)) {
				$_SESSION['message'] = "Profile updated successfully";
				header("Location:profilepage.php");
				exit();
			} else {
				echo "Error updating profile: " . mysqli_error($conn);
			}
		}


		mysqli_close($conn);
?>