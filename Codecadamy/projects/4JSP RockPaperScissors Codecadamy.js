const getUserChoice = userInput => {
    userInput = userInput.toLowerCase();
       if (userInput === 'rock' || userInput === 'paper' || userInput === 'scissors') {
      return userInput;
    } else {
      console.log('Error, please use valid entry! '+'Valid entry is either rock, paper or scissors!')
    }
  }
function getComputerChoice () {
  const randomNumber = Math.floor(Math.random() * 3)
    switch (randomNumber) {
      case 0:
        return 'rock'
        break;
      case 1: 
        return 'paper'
        break;
      case 2: 
        return 'scissors'
        break;
    }
  }
/* testing function to randomly select computerchoice
  console.log(getComputerChoice());
    run this script to check the getComputerChoice function*/
function determineWinner (userChoice,computerChoice) {
  if (userChoice === computerChoice){
    return 'The game is a tie!';
  }
  if (userChoice === 'rock') {
    if (computerChoice === 'paper') {
      return 'Computer has won!';
    } else {
      return 'You have won!';
    }
  }
  if (userChoice === 'paper') {
    if (computerChoice === 'scissors'){
      return 'Computer has won!';
    } else {
      return 'You have won!';
    }
  }
  if (userChoice === 'scissors') {
    if (computerChoice === 'rock') {
      return 'Computer has won!';
    } else {
      return 'You have won!';
    }
  }
}
/* testing function to determine winner:

  console.log(determineWinner('paper', 'scissors'));
    prints something like 'The computer won!'
  console.log(determineWinner('paper', 'paper')); 
    prints something like 'The game is a tie!'
  console.log(determineWinner('paper', 'rock')); 
    prints something like 'The user won!' */
const playGame = () => {
  const userChoice = getUserChoice('scissors');
  const computerChoice = getComputerChoice();
  console.log('You chose: ' + userChoice);
  console.log('The computer chose: ' + computerChoice);
  console.log(determineWinner(userChoice,computerChoice));
  };
playGame()

