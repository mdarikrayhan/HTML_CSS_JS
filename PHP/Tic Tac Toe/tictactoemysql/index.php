<?php
session_start();
require 'Database.php';

$config = require('config.php');
$db = new Database($config);

// Get current game
$game_id = $_SESSION['game_id'] ?? null;
$game = null;

if ($game_id) {
    $query = "SELECT * FROM tictactoe WHERE id = :id";
    $game = $db->query($query, [':id' => $game_id])->fetch();
}

// Create new game if none exists
if (!$game) {
    $board = [
        1 => [1 => '', 2 => '', 3 => ''],
        2 => [1 => '', 2 => '', 3 => ''],
        3 => [1 => '', 2 => '', 3 => '']
    ];
    
    $query = "INSERT INTO tictactoe (board, gameMode, status) 
              VALUES (:board, 'Computer', 'ongoing')";
    $params = [':board' => json_encode($board)];
    
    $db->query($query, $params);
    $game_id = $db->connection->lastInsertId();
    $_SESSION['game_id'] = $game_id;
    
    $game = [
        'id' => $game_id,
        'board' => json_encode($board),
        'gameMode' => 'Computer',
        'status' => 'ongoing',
        'result' => null
    ];
}

$board = json_decode($game['board'], true);
$gameMode = $game['gameMode'];
$status = $game['status'];
$result = $game['result'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <style>
        h1 {
        text-align: center;
        color: #333;
    }

    .game-cell {
        width: 100px; 
        height: 100px; 
        font-size: 2em;
        background-color: transparent;
        border: 0px;
    } 

    table {
        margin: 5px auto;
    }

    .vertical {
        border-left: 2px solid black;
        border-right: 2px solid black;
    }

    .horizontal {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
    }

    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .reset{
        display: block; 
        margin: 0 auto; 
        padding: 10px 20px; 
        font-size: 1.2em;
    }
    .disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    </style>
</head>
<body>
    <h1>Tic Tac Toe</h1>

    <form id="game-form" action="process_data.php" method="post">
        <input type="hidden" name="game_id" value="<?= $game_id ?>">
        
        <table>
            <?php for ($row = 1; $row <= 3; $row++): ?>
            <tr>
                <?php for ($col = 1; $col <= 3; $col++): 
                    $cellValue = $board[$row][$col] ?? '';
                    $disabled = $status !== 'ongoing' || $cellValue !== '';
                ?>
                <td
                <?= ($col === 2 && $row ===2) ? 'class="vertical horizontal"' : ''?> 
                <?= $row === 2 ? 'class="horizontal"' : '' ?> 
                <?= $col === 2 ? 'class="vertical"' : '' ?>
                >
                    <button class="game-cell" type="submit" name="move" value="<?= "$row,$col" ?>"
                        <?= $disabled ? 'disabled class="disabled"' : '' ?>>
                        <?= $cellValue ?>
                    </button>
                </td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </table>
    </form>

    <div style="text-align: center; margin-bottom: 20px;">
    <form action="new_game.php" method="post" style="display: inline-block;">
    <div style="text-align: center; margin-bottom: 20px;">
            <label class="switch">
                <input type="checkbox" name="gameMode" value="Computer" 
                <?php if ($gameMode === 'Computer') echo 'checked'; ?>>
                <span class="slider round"></span>
            </label>
            <br>
            <span id="toggleText">Computer</span>
        </div>
        <button class="reset" type="submit">New Game</button>
    </form>
</div>

    <?php if ($status === 'completed'): ?>
    <h1 style="text-align: center; color: green;">
        Game Over: <?= $result === 'Draw' ? 'Draw!' : "Winner: $result!" ?>
    </h1>
    <?php endif; ?>
</body>
<script>
    document.querySelector('.switch input').addEventListener('change', function () {
        const toggleText = document.getElementById('toggleText');
        if (this.checked) {
            this.value = 'Computer';
            toggleText.textContent = 'Computer';
        } else {
            this.value = 'Human';
            toggleText.textContent = 'Human';
        }
    });
</script>
</html>