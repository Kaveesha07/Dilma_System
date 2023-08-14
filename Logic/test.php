<?php
//database access path
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/Dilma_System";
$db_path = $path . "/DataAccess";
include $db_path.'/DBconnection.php';

//make database connection
$connection = $dbConn -> getConnection();

/*$ReadSql = "SELECT * FROM item";
$res = $dbConn->executeQuery($ReadSql);

if ($res->num_rows > 0) {
while ($r = $res->fetch_assoc()) {
?>
<tr>
	<!-- <th scope="row"></th>  -->
	<td><?php echo $r['itmNo']; ?></td>
    <td> <?php echo $r['itmName']; ?></td>
<?php }} 
else{
    echo "No such item";
}?>*/