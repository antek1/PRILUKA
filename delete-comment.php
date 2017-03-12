<?php include_once 'conn.php'; 
ob_start();


if(!isset($_GET["id"]) && !isset($_POST["id"])){
    header("location: logout.php");
    exit;
}



if(isset($_GET["id"])){
    if (!is_numeric($_GET["id"])){
        header("location: logout.php");
    //print_r(is_numeric($_GET["sifra"]));
        exit;
    }
    
    $sql=$link->prepare("select count(id) from comments where id=:id");
    $sql->execute($_GET);
    $res = $sql->fetchColumn();

    
}


    



if(isset($_POST["cDelete"])){
    
    
        unset($_POST["cDelete"]);
        $sql=$link->prepare("DELETE from comments 
        where id=:id");
        $sql->execute(array(":id"=>$_GET['id']));
        //print_r($_POST);
        //exit;
        echo "bla";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    
};

 
?>