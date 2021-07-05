<?php

$sql = "TRUNCATE contatos";

mysqli_query($conn, $sql);

header('Location: ?pg=contato/formulario');

?>