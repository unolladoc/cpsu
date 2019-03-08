<?php

include ('conn.php');

        $sql = "SELECT SUM(amount) as totalreg FROM registration WHERE valid=1;";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $reg = $row['totalreg'];
        }

        $sql1 = "SELECT SUM(amount) as totalreg FROM donation WHERE valid=1;";
        $result1 = $conn->query($sql1);

        if($result1->num_rows > 0){
            $row1 = $result1->fetch_assoc();
            $don = $row1['totalreg'];
        }

        $sql2 = "SELECT SUM(amount) as totalreg FROM otherincome WHERE valid=1;";
        $result2 = $conn->query($sql2);

        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
            $oth = $row2['totalreg'];
        }

        $totalinc = $reg + $don + $oth;

        $totalformat = number_format($totalinc,2,".",",");
        echo "<h2>TOTAL INCOME<br><strong>&#8369; ".$totalformat."</strong></h2>";

?>