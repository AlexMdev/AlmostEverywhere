<?php

$conn = mysql_connect("localhost", "root", "root");

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
  
if (!mysql_select_db("frigowifi")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

$sql = "SELECT * FROM progetto_alimento";

$result = mysql_query($sql);

if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}

// While a row of data exists, put that row in $row as an associative array
// Note: If you're expecting just one row, no need to use a loop
// Note: If you put extract($row); inside the following loop, you'll
//       then create $userid, $fullname, and $userstatus
while ($row = mysql_fetch_assoc($result)) {
    echo '<br />' . $row["id"];
    echo '<br />' . $row["rfid_code"];
}

mysql_free_result($result);

?>