<?php

include ('conn.php');

        $sql = "SELECT SUM(amount) as totalreg FROM donation WHERE valid=1;";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
                      $row = $result->fetch_assoc();
                    }
        $totalformat = number_format($row['totalreg'],2,".",",");
        echo "<h2>Total Donation<br><strong>&#8369; ".$totalformat."</strong></h2>"

?>