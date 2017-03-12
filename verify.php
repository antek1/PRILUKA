<?php include_once 'conn.php'; ?>
<!DOCTYPE html>
<html>
<head>
<?php include_once ('head.php'); ?>
</head>
<body>
<?php include_once ('header.php'); ?>

<?php 
if (isset($_GET['id']) AND isset($_GET['activation'])) {

	$sql = $link->prepare('SELECT * FROM user WHERE id =:id and is_approved!=1');
    $sql->execute(array(':id'=>$_GET['id']));
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row > 0) {

    $sql = $link->prepare('UPDATE user set is_approved = 1  where id=:id');
    $sql->execute(array(':id'=>$_GET['id']));
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    echo     "<div class='vBox' style='margin: 0 auto;width: 600px;height: 400px;''>";
    echo     "<form action='login.php'>";
    echo     "<input type='submit' style='width: 100%;height: 80px;margin-top: 100px;margin-bottom: 100px;'' value='You have been activate your account succssefully, click here for login!' />";
    echo     "</form>";
    echo     "</div>";
}else{
	echo "Your email is already activate or the link for activation is broken. Please try again!";
}
}
 ?>









<?php include_once ('footer.php'); ?>