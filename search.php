<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/pstyle.css">
    <style>
        main{
            background: url("images/updateprofile.jpg");
        }
    </style>
    <style>
        .viewEventTable{
            color: white;
            font-size: 20px;
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
            border: 1px solid red;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
<?php
include_once('DBconnect.php');
session_start();
if ( isset($_SESSION['username'] )){
    $username=$_SESSION['username'];


    require "HeaderLoggedin.php";
}
else {
    header('Location: HomePage.php');
}
?>
<main>
    <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input name="keyword" size="20">
        <button type="submit">Search</button>
    </form>


    <?php


    $query2="SELECT * FROM events, sports WHERE events.e_sportID=sports.s_ID ORDER BY e_date ASC ";
    $keyword=$_GET["keyword"];

        if(isset($keyword)) {
            // if keyword is set
            $query2 = $query2 . "where sports.s_name LIKE '%" . $keyword . "%'";
            $result = mysqli_query($conn, $query2);
            $row = mysqli_fetch_assoc($result);
        }
    ?>

    <div class="viewEventTable">
        <table>
            <tr><th>EventID</th><th>Event Creator</th><th>Event title</th><th>Event Description</th><th>Event Location</th><th>Event Date</th><th>Event Sport</th></tr>
            <?php do{ ?>
            <tr><td><?php echo $row['e_ID']; ?></td><td><?php echo $row['e_username']; ?></td><td><?php echo $row['e_title']; ?></td>
                <td><?php echo $row['e_description']; ?></td><td><?php echo $row['e_location']; ?></td><td><?php echo $row['e_date']; ?></td>
                <td><?php echo $row['s_name']; ?></td>
                <?php }while ($row= mysqli_fetch_assoc($result)) ?>
        </table>
    </div>

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