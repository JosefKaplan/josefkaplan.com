const input = "Take a phrase like ‘turpentine and turtles’ and translate it into its “whale talk” equivalent."
const vowels = ['a', 'e', 'i', 'o', 'u'];
const resultArray = [];
for (let i = 0; i < input.length; i++) {
  //console.log("i is " + i); //controls i's
  for (let j = 0; j < vowels.length; j++){
    //console.log("j is " + j); //controls j'
    if (input[i] === vowels[j]) {
     if (input [i] === "e") {
       resultArray.push("ee");
     } else if (input[i] === "u") {
       resultArray.push("uu");
     } else {
       resultArray.push(input[i]);
     }
     }
    }
  }
console.log(resultArray.join("").toUpperCase());
