<?php
$q = isset($_REQUEST["q"]) ? strtolower($_REQUEST["q"]) : "";

$page = array("Kayıt", "Kasa", "Personel", "Maaş Takibi");

$result = "";

if($q !== "")
{
    foreach($page as $name)
    {
        if(stristr($name, $q))
        {
            $result = $name;
        }
    }
    echo $result === "" ? "No suggestion" : $result;
}
?>