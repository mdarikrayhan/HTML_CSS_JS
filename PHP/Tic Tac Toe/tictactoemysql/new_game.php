<?php
session_start();
require 'Database.php';

$config = require('config.php');
$db = new Database($config);

// Clear current game session
unset($_SESSION['game_id']);

// Get game mode from POST or default to 'Computer'
$gameMode = $_POST['gameMode'];

if ($gameMode === null) {
    $gameMode = 'Human';
}

$board = [
    1 => [1 => '', 2 => '', 3 => ''],
    2 => [1 => '', 2 => '', 3 => ''],
    3 => [1 => '', 2 => '', 3 => '']
];

$query = "INSERT INTO tictactoe (board, gameMode, status) 
          VALUES (:board, :gameMode, 'ongoing')";
$params = [
    ':board' => json_encode($board),
    ':gameMode' => $gameMode
];

$db->query($query, $params);
$game_id = $db->connection->lastInsertId();
$_SESSION['game_id'] = $game_id;

header("Location: index.php");
exit;