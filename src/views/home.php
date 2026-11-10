<?php
echo "<h1>Página inicial</h1>";

foreach ($dados as $url => $nome){
    echo "<a href='" . url("/$url") . "'>$nome</a><br>";
}
