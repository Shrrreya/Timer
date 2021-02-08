<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>DATA</title>
    <style>
        body {
        text-align: center;
        margin: 0;
        padding: 0;
        background-color: #171717;
        color: white;
        font-family: 'Times New Roman', Times, serif;
        }
        #table,
        th,
        td,
        tr {
            text-align: center;
            padding: 5px;

        }
        .table{
            margin:0px auto;
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
            bottom: 0;
            width: 100%;
            padding-bottom: 5px;
           
        }
    </style>
</head>
<body>
<nav>
    <a id="progamma" onclick="reloadP()">PRO-GAMMA</a>
    <section id="social">
        <div class="back"><a href="main.html"><i class="fa fa-angle-double-left"></i></a></div>
    </section>
</nav>
<table id="table" class="table">
    <thead>    
        <tr>
            <th>Sr.No.</th>
            <th>Name</th>
            <th>Time</th>
        </tr>
    <thead>
    <?php

        /* Attempt MySQL server connection. Assuming you are running MySQL
        server with default setting (user 'root' with no password) */
        $link = mysqli_connect("localhost", "root", "", "show");
        
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        
        // Attempt select query execution
        $sql = "SELECT * FROM data ORDER BY time";
        $counter = 1;
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>".$counter++."</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['time'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        
        mysqli_close($link);
    ?>

</table> 
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
