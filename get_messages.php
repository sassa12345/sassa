<?php
// キャッシュを無効にするヘッダー
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

$filename = 'groups/' . $_GET['groupName'] . '.txt';
$lastPos = isset($_GET['lastPos']) ? (int)$_GET['lastPos'] : 0;

if (file_exists($filename)) {
    $messages = file($filename);
    $totalMessages = count($messages);

    if ($totalMessages > $lastPos) {
        $newMessages = array_slice($messages, $lastPos);
        $newPos = $totalMessages;
        $formattedMessages = implode('<br>', array_map('trim', $newMessages));

        echo json_encode(['newMessages' => $formattedMessages, 'newPos' => $newPos]);
    } else {
        echo json_encode(['newMessages' => '', 'newPos' => $lastPos]);
    }
} else {
    echo json_encode(['newMessages' => '', 'newPos' => 0]);
}
?>
