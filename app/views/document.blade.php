<?php

use Documents\Document;
use Documents\DocumentAttributes;

$doc = Document::all();
$att = DocumentAttributes::all();

for ($i = 0; $i < sizeof($att); $i++) {
    foreach ($doc as $oneDoc) {
        echo "Document: " . "<br>" . $oneDoc . "<br>";
        for ($j = 0; $j < 5; $j++) {
            echo $att[$i + $j];
        }
    }
}
?>