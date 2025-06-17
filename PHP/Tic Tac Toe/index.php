<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
</head>
<style>
    h1 {
        text-align: center;
        color: #333;
    }

    input[type="text"] {
        width: 100px;
        height: 100px;
        font-weight: bold;
        font-size: 2em;
        text-align: center;
        vertical-align: middle;
        border: 0px solid;
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
</style>

<body>
    <h1>Tic Tac Toe</h1>
    <form id="game-form" action="process_data.php" method="post">
        <div style="text-align: center; margin-bottom: 20px;">
            <label class="switch">
                <input type="checkbox" name="gameMode" value="Computer" checked>
                <span class="slider round"></span>
            </label>
            <br>
            <span id="toggleText">Computer</span>
        </div>

        <table>
            <tr>
                <td><input type="text" name="data[1][1]"></td>
                <td class="vertical"><input type="text" name="data[1][2]"></td>
                <td><input type="text" name="data[1][3]"></td>
            </tr>
            <tr>
                <td class="horizontal"><input type="text" name="data[2][1]"></td>
                <td class="vertical horizontal"><input type="text" name="data[2][2]"></td>
                <td class="horizontal"><input type="text" name="data[2][3]"></td>
            </tr>
            <tr>
                <td><input type="text" name="data[3][1]"></td>
                <td class="vertical"><input type="text" name="data[3][2]"></td>
                <td><input type="text" name="data[3][3]"></td>
            </tr>
        </table>

        <h1 id="winner-message" style="text-align: center; color: green;"></h1>

        <input id="reset" type="reset" value="Reset"
            style="display: block; margin: 0 auto; padding: 10px 20px; font-size: 1.2em;">
    </form>
</body>

<?php
//read the game state from the json file
$gameData = file_get_contents('game_data.json');
$gameData = json_decode($gameData, true);
//get board data
if ($gameData['board']) {
    $board = $gameData['board'];
} else {
    $board = [
        1 => [1 => '', 2 => '', 3 => ''],
        2 => [1 => '', 2 => '', 3 => ''],
        3 => [1 => '', 2 => '', 3 => '']
    ];
}
//set the board data to the inputs
foreach ($board as $row => $cols) {
    foreach ($cols as $col => $value) {
        echo "<script>
            document.querySelector('input[name=\"data[$row][$col]\"]').value = '$value';
        </script>";
    }
}
?>

<script>
    let currentPlayer = 0, flag = true;
    //set the winner message if it exists
    fetch('game_data.json').then(response => response.json()).then(data => {
        const winnerMessage = document.getElementById('winner-message');
        if (data.winner && flag) {
            winnerMessage.textContent = `Winner: ${data.winner}`;
            //make the inputs disabled
            document.querySelectorAll('input[type="text"]').forEach(input => {
                input.disabled = true;
            });
        }
    });

    fetch('game_data.json').then(response => response.json()).then(data => {
        //count the number of moves made
        const board = data.board;
        for (let row in board) {
            for (let col in board[row]) {
                if (board[row][col] !== '') {
                    currentPlayer++;
                }
            }
        }
    });
    //check if the game is player by human or computer by game_date.json file
    fetch('game_data.json').then(response => response.json()).then(data => {
        const gameMode = data.gameMode;
        const toggleInput = document.querySelector('.switch input');
        const toggleText = document.getElementById('toggleText');
        if (gameMode === 'Computer') {
            toggleInput.checked = true;
            toggleText.textContent = 'Computer';
        } else {
            toggleInput.checked = false;
            toggleText.textContent = 'Human';
        }
    });

    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.addEventListener('click', function () {
            //check if the input is empty
            if (this.value === '') {
                // toggle between 'X' and 'O'
                if (currentPlayer % 2 === 0) {
                    this.value = 'X';
                } else {
                    this.value = 'O';
                }
                currentPlayer++;
            }
        });
    });
    //if the checkbox is unchecked then change the span text
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

    //submit the form when the table data is changed

    document.querySelector('table').addEventListener('click', function () {
        document.getElementById('game-form').submit();
    });
    document.getElementById('reset').addEventListener('click', function () {
        currentPlayer = 0;
        //hide the winner message
        document.getElementById('winner-message').textContent = '';
        //make the inputs writeable
        flag = false;

        document.querySelectorAll('input[type="text"]').forEach(input => {
            input.disabled = false;
            input.value = '';
        });
    });
</script>

</html>