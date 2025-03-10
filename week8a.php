<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Bingo Server</title>
    <style>
        table {
            background : beige;
            border-collapse: collapse;
        }

        th, td {
            border: 2px solid black;
            padding: 20px;
            text-align: center;
        }

        p {
            text-align: center;
        }

        .lightblue {
            background-color: lightblue;
        }

        .red {
            background-color: #ff0000;
        }

        .player {
            background-color: pink;
        }

        .computer {
            background-color: beige;
        }

        button{
            background-color: #98d898;
            color: black;
        }
    </style>

<script>
    //array to keep track
    let calledNumbers = [];
    let callLetter = "";
    let callString = " ";
    let count = 0
    function newCall() {
        count++;
        let letter = Math.floor(Math.random() * 5) + 1;
        let callNumber;
        do {
            switch (letter) {
                case 1: callLetter = "B"; callNumber = Math.floor(Math.random() * 15) + 1; break;
                case 2: callLetter = "I"; callNumber = Math.floor(Math.random() * 15) + 16; break;
                case 3: callLetter = "N"; callNumber = Math.floor(Math.random() * 15) + 31; break;
                case 4: callLetter = "G"; callNumber = Math.floor(Math.random() * 15) + 46; break;
                case 5: callLetter = "O"; callNumber = Math.floor(Math.random() * 15) + 61; break;
            }
        } while (calledNumbers.includes(callNumber));  // Ensure unique numbers
//get rid of it
        calledNumbers.push(callNumber);
        callString = `${callLetter} ${callNumber}`;

        document.getElementById('call').innerHTML = callString;
        document.getElementById('count').innerHTML = "Called Numbers: " + calledNumbers.join(", ");
    }


    function markComputer(theId) {
        let cell = document.getElementById(theId);
        let number = parseInt(cell.innerText.trim(), 10); // Convert text to an integer

        if (calledNumbers.includes(number)) {
            //needed classList instade of classname
            cell.classList.add("lightblue");
            checkForWin();
        } else {
            console.log("Number NOT found in calledNumbers.");
        }
    }

    function changeToRed(theId) {
        let cell = document.getElementById(theId);
        let number = parseInt(cell.innerText.trim(), 10); // Convert text to an integer

        if (calledNumbers.includes(number)) {
            //needed classList instade of classname
            cell.classList.add("red");
            checkForWin();
        } else {
            console.log("Number NOT found in calledNumbers.");
        }
    }


    //win patterns work
    function checkForWin() {
        let winPatterns = [
            ["1", "6", "11", "16", "21"],  // B
            ["2", "7", "12", "17", "22"],  // I
            ["3", "8", "13", "18", "23"],  // N
            ["4", "9", "14", "19", "24"],  // G
            ["5", "10", "15", "20", "25"], // O
        ];

        winPatterns.forEach(pattern => {
            if (pattern.every(id => document.getElementById(id).classList.contains("red"))) {
                document.getElementById("fourSquares").innerHTML = "BINGO!";
            }
        });
    }
</script>
</head>

<body style="font-size : 13px" >

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpaimee_root";
$table = "bingo";
$conn = new mysqli($servername, $username, $password, $dbname);
//not used
$count = 0; // count
$letter = rand(1,5);

echo '<p id="call"></p>';
//not used
echo  '<p id="count"></p>';
//generate the bingo card
//B: 1-15
//I: 16-30
//N: 31-45 (with a free space in the center)
//G: 46-60
//O: 61-75
$BOne = rand(1, 15); $BTwo = rand(1, 15);$BThree = rand(1, 15);$BFour = rand(1, 15);$BFive = rand(1, 15);
$BCOne = rand(1, 15); $BCTwo = rand(1, 15);$BCThree = rand(1, 15);$BCFour = rand(1, 15);$BCFive = rand(1, 15);
//if statements to make sure numbers are unique
if ($BTwo == $BOne){
    $BTwo = rand(1, 15);
    }
if ($BThree == $BOne || $BThree == $BTwo){
    $BThree = rand(1, 15);
}
if ($BFour == $BOne || $BFour == $BTwo || $BFour == $BThree){
    $BFour = rand(1, 15);
}
if ($BFive == $BFour || $BFive == $BOne || $BFive == $BThree){
    $BFive = rand(1, 15);
}
$IOne = rand(16, 30); $ITwo = rand(16, 30); $IThree = rand(16, 30); $IFour = rand(16, 30); $IFive = rand(16, 30);
if ($ITwo == $IOne){
    $ITwo = rand(16, 30);
}
if ($IThree == $ITwo || $IThree == $IOne){
    $IThree = rand(16, 30);
}
if ($IFour == $IThree || $IFour == $IOne || $IFour == $ITwo){
    $IFour = rand(16, 30);
}
if ($IFive == $IFour || $IFive == $IOne || $IFour == $ITwo || $IFive == $IThree){
    $IFive = rand(16, 30);
}
$NOne = rand(31, 45); $NTwo = rand(31, 45); $NThree = "FREE"; $NFour = rand(31, 45); $NFive = rand(31, 45);
if ($NTwo == $NOne){
    $NTwo = rand(31, 45);
}
if ($NThree == $NTwo || $NThree == $NOne){
    $NThree = rand(31, 45);
}
if ($NFour == $NThree || $NFour == $NOne || $NFour == $NTwo){
    $NFour = rand(31, 45);
}
if ($NFive == $NThree || $NFive == $NOne || $NFive == $NTwo || $NFive == $NFour){
    $NFive = rand(31, 45);
}
$GOne = rand(46, 60); $GTwo  = rand(46, 60); $GThree = rand(46, 60); $GFour = rand(46, 60); $GFive = rand(46, 60);
if ($GTwo == $GOne){
    $GTwo = rand(46, 60);
}
if ($GThree == $GTwo || $GThree == $GOne){
    $GThree = rand(46, 60);
}
if ($GFour == $GTwo || $GFour == $GOne || $GFour == $GThree){
    $GFour = rand(46, 60);
}
$OOne = rand(61, 75); $OTwo = rand(61, 75); $OThree = rand(61, 75); $OFour = rand(61, 75); $OFive = rand(61, 75);
if ($OTwo == $OOne){
    $OTwo = rand(61, 75);
}
if ($OThree == $OTwo || $OThree == $OOne){
    $OThree = rand(61, 75);
}
if ($OFour == $OThree || $OFour == $OOne || $OFour == $OTwo){
    $OFour = rand(61, 75);
}
if ($OFive == $OThree || $OFive == $OOne || $OFive == $ITwo || $OFive == $OFour){
    $OFive = rand(61, 75);
}
//computer if
if ($BCTwo == $BCOne){
    $BCTwo = rand(1, 15);
}
if ($BCThree == $BCOne || $BCThree == $BCTwo){
    $BCThree = rand(1, 15);
}
if ($BCFour == $BCOne || $BCFour == $BCTwo || $BCFour == $BCThree){
    $BCFour = rand(1, 15);
}
if ($BCFive == $BCFour || $BCFive == $BCOne || $BCFive == $BCThree){
    $BCFive = rand(1, 15);
}
$ICOne = rand(16, 30); $ICTwo = rand(16, 30); $ICThree = rand(16, 30); $ICFour = rand(16, 30); $ICFive = rand(16, 30);
if ($ICTwo == $ICOne){
    $ICTwo = rand(16, 30);
}
if ($ICThree == $ICTwo || $ICThree == $ICOne){
    $ICThree = rand(16, 30);
}
if ($ICFour == $ICThree || $ICFour == $ICOne || $ICFour == $ICTwo){
    $ICFour = rand(16, 30);
}
if ($ICFive == $ICFour || $ICFive == $ICOne || $ICFour == $ICTwo || $ICFive == $ICThree){
    $ICFive = rand(16, 30);
}
$NCOne = rand(31, 45); $NCTwo = rand(31, 45); $NCThree = "FREE"; $NCFour = rand(31, 45); $NCFive = rand(31, 45);
if ($NCTwo == $NCOne){
    $NCTwo = rand(31, 45);
}
if ($NCThree == $NCTwo || $NCThree == $NCOne){
    $NCThree = rand(31, 45);
}
if ($NCFour == $NCThree || $NCFour == $NCOne || $NCFour == $NCTwo){
    $NCFour = rand(31, 45);
}
if ($NCFive == $NCThree || $NCFive == $NCOne || $NCFive == $NCTwo || $NCFive == $NCFour){
    $NCFive = rand(31, 45);
}
$GCOne = rand(46, 60); $GCTwo  = rand(46, 60); $GCThree = rand(46, 60); $GCFour = rand(46, 60); $GCFive = rand(46, 60);
if ($GCTwo == $GCOne){
    $GCTwo = rand(46, 60);
}
if ($GCThree == $GCTwo || $GCThree == $GCOne){
    $GCThree = rand(46, 60);
}
if ($GCFour == $GCTwo || $GCFour == $GCOne || $GCFour == $GCThree){
    $GCFour = rand(46, 60);
}
$OCOne = rand(61, 75); $OCTwo = rand(61, 75); $OCThree = rand(61, 75); $OCFour = rand(61, 75); $OCFive = rand(61, 75);
if ($OCTwo == $OCOne){
    $OCTwo = rand(61, 75);
}
if ($OCThree == $OCTwo || $OCThree == $OCOne){
    $OCThree = rand(61, 75);
}
if ($OCFour == $OCThree || $OCFour == $OCOne || $OCFour == $OCTwo){
    $OCFour = rand(61, 75);
}
if ($OCFive == $OCThree || $OCFive == $OCOne || $OCFive == $OCTwo || $OCFive == $OCFour){
    $OCFive = rand(61, 75);
}
//
$x = 0;

//update the rows
$rowOne = "UPDATE $table SET B='$BOne', I='$IOne', N='$NOne', G='$GOne', O='$OOne'WHERE rowId=1";
if ($conn->query($rowOne) === TRUE) {
} else {
    echo "Error: " . $rowOne . "<br>" . $conn->error;
}
//fix starting here
        $rowTwo = "UPDATE $table SET B='$BTwo', I='$ITwo', N='$NTwo', G='$GTwo', O='$OTwo'WHERE rowId=2";
if ($conn->query($rowTwo) === TRUE) {
} else {
    echo "Error: " . $rowTwo . "<br>" . $conn->error;
}


$rowThree = "UPDATE $table SET B='$BThree', I='$IThree', N='$NThree', G='$GThree', O='$OThree'WHERE rowId=3";
if ($conn->query($rowThree) === TRUE) {
} else {
    echo "Error: " . $rowThree . "<br>" . $conn->error;
}

$rowFour = "UPDATE $table SET B='$BFour', I='$IFour', N='$NFour', G='$GFour', O='$OFour'WHERE rowId=4";
if ($conn->query($rowFour) === TRUE) {
} else {
    echo "Error: " . $rowFour . "<br>" . $conn->error;
}

$rowFive = "UPDATE $table SET B='$BFive', I='$IFive', N='$NFive', G='$GFive', O='$OFive'WHERE rowId=5";
if ($conn->query($rowFive) === TRUE) {
} else {
    echo "Error: " . $rowFive . "<br>" . $conn->error;
}
//computer
//update the rows
$rowSix = "UPDATE $table SET B='$BCOne', I='$ICOne', N='$NCOne', G='$GCOne', O='$OCOne'WHERE rowId=6";
if ($conn->query($rowSix) === TRUE) {
} else {
    echo "Error: " . $rowSix . "<br>" . $conn->error;
}
//fix starting here
$rowSeven = "UPDATE $table SET B='$BCTwo', I='$ICTwo', N='$NCTwo', G='$GCTwo', O='$OCTwo'WHERE rowId=7";
if ($conn->query($rowSeven) === TRUE) {
} else {
    echo "Error: " . $rowSeven . "<br>" . $conn->error;
}


$rowEight = "UPDATE $table SET B='$BCThree', I='$ICThree', N='$NCThree', G='$GCThree', O='$OCThree'WHERE rowId=8";
if ($conn->query($rowEight) === TRUE) {
} else {
    echo "Error: " . $rowEight . "<br>" . $conn->error;
}

$rowNine = "UPDATE $table SET B='$BCFour', I='$ICFour', N='$NCFour', G='$GCFour', O='$OCFour'WHERE rowId=9";
if ($conn->query($rowNine) === TRUE) {
} else {
    echo "Error: " . $rowNine . "<br>" . $conn->error;
}

$rowTen = "UPDATE $table SET B='$BCFive', I='$ICFive', N='$NCFive', G='$GCFive', O='$OCFive'WHERE rowId=10";
if ($conn->query($rowTen) === TRUE) {
} else {
    echo "Error: " . $rowTen . "<br>" . $conn->error;
}


$sql2 = "SELECT * FROM $table";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    foreach ($rows as $index => $row) {
        $B = $row["B"];
        $I = $row["I"];
        $N = $row["N"];
        $G = $row["G"];
        $O = $row["O"];
    }
} else {
    echo "List is empty";
}
echo '<button id="submit" onclick="newCall()" >Get Number </button>';
echo '<div>';
echo '<table id = player>';
echo '<thead>Your Game</thead>';
echo ' <tr>';
echo        '<td>';
echo            '<div class="letter">B</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">I</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">N</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">G</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">O</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo     '  <td id="1" onclick="changeToRed(1)">';
echo      '      <div class="number">'.$BOne.'</div>';
echo       ' </td>';
echo        '<td id="2" onclick="changeToRed(2)">';
echo         '   <div class="number">'.$IOne.'</div>';
echo        '</td>';
echo        '<td id="3" onclick="changeToRed(3)">';
echo         '   <div class="number">'.$NOne.'</div>';
echo        '</td>';
echo        '<td id="4" onclick="changeToRed(4)">';
echo         '   <div class="number">'.$GOne.'</div>';
echo        '</td>';
echo        '<td id="5" onclick="changeToRed(5)">';
echo         '   <div class="number">'.$OOne.'</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo     '   <td id="6" onclick="changeToRed(6)">';
echo      '      <div class="number">'.$BTwo.'</div>';
echo       ' </td>';
echo        '<td id="7" onclick="changeToRed(7)">';
echo         '   <div class="number">'.$ITwo.'</div>';
echo        '</td>';
echo        '<td id="8" onclick="changeToRed(8)">';
echo         '   <div class="number">'.$NTwo.'</div>';
echo        '</td>';
echo       ' <td id="9" onclick="changeToRed(9)">';
echo        '    <div class="number">'.$GTwo.'</div>';
echo        '</td>';
echo        '<td id="10" onclick="changeToRed(10)">';
echo         '   <div class="number">'.$OTwo.'</div>';
echo        '</td>';
echo    '</tr>';

 echo   '<tr>';
echo        '<td id="11" onclick="changeToRed(11)">';
echo            '<div class="number">'.$BThree.'</div>';
echo        '</td>';
echo        '<td id="12" onclick="changeToRed(12)">';
echo            '<div class="number">'.$IThree.'</div>';
echo        '</td>';
echo        '<td id="13" onclick="changeToRed(13)">';
echo            '<div class="number">FREE</div>';
echo        '</td>';
echo        '<td id="14" onclick="changeToRed(14)">';
echo            '<div class="number">'.$GThree.'</div>';
echo        '</td>';
echo        '<td id="15" onclick="changeToRed(15)">';
echo           '<div class="number">'.$OThree.'</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo        '<td id="16" onclick="changeToRed(16)">';
echo            '<div class="number">'.$BFour.'</div>';
echo        '</td>';
echo        '<td id="17" onclick="changeToRed(17)">';
echo            '<div class="number">'.$IFour.'</div>';
echo        '</td>';
echo        '<td id="18" onclick="changeToRed(18)">';
echo            '<div class="number">'.$NFour.'</div>';
echo        '</td>';
echo        '<td id="19" onclick="changeToRed(19)">';
echo            '<div class="number">'.$GFour.'</div>';
echo        '</td>';
echo        '<td id="20" onclick="changeToRed(20)">';
echo            '<div class="number">'.$OFour.'</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo        '<td id="21" onclick="changeToRed(21)">';
echo           '<div class="number">'.$BFive.'</div>';
echo        '</td>';
echo        '<td id="22" onclick="changeToRed(22)">';
echo            '<div class="number">'.$IFive.'</div>';
echo        '</td>';
echo        '<td id="23" onclick="changeToRed(23)">';
echo            '<div class="number">'.$NFive.'</div>';
echo        '</td>';
echo        '<td id="24" onclick="changeToRed(24)">';
echo            '<div class="number">'.$GFive.'</div>';
echo        '</td>';
echo        '<td id="25" onclick="changeToRed(25)">';
echo            '<div class="number">'.$OFive.'</div>';
echo        '</td>';
echo '</tr></p>';
echo        '<br /><br/>';
echo        '<p id="fourSquares"></p>';
echo '</div>';

//start of computer player card
echo '<table id = computer>';
echo '<thead>Computer Game</thead>';
echo '<tr>';
echo '<td>';
echo            '<div class="letter">B</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">I</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">N</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">G</div>';
echo        '</td>';
echo        '<td>';
echo            '<div class="letter">O</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo     '  <td id="26" onclick="markComputer(26)">';
echo      '      <div class="number">'.$BCOne.'</div>';
echo       ' </td>';
echo        '<td id="27" onclick="markComputer(27)">';
echo         '   <div class="number">'.$ICOne.'</div>';
echo        '</td>';
echo        '<td id="28" onclick="markComputer(28)">';
echo         '   <div class="number">'.$NCOne.'</div>';
echo        '</td>';
echo        '<td id="29" onclick="markComputer(29)">';
echo         '   <div class="number">'.$GCOne.'</div>';
echo        '</td>';
echo        '<td id="30" onclick="markComputer(30)">';
echo         '   <div class="number">'.$OCOne.'</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo     '   <td id="31" onclick="markComputer(31)">';
echo      '      <div class="number">'.$BCTwo.'</div>';
echo       ' </td>';
echo        '<td id="32" onclick="markComputer(32)">';
echo         '   <div class="number">'.$ICTwo.'</div>';
echo        '</td>';
echo        '<td id="33" onclick="markComputer(33)">';
echo         '   <div class="number">'.$NCTwo.'</div>';
echo        '</td>';
echo       ' <td id="34" onclick="markComputer(34)">';
echo        '    <div class="number">'.$GCTwo.'</div>';
echo        '</td>';
echo        '<td id="35" onclick="markComputer(35)">';
echo         '   <div class="number">'.$OCTwo.'</div>';
echo        '</td>';
echo    '</tr>';

echo   '<tr>';
echo        '<td id="36" onclick="markComputer(36)">';
echo            '<div class="number">'.$BCThree.'</div>';
echo        '</td>';
echo        '<td id="37" onclick="markComputer(37)">';
echo            '<div class="number">'.$ICThree.'</div>';
echo        '</td>';
echo        '<td id="38" onclick="markComputer(38)">';
echo            '<div class="number">FREE</div>';
echo        '</td>';
echo        '<td id="39" onclick="markComputer(39)">';
echo            '<div class="number">'.$GCThree.'</div>';
echo        '</td>';
echo        '<td id="40" onclick="markComputer(40)">';
echo           '<div class="number">'.$OCThree.'</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo        '<td id="41" onclick="markComputer(41)">';
echo            '<div class="number">'.$BCFour.'</div>';
echo        '</td>';
echo        '<td id="42" onclick="markComputer(42)">';
echo            '<div class="number">'.$ICFour.'</div>';
echo        '</td>';
echo        '<td id="43" onclick="markComputer(43)">';
echo            '<div class="number">'.$NCFour.'</div>';
echo        '</td>';
echo        '<td id="44" onclick="markComputer(44)">';
echo            '<div class="number">'.$GCFour.'</div>';
echo        '</td>';
echo        '<td id="45" onclick="markComputer(45)">';
echo            '<div class="number">'.$OCFour.'</div>';
echo        '</td>';
echo    '</tr>';

echo    '<tr>';
echo        '<td id="46" onclick="markComputer(46)">';
echo           '<div class="number">'.$BCFive.'</div>';
echo        '</td>';
echo        '<td id="47" onclick="markComputer(47)">';
echo            '<div class="number">'.$ICFive.'</div>';
echo        '</td>';
echo        '<td id="48" onclick="markComputer(48)">';
echo            '<div class="number">'.$NCFive.'</div>';
echo        '</td>';
echo        '<td id="49" onclick="markComputer(49)">';
echo            '<div class="number">'.$GCFive.'</div>';
echo        '</td>';
echo        '<td id="50" onclick="markComputer(50)">';
echo            '<div class="number">'.$OCFive.'</div>';
echo        '</td>';
echo '</tr></p>';
echo        '<br />';
echo        '<p id="fourSquares"></p>';
echo '</div>';
?>

</body>
</html>
