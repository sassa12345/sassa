<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

$filename = 'groups/' . $_GET['groupName'] . '.txt';
$lastPos = isset($_GET['lastPos']) ? (int)$_GET['lastPos'] : 0;

if (file_exists($filename)) {
    $messages = file($filename); // メッセージをファイルから読み込む
    $totalMessages = count($messages); // 総メッセージ数を取得

    if ($totalMessages > $lastPos) {
        // 新しいメッセージを取得
        $newMessages = array_slice($messages, $lastPos); // lastPos以降のメッセージを取得
        $newPos = $totalMessages; // 新しいポジションを設定
        $formattedMessages = implode("<br>", array_map('trim', $newMessages)); // 改行をHTMLに変換

        // JSONで新しいメッセージと新しいポジションを返す
        echo json_encode(['newMessages' => $formattedMessages, 'newPos' => $newPos]);
    } else {
        // 新しいメッセージがない場合
        echo json_encode(['newMessages' => '', 'newPos' => $lastPos]);
    }
} else {
    // ファイルが存在しない場合
    echo json_encode(['newMessages' => '', 'newPos' => 0]);
}
?>
