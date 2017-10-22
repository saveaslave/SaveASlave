<?php include("/password_protect.php"); ?>
<?php include 'drudge_header.php'; ?>
<h1>View/Manage User Contributed Links</h1>

<?

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//Connect to the database
include("/database.php");

if ( isset($_GET["id_to_edit"]) ) { 
  // delete/restore a link
  if ($_GET["action"]==0) {
    $sql = "UPDATE  `saveaslave`.`links` SET  `removed` =  '1',
`date_removed` = NOW( ) ,
`removed_by_ip` =  '".get_client_ip()."' WHERE  `links`.`id` =".$_GET["id_to_edit"]." LIMIT 1 ";
  } else {
    $sql = "UPDATE  `saveaslave`.`links` SET  `removed` =  '0',
`date_removed` = NULL ,
`removed_by_ip` =  NULL WHERE `links`.`id` =".$_GET["id_to_edit"]." LIMIT 1 ";
  }
  if ($conn->query($sql) === TRUE) {
     echo "Updated URL=" . $_GET["id_to_edit"] ."</br>";
  } else {
    echo "Error deleting link: " . $conn->error . "</br>";
  }
}
?>
Click on the ID of a link to remove or reactivate it. When finished <a href="http://www.saveaslave.com/password_protect.php?logout=1">Logout</a>.
<table class="tg">
  <tr>
    <th class="tg-ug4v">ID</th>
    <th class="tg-ug4v">NAME</th>
    <th class="tg-ug4v">PAGE</th>
    <th class="tg-ug4v">VIDEO</th>
    <th class="tg-ug4v">VISIBLE</th>
    <th class="tg-ug4v">DATE ADDED</th>
    <th class="tg-ug4v">ADDED BY</th>
    <th class="tg-ug4v">REMOVED</th>
    <th class="tg-ug4v">DATE REMOVED</th>
    <th class="tg-ug4v">REMOVED BY</th>
  </tr>
<?

$sql = "SELECT * FROM `links` ORDER BY id DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if ($row["removed"] == 0) {
            $class = "tg-shown";
        } else {
            $class = "tg-deleted";
        }
        echo "<tr><th class=".$class."><a href='managelink.php?id_to_edit=".$row["id"]."&action=".$row["removed"]."'> ". $row["id"]. "</a></th><td class=".$class."><a href='". $row["url"]. "' target='_blank'>" . $row["name"]. "</a></td><td class=".$class.">". $row["page"] . "</td><td class=".$class.">" . $row["video"]. "</td><td class=".$class.">" . $row["visible"]. "</td><td class=".$class.">" . $row["date_added"]. "</td><td class=".$class.">" . $row["added_by_ip"]."</td><td class=".$class.">" . $row["removed"]."</dh><td class=".$class.">" . $row["date_removed"]."</td><td class=".$class.">" . $row["removed_by_ip"]."</td></tr>";
    }
}
$conn->close();
?>
</table>
<br><a href="http://www.saveaslave.com/password_protect.php?logout=1">Logout</a>

<?php include 'drudge_footer.php';?>