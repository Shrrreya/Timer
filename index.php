<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Video Upload</title>

    <style>
   *{
	margin:0;
	padding:0;
}
body {
        text-align: center;
        margin: 0;
        padding: 0;
        background-color: #171717;
        color: white;
        font-family: 'Times New Roman', Times, serif;
        }
.req_or_error,#info{
    color: #FF0000;
    text-align: left;
}
.header
{ 
	width:30%;
	margin:50px auto 0px;
	color:white;
	background:#5F9EA0;
	text-align: center;
	border:1px solid #B0C4DE;
	border-bottom: none;
	border-radius:10px 10px 0px 0px;
	padding:20px;
}
form{
	width:30%;
	margin:0px auto;
	padding:20px;
	border:1px solid #B0C4DE;
	border-radius:0px 0px 10px 10px;
}
.input-group{
	border-radius:10px 10px 0px 0px;
}
.input-group label{
	display:block;
	text-align: left;
	margin:3px;
}
.input-group input{
	height:30px;
	width:93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
    border:1px solid grey;
    background:transparent;
    color:white;
}
.btn,#submit{
	padding: 5px;
	font-size: 15px;
	background:#5F9EA0;
	border:none;
	border-radius: 5px;
	margin:5px;
}
#form{
	width:30%;
	margin:0px auto;
	padding:20px;
	border:1px solid #B0C4DE;
}
#social {
            background-color: transparent;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            float: right;
        }

        #social div {
            padding: 0px 10px;
            font-size: 25px;
            transition: .3s linear;
        }

        .back a {
            color: white;
        }
        .back:hover a {
            color: grey;
        }

        nav {
            width: 100%;
            padding: 10px 0px;
            height: 25px;
            background-color: transparent;
        }

        #progamma {
            float: left;
            border-style: none;
            font-size: 20px;
            background-color: transparent;
            color: white;
            padding: 0px 0px 0px 10px;
        }

        #progamma:hover {
            color: grey;

        }
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            padding-bottom: 5px;
        }
        @media screen and (max-width:1100px) {
          
              form, .header{
                width:350px;
              
              
            }


        </style>
</head>
<body>
<?php
$con =mysqli_connect('localhost','root','','vd');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }

$ynameErr=$emailErr=$videoErr="";
$yname=$email=$name=$tmp=$wca="";
$zero_error=true;

if(isset($_POST['upload'])){
    if($_POST['yname']=='')
    {
        $zero_error=false;
        $ynameErr="This field can't be Empty" ;
    }
    else
    {
        $yname=$_POST['yname'];
        if (!preg_match("/^[a-zA-Z-' ]*$/",$yname)) {
            $zero_error=false;
            $ynameErr = "Invalid Name Format";
           }
    }
    if($_POST['email']=='')
    {
        $zero_error=false;
        $emailErr="This field can't be Empty" ;
    }
    else
    {
        $email=$_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid Email Id"; 
        }
    }
    if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
        $zero_error=false;
        $videoErr= "This field can't be Empty"; 
    } else 
    {
        $name =$_FILES['file']['name'];
        $tmp =$_FILES['file']['tmp_name'];
        $arr = explode(".", $name);
        $extension = strtolower(end($arr));  
        if( ($extension!="mp4")) 
        {
            $zero_error=false;
            $videoErr= "The file must be of mp4 type"; 
        }
    }
    $wca=$_POST['wca'];
    move_uploaded_file($tmp,"videos/".$name);
    if($zero_error==true)
    {
        $sql ="INSERT INTO videos (name,email,wca,video) VALUES('$yname','$email','$wca','$name')";
        $res =mysqli_query($con,$sql);
        if($res==1 && $zero_error==true){
            echo '<script>var r = confirm("Do you want to submit the form?");
            if (r == true) {
              alert("Your form has been submitted successfully");
            } else {
              alert( "You pressed Cancel!");
            }</script>'; 
        }
        else{
            echo '<script>alert("Form could not be submitted")</script>'; 
        }
    }
   

}

?>
<nav>
    <a id="progamma" onclick="reloadP()">PRO-GAMMA</a>
    <section id="social">
        <div class="back"><a href="main.html"><i class="fa fa-angle-double-left"></i></a></div>
    </section>
</nav>
<div class="header">
<h2>VIDEO FORM</h2>
</div>		
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<div id=info>*Required</div>
<br>
<div class="input-group">
    <label for="yname">Name:</label>
    <input type="text" name="yname" placeholder="Enter your name here" value="<?php echo $yname;?>">
    <div class="req_or_error">*  <?php echo $ynameErr; ?></div>
</div>
<br>
<div class="input-group">
    <label for="email">Email Id:</label>
    <input type="email" name="email" placeholder="Enter your email here" value="<?php echo $email;?>">
    <div class="req_or_error">*  <?php echo $emailErr; ?></div>
</div>
<br>
<div class="input-group">
    <label for="wca">WCA Id:</label>
    <input type="text" name="wca" placeholder="Enter your WCA id here" value="<?php echo $wca;?>">
</div>
<br>
<div class="input-group">
    <label for="file">Video:</label>
    <input type="file" name="file" value="<?php echo $name;?>">
    <div class="req_or_error">*  <?php echo $videoErr; ?></div>
</div>
<br>
<div class="input-group">
    <input type="submit" class="btn" id="submit" name="upload" value="SUBMIT">
</div>
</form>
<footer>
        <div>
            © 2020 Developed by PRO-GAMMA
        </div>
</footer>
<script>
    function reloadP() {
    document.location.reload();
    }
</script>

</body>
</html>

