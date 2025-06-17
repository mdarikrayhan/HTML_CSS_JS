<?php
//MysQL connection
require 'Database.php';

$config = require('config.php');
$db = new Database($config['database']);
/*
database structure
id INT AUTO_INCREMENT PRIMARY KEY,
timestamp datetime DEFAULT CURRENT_TIMESTAMP,
board JSON NOT NULL,
gameMode ENUM('Human', 'Computer') DEFAULT Computer,
result ENUM('Draw', 'X', 'O') DEFAULT Draw
*/

$query = "select * from tictactoe";

$posts = $db->query($query)->fetchAll();

// foreach ($posts as $post) {
//     sleep(5);
//     echo "<h2>{$post['id']}</h2>";
//     echo "<p>{$post['board']}</p>";
//     echo "<p>{$post['gameMode']}</p>";
//     echo "<p>{$post['result']}</p>";
//     echo "<p>{$post['timestamp']}</p>";
//     echo "<hr>";

// }


$board = $_POST['data'];
$gameMode = $_POST['gameMode'];

if ($gameMode === null) {
    $gameMode = 'Human';
}

// Check for a winner
$winner = null;
$isDraw = true;
$winningCombinations = [
    // Horizontal
    [[1, 1], [1, 2], [1, 3]],
    [[2, 1], [2, 2], [2, 3]],
    [[3, 1], [3, 2], [3, 3]],
    // Vertical
    [[1, 1], [2, 1], [3, 1]],
    [[1, 2], [2, 2], [3, 2]],
    [[1, 3], [2, 3], [3, 3]],
    // Diagonal
    [[1, 1], [2, 2], [3, 3]],
    [[1, 3], [2, 2], [3, 1]]
];
//check for winner
foreach ($winningCombinations as $combination) {
    $values = [];
    foreach ($combination as $cell) {
        $values[] = $board[$cell[0]][$cell[1]];
    }
    if (count(array_unique($values)) === 1 && !empty($values[0])) {
        $winner = $values[0];
        break;
    }
}
//check for draw
foreach ($board as $row) {
    foreach ($row as $cell) {
        if (empty($cell)) {
            $isDraw = false;
            break 2; // exit both loops
        }
    }
}

function saveGameState($board, $winner = null)
{
    //save the game state to a json file
    if ($winner) {
        $data['winner'] = $winner;
    } else {
        unset($data['winner']);
    }
    $data['board'] = $board;
    $data['gameMode'] = $GLOBALS['gameMode'];
    // Convert the board to a JSON string
    $data = [
        'board' => $board,
        'winner' => $winner,
        'gameMode' => $GLOBALS['gameMode']
    ];

    $gameState = json_encode($data);

    file_put_contents(
        'game_data.json',
        $gameState
    );
}

function redirectToIndex()
{
    header("Location: index.php");
    exit();
}

function checkWinner()
{
    global $board, $winningCombinations;
    foreach ($winningCombinations as $combination) {
        $values = [];
        foreach ($combination as $cell) {
            $values[] = $board[$cell[0]][$cell[1]];
        }
        if (count(array_unique($values)) === 1 && !empty($values[0])) {
            return $values[0];
        }
    }
    return null;
}

function isBoardFull()
{
    global $board;
    foreach ($board as $row) {
        foreach ($row as $cell) {
            if (empty($cell)) {
                return false;
            }
        }
    }
    return true;
}

function getAvailableMoves()
{
    global $board;
    $moves = [];
    foreach ($board as $row => $cols) {
        foreach ($cols as $col => $value) {
            if (empty($value)) {
                $moves[] = [$row, $col];
            }
        }
    }
    return $moves;
}

function minMax($depth, $isMaximizing)
{
    global $board;

    // Check for a winner
    $winner = checkWinner();
    if ($winner === 'X')
        return -1;
    if ($winner === 'O')
        return 1;
    if (isBoardFull())
        return 0;

    if ($isMaximizing) {
        $bestScore = -INF;
        foreach (getAvailableMoves() as $move) {
            $board[$move[0]][$move[1]] = 'O';
            $score = minMax($depth + 1, false);
            $board[$move[0]][$move[1]] = '';
            $bestScore = max($bestScore, $score);
        }
        return $bestScore;
    } else {
        $bestScore = INF;
        foreach (getAvailableMoves() as $move) {
            $board[$move[0]][$move[1]] = 'X';
            $score = minMax($depth + 1, true);
            $board[$move[0]][$move[1]] = '';
            $bestScore = min($bestScore, $score);
        }
        return $bestScore;
    }
}

if ($winner) {
    //save data to the database
    $query = "INSERT INTO tictactoe (board, gameMode, result) VALUES (:board, :gameMode, :result)";
    $params = [
        ':board' => json_encode($board),
        ':gameMode' => $gameMode,
        ':result' => $winner
    ];
    $db->submitData($query, $params);
    saveGameState($board, $winner);
    
    redirectToIndex();
} else if ($isDraw) {
    $winner = 'Draw';
    saveGameState($board, $winner);
    redirectToIndex();

} else {
    //count the number of X's and O's
    $xCount = 0;
    $oCount = 0;
    foreach ($board as $row) {
        foreach ($row as $cell) {
            if ($cell === 'X') {
                $xCount++;
            } elseif ($cell === 'O') {
                $oCount++;
            }
        }
    }

    if ($gameMode === 'Computer' && $xCount > $oCount) {
        $bestScore = -INF;
        $bestMove = null;
        foreach (getAvailableMoves() as $move) {
            $board[$move[0]][$move[1]] = 'O';
            $score = minMax(0, false);
            $board[$move[0]][$move[1]] = '';
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestMove = $move;
            }
        }
        if ($bestMove) {
            $board[$bestMove[0]][$bestMove[1]] = 'O';
        }
        $winner = checkWinner();
        if ($winner) {
            saveGameState($board, $winner);
            redirectToIndex();
        }
    }
    saveGameState($board);
    redirectToIndex();
}



?>