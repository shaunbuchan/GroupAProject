<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        main{
            background: url("images/updateprofile.jpg");
        }
    </style>
    <style>
        main {
            height: 700px;
        }
        .viewEventTable{

            color: white;
            font-size: 18px;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }
        a{
            text-decoration: none;
            color: turquoise;
        }
        th{
            text-align: center;
        }
        table, td{
            text-align: left;
        }
        table, th, td {
            border: 1px solid turquoise;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
<?php

    require_once ('HeaderLoggedin.php');


?>

//Events I have created
<main class="grid-container">
    <section  class="grid-60">
        <div class="MycreatedEvents">

    <?php
    $query2="SELECT * FROM events WHERE events.e_username='$username'AND events.e_date>=CURDATE() ";
    $result=mysqli_query($conn, $query2);
    
    $events="";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $e_ID = $row['e_ID'];
                $e_title = $row['e_title'];
                $location = $row['e_location'];
                $e_date = $row['e_date'];
                $events .="<a href='viewMyEventDetails.php?eid=".$e_ID."' class = 'cat_links'>".$e_title." -<br> <font size='-3', color='#778899'>".$location."-</font><font class='edate' >.$e_date</font></a>";
            }
            echo $events;
        } else {
            echo "<p>You have not created an Event yet</p>";
        }
        ?>
</div></section>


//Events I am attending
        <section  class="grid-40">
        <div class="MyattendingEvents">

            <?php
    $query3="SELECT * 
            FROM join_event j, events e 
            WHERE j.j_username='$username'AND e.e_ID =j.j_event";
            $result2=mysqli_query($conn, $query3);

    $attendingevents="";
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $e_ID = $row['e_ID'];
            $e_title = $row['e_title'];
            $location = $row['e_location'];
            $e_date = $row['e_date'];
            $attendingevents .="<a href='viewMyEventDetails.php?eid=".$e_ID."' class = 'cat_links'>".$e_title." -<br> <font size='-3', color='#778899'>".$location."-</font><font class='edate' >.$e_date</font></a>";
        }
        echo $attendingevents;
    } else {
        echo "<p>You are not attending any Event yet</p>";
    }


        ?>

        </div>
        </section>


</main>
<!--Main Ends -->
<!-- Footer -->
<footer>
    <?php
    require ("Footer.php")
    ?>
</footer>
</body>
</html>
