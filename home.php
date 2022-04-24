<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>

<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" href="jquery.flipster.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="icon" href="./images/home-logo.webp">
</head>

<body onload="preload()">

<div id="anim">

    <?php
        include "db_conn.php";

        date_default_timezone_set('Asia/Kolkata');
        $date = new \DateTime();
        $date = date_format($date, 'Y-m-d H:i:s');

        $ip = $_SERVER['REMOTE_ADDR'];
        $dev = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

        $uname = $_SESSION['user_name'];
        $pass = $_SESSION['password'];

        $sql = "INSERT INTO user_log(id,user_name, password, ip,type,time,device) VALUES(NULL,'$uname','$pass','$ip','Home Entry','$date','$dev')";
        mysqli_query($conn, $sql);
    ?>

    <div id="boxes-anim">
        <div class="box-anim">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="box-anim">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="box-anim">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="box-anim">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

</div>

    


    <div class="tl"><h4>Hello <?php echo $_SESSION['user_name']; ?>,&nbsp;<?php echo $_SESSION['greet']; ?></h4></div>

    

    <div class="tr"><a href="logout.php">Logout</a></div>

    




    <div class="hero">
        <div class="mid">--- People I know ---</div>
        <div class="watch"><h5><i class="fa-regular fa-eye"></i>&nbsp;<?php echo $_SESSION['watching']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-regular fa-user"></i></i>&nbsp;<?php echo $_SESSION['sum_user']; ?></h5></div>
        <div class="carousel">
            <ul>
                <li><img src="images/img1.webp"></li>
                <li><img src="images/img2.webp"></li>
                <li><img src="images/img3.webp"></li>
                <li><img src="images/img4.jpg"></li>
                <li><img src="images/img5.jpg"></li>
                <li><img src="images/img6.webp"></li>
                <li><img src="images/img7.jpg"></li>
                <li><img src="images/img8.webp"></li>
                <li><img src="images/img9.webp"></li>
                <li><img src="images/img10.webp"></li>
                <li><img src="images/img11.webp"></li>
                <li><img src="images/img12.jpg"></li>
                <li><img src="images/img13.jpg"></li>
                <li><img src="images/img14.jpg"></li>
                <li><img src="images/img15.webp"></li>
                <li><img src="images/img16.webp"></li>
                <li><img src="images/img17.webp"></li>
                <li><img src="images/img18.webp"></li>
                <li><img src="images/img19.webp"></li>
                <li><img src="images/img20.webp"></li>
                <li><img src="images/img21.webp"></li>
                <li><img src="images/img22.webp"></li>
            </ul>
        </div>
        <div class="bl"><h4>Your IP: <?php echo $_SESSION['ip']; ?><br>Last Login: <?php echo $_SESSION['last_login']; ?> IST</h4></div>
        <!-- <div class="mid-btm"><h4>Currently watching</h4></div> -->
        <div class="br"><h4><span class="far fa-copyright"></span> 2022 Nabyendu Ojha</h4></div>
    </div>







    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="jquery.flipster.min.js"></script>
    <script>
        $('.carousel').flipster({
            style: 'carousel',
            spacing: -0.3,
        });
    </script>

    <script src="./script2.js"></script>



</body>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>