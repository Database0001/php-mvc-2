<pre>

<?php
print_r(
    $db[0]->query('SHOW TABLES')->fetchAll(PDO::FETCH_ASSOC)
);
?>

{{ $users }}