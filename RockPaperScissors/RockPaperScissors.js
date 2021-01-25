setTimeout(function(){ alert("You are here wayyy longer than I anticipated!"); }, 60000);
setTimeout(function(){ alert("Huh? Don't you have anything better to do?"); }, 90000);
setTimeout(function(){ alert("I don't have all day.."); }, 120000);
setTimeout(function(){ alert("Just leave already!"); }, 150000);
setTimeout(function(){ alert("..."); }, 160000);
setTimeout(function(){ if (confirm("That's it!")) {
  window.close();
} else {
  window.close();
}}, 180000);

var userScore = 0;
var computerScore = 0;
const userScore_span = document.getElementById("user-score");
const computerScore_span = document.getElementById("computer-score");
const scoreBoard_div = document.querySelector(".score-board");
const result_p = document.querySelector(".result > p");
const rock_div = document.getElementById("r");
const paper_div = document.getElementById("p");
const scissors_div = document.getElementById("s");

/*--------testing buttons------------
rock_div.addEventListener('click', function() {
  console.log("you clicked on rock");
});
paper_div.addEventListener('click', function() {
  console.log("you clicked on paper");
});
scissors_div.addEventListener('click', function() {
  console.log("you clicked on scissors");
});*/

function getComputerChoice() {
  const choices = ['r', 'p', 's'];
  const randomNumber = Math.floor(Math.random() * 3);
  return choices[randomNumber];
}

function convertToWord(letter) {
  if (letter === "r") return "Rock";
  if (letter === "s") return "Scissors";
  return "Paper";
}


function win(userChoice, computerChoice) {
  userScore++; //adds 1 to user score
  userScore_span.innerHTML = userScore; //displays user score in HTML
  const smallUserWord = "user".fontsize(1).sup();
  const smallComputerWord = "computer".fontsize(1).sub();
  result_p.innerHTML = `${convertToWord(userChoice)}${smallUserWord}   beats   ${convertToWord(computerChoice)}${smallComputerWord}   You   win!`;
  document.getElementById(userChoice).classList.add('green-glow'); //adds class for specific element f.e. 'green-glow' for 'userChoice'
  setTimeout(function() {document.getElementById(userChoice).classList.remove('green-glow')}, 400); //removes class 'green-glow' 0.4s after 'win'
}


function lose(userChoice, computerChoice) {
  computerScore++;
  computerScore_span.innerHTML = computerScore;
  const smallUserWord = "user".fontsize(1).sub();
  const smallComputerWord = "computer".fontsize(1).sup();
  result_p.innerHTML = `${convertToWord(computerChoice)}${smallComputerWord}   beats   ${convertToWord(userChoice)}${smallUserWord}   You   lose!`;
  document.getElementById(userChoice).classList.add('red-glow');
  setTimeout(function() {document.getElementById(userChoice).classList.remove('red-glow')}, 400);
}

function draw(userChoice, computerChoice) {
  const smallUserWord = "user".fontsize(1).sup();
  const smallComputerWord = "computer".fontsize(1).sub();
  result_p.innerHTML = `${convertToWord(computerChoice)}${smallComputerWord}   eaquals   ${convertToWord(userChoice)}${smallUserWord}   It's   a   draw!`;
  document.getElementById(userChoice).classList.add('gray-glow');
  setTimeout(function() {document.getElementById(userChoice).classList.remove('gray-glow')}, 400); 
}

function game(userChoice) {
  const computerChoice = getComputerChoice();
  switch (userChoice + computerChoice) {
    case "rs":
    case "pr":
    case "sp":
      win(userChoice, computerChoice);
      break;
    case "rp":
    case "ps":
    case "sr":
      lose(userChoice, computerChoice);
      break;
    case "rr":
    case "pp":
    case "ss":
      draw(userChoice, computerChoice);
      break;
  }
}

  function main () {

    rock_div.addEventListener('click', function() {
      game("r");
    });

    paper_div.addEventListener('click', function() {
      game("p");
    });

    scissors_div.addEventListener('click', function() {
      game("s");
    });

  }

main();


