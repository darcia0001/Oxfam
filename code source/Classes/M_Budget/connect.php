<?php

// Connexin au service XE (i.e. base de données) sur la machine "localhost"
$conn = oci_pconnect('hr', 'passer', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else echo "bien";

	$stid = oci_parse($conn, 'SELECT * FROM employees');
	oci_execute($stid);

	echo "<table border='1'>\n";
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    	echo "<tr>\n";
    	foreach ($row as $item) {
        	echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
    	}
    	echo "</tr>\n";
	}
	echo "</table>\n";

?>