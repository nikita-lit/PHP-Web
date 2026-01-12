<?php 
    $baasiaadress="localhost"; 
    $baasikasutaja="nikitalitvinenko"; 
    $baasiparool="1234"; 
    $baasinimi="nikitalitvinenko"; 
    $yhendus = new mysqli($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);  //PHP lõpumärki pole vaja, et kogemata midagi välja ei trükitaks