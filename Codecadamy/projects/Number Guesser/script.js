let humanScore = 0;
let computerScore = 0;
let currentRoundNumber = 1;

// Write your code below:
const generateTarget = () => {
  return Math.floor(Math.random()*10);
};
function compareGuesses (humanGuess, computerGuess, targetGuess) {
  const humanDifference = Math.abs(targetGuess - humanGuess)
  const computerDifference = Math.abs(targetGuess - computerGuess)
  return humanDifference <= computerDifference;
};
function updateScore(winner) {
  if (winner === "human") {
    return humanScore = humanScore + 1;
  } else if (winner === "computer") {
    return computerScore = computerScore + 1;
  }
};
function advanceRound () {
  return currentRoundNumber++;
};
function alert () {
  if (humanGuess > 9) {
  return console.log("Your number must be between 0-9!");
  } else {
  }
};

