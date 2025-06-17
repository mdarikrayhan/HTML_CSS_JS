<?php
require 'Database.php';

$config = require('config.php');
$db = new Database($config);

// Get current game ID from session
session_start();
$game_id = $_SESSION['game_id'] ?? null;

// Create new game if none exists
if (!$game_id) {
    $board = [
        1 => [1 => '', 2 => '', 3 => ''],
        2 => [1 => '', 2 => '', 3 => ''],
        3 => [1 => '', 2 => '', 3 => '']
    ];

    $gameMode = $_POST['gameMode'];

    if ($gameMode === null) {
        $gameMode = 'Human';
    }

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
}

// Load existing game
$query = "SELECT * FROM tictactoe WHERE id = :id";
$game = $db->query($query, [':id' => $game_id])->fetch();

if (!$game) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$board = json_decode($game['board'], true);
$numberofmoves = 0;
//count the number of moves made
foreach ($board as $row) {
    foreach ($row as $cell) {
        if ($cell !== '') {
            $numberofmoves++;
        }
    }
}
$gameMode = $game['gameMode'];

$status = $game['status'];

// Process move only if game is ongoing
if ($status === 'ongoing') {
    // Update board with player move
    if (isset($_POST['move'])) {
        list($row, $col) = explode(',', $_POST['move']);
        $row = (int) $row;
        $col = (int) $col;

        if (isset($board[$row][$col]) && $board[$row][$col] === '') {
            // Player move changes to 'X' and 'O' for human player
            if ($numberofmoves % 2 === 0) {
                $board[$row][$col] = 'X';
            } else {
                $board[$row][$col] = 'O';
            }

            // Check for winner after player move
            $winner = checkWinner($board);
            $isDraw = isBoardFull($board);

            if ($winner || $isDraw) {
                updateGameState($db, $game_id, $board, $winner ?? 'Draw');
            }
            // Computer move
            elseif ($gameMode === 'Computer') {
                makeComputerMove($board);
                $winner = checkWinner($board);
                $isDraw = isBoardFull($board);

                if ($winner || $isDraw) {
                    updateGameState($db, $game_id, $board, $winner ?? 'Draw');
                } else {
                    updateBoard($db, $game_id, $board);
                }
            } else {
                updateBoard($db, $game_id, $board);
            }
        }
    }
}

header("Location: index.php");
exit;

// Helper functions
function checkWinner($board)
{
    $winningCombinations = [
        [[1, 1], [1, 2], [1, 3]],
        [[2, 1], [2, 2], [2, 3]],
        [[3, 1], [3, 2], [3, 3]],
        [[1, 1], [2, 1], [3, 1]],
        [[1, 2], [2, 2], [3, 2]],
        [[1, 3], [2, 3], [3, 3]],
        [[1, 1], [2, 2], [3, 3]],
        [[1, 3], [2, 2], [3, 1]]
    ];

    foreach ($winningCombinations as $combo) {
        $cells = [];
        foreach ($combo as $cell) {
            $cells[] = $board[$cell[0]][$cell[1]];
        }
        if ($cells[0] !== '' && $cells[0] === $cells[1] && $cells[0] === $cells[2]) {
            return $cells[0];
        }
    }
    return null;
}

function isBoardFull($board)
{
    foreach ($board as $row) {
        foreach ($row as $cell) {
            if ($cell === '')
                return false;
        }
    }
    return true;
}

function makeComputerMove(&$board)
{
    $bestScore = -INF;
    $bestMove = null;

    foreach ($board as $row => $cols) {
        foreach ($cols as $col => $value) {
            if ($value === '') {
                $board[$row][$col] = 'O';
                $score = minimax($board, 0, false);
                $board[$row][$col] = '';

                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestMove = [$row, $col];
                }
            }
        }
    }

    if ($bestMove) {
        $board[$bestMove[0]][$bestMove[1]] = 'O';
    }
}

function minimax($board, $depth, $isMaximizing)
{
    $winner = checkWinner($board);

    if ($winner === 'O')
        return 10 - $depth;
    if ($winner === 'X')
        return -10 + $depth;
    if (isBoardFull($board))
        return 0;

    if ($isMaximizing) {
        $bestScore = -INF;
        foreach ($board as $row => $cols) {
            foreach ($cols as $col => $value) {
                if ($value === '') {
                    $board[$row][$col] = 'O';
                    $score = minimax($board, $depth + 1, false);
                    $board[$row][$col] = '';
                    $bestScore = max($bestScore, $score);
                }
            }
        }
        return $bestScore;
    } else {
        $bestScore = INF;
        foreach ($board as $row => $cols) {
            foreach ($cols as $col => $value) {
                if ($value === '') {
                    $board[$row][$col] = 'X';
                    $score = minimax($board, $depth + 1, true);
                    $board[$row][$col] = '';
                    $bestScore = min($bestScore, $score);
                }
            }
        }
        return $bestScore;
    }
}

function updateGameState($db, $game_id, $board, $result)
{
    $query = "UPDATE tictactoe 
              SET board = :board, result = :result, status = 'completed' 
              WHERE id = :id";

    $params = [
        ':board' => json_encode($board),
        ':result' => $result,
        ':id' => $game_id
    ];

    $db->query($query, $params);
}

function updateBoard($db, $game_id, $board)
{
    $query = "UPDATE tictactoe SET board = :board WHERE id = :id";
    $params = [
        ':board' => json_encode($board),
        ':id' => $game_id
    ];

    $db->query($query, $params);
}