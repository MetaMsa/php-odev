<?php
$q = isset($_REQUEST["q"]) ? strtolower($_REQUEST["q"]) : "";

$page = array("Maaş Takibi", "Not Girişi");

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