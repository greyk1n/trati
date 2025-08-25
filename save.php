<!-- save.php -->
<?php
header('Content-Type: application/json; charset=utf-8');


$file = "expenses.json";


if (file_exists($file)) {
$data = json_decode(file_get_contents($file), true);
} else {
$data = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$input = json_decode(file_get_contents("php://input"), true);
if ($input && isset($input["action"])) {
if ($input["action"] === "add") {
$data[] = $input["expense"];
} elseif ($input["action"] === "delete") {
unset($data[$input["index"]]);
$data = array_values($data);
}
file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}
}


echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>