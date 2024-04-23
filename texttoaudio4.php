<?php
// Get user input from a form or other source
$user_input = $_POST['user_input'];
$message= $_POST['message'];
$genre=$_POST['genre'];
$date=$_POST['date'];

$male_voice = "Heading is $user_input";
$female_voice = "$message";

// use addarticle.html to testing.

/* Generate the audio using ResponsiveVoice
$male_audio_url = "https://code.responsivevoice.org/getvoice.php?t=".urlencode($male_voice)."&tl=en-GB&key=5oAnPp4V";
$female_audio_url = "https://code.responsivevoice.org/getvoice.php?t=".urlencode($female_voice)."&tl=en-US&key=5oAnPp4V"; */

// Generate the audio using ResponsiveVoice

$male_audio_url = "https://code.responsivevoice.org/getvoice.php?t=".urlencode($male_voice)."&tl=en-GB&key=vkeB9cBi&v=Male";
$female_audio_url = "https://code.responsivevoice.org/getvoice.php?t=".urlencode($female_voice)."&tl=en-US&key=vkeB9cBi&v=Serena";


// Get the contents of the audio files
$male_audio_contents = file_get_contents($male_audio_url);
$female_audio_contents = file_get_contents($female_audio_url);


// Combine the audio files into a single file
$combined_audio_contents = $male_audio_contents.$female_audio_contents ;

// Store the combined audio file into the database
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "translate";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO articles (title,message,date,genre,audio) VALUES ('".mysqli_real_escape_string($conn, $user_input)."','".mysqli_real_escape_string($conn, $message)."','$date','".mysqli_real_escape_string($conn, $genre)."','".mysqli_real_escape_string($conn, $combined_audio_contents)."')";


if ($conn->query($sql) === TRUE) {
  echo "Audio file saved to database successfully";
  header('location:translate2.html');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();





?>