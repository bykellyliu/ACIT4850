<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        $game = new Game($squares);
        if ($game->winner('o')) {
            echo "You win. Lucky guesses!";
        } else if ($game->winner('x')) {
            echo "I win. Muahahahaha";
        } else {
            $squares = $game->pick_move();
            $game = new Game($squares);

            if ($game->winner('x')) {
                echo "I win. Muahahahaha";
            }
        }
        $game->display();
        ?>
    </body>
</html>

<?php

class Game {

    var $position;
    var $newposition;

    function __construct($squares) {
        $this->position = str_split($squares);
    }

    function winner($token) {
        $result = false;
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
        return $result;
    }

    function show_cell($which) {
        $token = $this->position[$which];
        //deal with the easy case
        if ($token <> '-') {
            return '<td>' . $token . '</td>';
        }
        $this->newposition = $this->position; //copy the original
        $this->newposition[$which] = 'o'; // opponent's move
        $move = implode($this->newposition); // make a string from the board array
        $link = 'index.php/?board=' . $move;
        return '<td><a href="' . $link . '">-</a></td>'; //return a cell containing an anchor and showing a hyphen
    }

    function display() {
        echo '<table cols=”3” style=”font­size:large; font­weight:bold”>';
        echo '<tr>'; // open the first row
        for ($pos = 0; $pos < 9; $pos++) {
            echo $this->show_cell($pos);
            if ($pos % 3 == 2) {
                echo '</tr><tr>'; // close the table
            }
        }
        echo '</tr>';
        echo '</table>';
    }
    

    function pick_move() {
        $newposition = $this->position;
        for ($pos = 0; $pos < 9; $pos++) {
            if ($this->position[$pos] == '-') {
                $newposition[$pos] = 'x';
                $move = implode($newposition);
                return $move;
            }
        }
    }

}
?>
    
