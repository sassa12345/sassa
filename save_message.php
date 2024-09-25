<?php
// グループ名、名前、メッセージを取得
$groupName = $_POST['groupName'];
$name = $_POST['name'];
$message = $_POST['message'];

// ファイル名を設定
$filename = 'groups/' . $groupName . '.txt';

// 現在の日時を取得
$dateTime = date("Y-m-d H:i:s");

if (!empty($name) && !empty($message)) {
    // メッセージのフォーマット
    $formattedMessage = "[$dateTime] $name: $message\n";

    // 現在のファイル内容を取得
    $currentContent = file_exists($filename) ? file_get_contents($filename) : '';

    // 新しいメッセージを先頭に追加
    $newContent = $formattedMessage . $currentContent;
    file_put_contents($filename, $newContent);
}
?>
