<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$filename = 'groups/' . $_GET['groupName'] . '.txt';
$lastPos = isset($_GET['lastPos']) ? (int)$_GET['lastPos'] : 0;

if (file_exists($filename)) {
    $messages = file($filename);
    $totalMessages = count($messages);

    if ($totalMessages > $lastPos) {
        $newMessages = array_slice($messages, $lastPos);
        $newPos = $totalMessages;
        // \nを使って改行する
        $formattedMessages = implode("\n", array_map('trim', $newMessages));
        
        echo json_encode(['newMessages' => $formattedMessages, 'newPos' => $newPos]);
    } else {
        echo json_encode(['newMessages' => '', 'newPos' => $lastPos]);
    }
} else {
    echo json_encode(['newMessages' => '', 'newPos' => 0]);
}
?>
