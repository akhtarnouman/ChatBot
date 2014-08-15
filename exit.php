<h2>
<?php
$con=mysqli_connect("localhost","root","","chatbot");
if (mysqli_connect_errno())
{ 
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_query($con,"UPDATE user SET name = 'user', namecheck = 0");
mysqli_close($con);
header('Location: Chatbot2.html');
?>