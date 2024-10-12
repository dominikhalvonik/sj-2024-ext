<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moja prva stranka</title>
</head>
<body>
fdsafsadfdsafds

<?php
/*
 *
 * fsdafsd
 * fdsafdsf
 * fdsa
 */
const MOJA_KONSTANTA = 5;
define("MOJA_KONSTANTA_2", 10);

$mojaPremenna = 5;
$mojaPremenna1 = 0.5;
//$mojaPremenna2 = "fdafdsa";
$mojaPremenna3 = true;
$mojaPremenna4 = [1,2,3,4,5];
$mojaPremenna4[] = 6;
$mojaPremenna44 = array(1,2,3,4,5);
$mojaPremenna5 = new stdClass();
$mojaPremenna5->mojAtribut = $mojaPremenna;
echo $mojaPremenna;
var_dump($mojaPremenna5);

if($mojaPremenna === 5) {
    echo "Som velmy mlady<br>";
} elseif ($mojaPremenna > 1 && $mojaPremenna < 4) {
    echo "Som velmy v strede<br>";
} elseif ($mojaPremenna === 5 || $mojaPremenna > 5) {
    echo "Som relativne mlady<br>";
} else {
    echo "Som velmy stary<br>";
}

switch ($mojaPremenna) {
    case 5:
    echo "Mam " . $mojaPremenna . " rokov<br>";
    break;
    case 4:
    case 3:
    case 2:
    case 1:
        echo "Mam menej ako 5 rokov a teda mam " . $mojaPremenna . " rokov<br>";
        break;
    default:
        echo "neviem kolko mam<br>";
}

for ($i = 1; $i <= 5; $i++) {
    echo $i. "<br>";
}

$boolenVal = true;
$increment = 1;
while ($boolenVal) {
    $increment++;

    if($increment === 20) {
        $boolenVal = false;
    }

    echo $increment. "<br>";
}
foreach ($mojaPremenna4 as $key => $value) {
    echo "Hodnota " . $value . " sa nachadzala pod klucom " . $key . "<br>";
}

function mojaPrvaFunkcia(int $argment)
{
    for ($i = 1; $i <= $argment; $i++) {
        echo "Hodnota " . $i . "<br>";
    }
}

function vratHodnotu(int $a, int $b): int
{
    $c = $a + $b;
    $c += MOJA_KONSTANTA;

    return $c;
}

mojaPrvaFunkcia(100);
$vypocet = vratHodnotu(5,5);
print "<br>" . $vypocet . "<br>";

//phpinfo();
?>
</body>
</html>
