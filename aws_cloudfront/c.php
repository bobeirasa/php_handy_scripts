<?php
$xml=simplexml_load_file("report.xml");

$InitialTime = strtotime((string)$xml->OperationUsage[0]->StartTime);
$Grain = strtotime((string)$xml->OperationUsage[0]->EndTime) - strtotime((string)$xml->OperationUsage[0]->StartTime);
$graph = $Grain > 3600 ? "Column" : "Line";

foreach($xml->OperationUsage as $Item)
{
    if( preg_match('/DataTransfer/',$Item->UsageType) )
    {
        $usage[(strtotime($Item->StartTime)-$InitialTime)/$Grain] += floatval( (string)$Item->UsageValue );
    }
}
function GoogleGraphStr()
{
    function assembleDate($offset)
    {
        global $InitialTime, $graph, $Grain;
        $format="d/m";
        if($graph == "Line") $format.=" H:i";
        return date($format,$InitialTime+($offset*$Grain));
    }
    global $usage;
    $result="['Date', 'Terabytes']";
    foreach($usage as $i=>$B)
    {
        $result.=", ['". assembleDate($i) ."', ". round($B/1024/1024/1024/1024,2) ."]";
    }
    return $result;
}
?>