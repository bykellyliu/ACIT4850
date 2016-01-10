<html>
    <head>
        <meta charset= "UTF-8">
        <title>Tic Tac Toe Game</title>
    </head>
    <body>
        <?php
        // See if a board parameter was passed in the first place
        if (isset($_GET['board'])) {
            $squares = $_GET['board'];
        } else {
            $squares = '---------';
        }
        if (winner('x', $squares)) {echo 'You win.';}
        else if (winner('o', $squares)) {echo 'I win.';}
        else {echo 'No winner yet.';}
        ?>
    </body>
</html>

<?php

class Game {

    var $position;

    function _construct($squares) {
        $this->position = str_split($squares);
    }

    function winner($token) {
        // Winning condition for horizontal lines
        for ($row = 0; $row < 3; $row++) {
            $result =  true;
            for ($col = 0; $col < 3; $col++) {
                // once one of the cells in the horizontal line doesn't match the token, no chance of winning
                if ($this->position[3 * $row + $col] != $token) {
                    $result = false;
                }
            }
            // otherwise if all three cells in a horizontal line match the token, there's a winner
            if ($result == true) {
                return $result;
            }
        }
        // Winning condidtion for vertincal lines
        for ($col = 0; $col < 3; $col++) {
            $result  =  true;
            for ($row = 0; $row < 3; $row++) {
                // once one of the cells in the vertical line doesn't match the token, no chance of winning
                if ($this->position[3 * $row + $col] != $token) {
                    $result = false;
                }
            }
            // otherwise if all three cells in a vertical line match the token, there's a winner
            if ($result == true) {
                return $result;
            }
        }

        // Winning condition for one of the diagnol lines
        if ($this->position[0] == $token && $this->position[4] == $token && $this->position[8] == $token) {
            $result = true;
        }
        // Winning condition for the other diagnol lines
        if ($this->position[2] == $token && $this->position[4] == $token && $this->position[6] == $token) {
            $result = true;
        }
    }
    ?>
    
