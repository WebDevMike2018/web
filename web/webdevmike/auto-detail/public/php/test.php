<pre>
<?php

$a = array(
	array('time'=>0, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>1, 'scheduled'=>0, 'reserved'=>0),
	array('time'=>2, 'scheduled'=>0, 'reserved'=>0),
);
$a = json_encode($a);
$a = json_decode($a);
print_r($a);


?>
</pre>