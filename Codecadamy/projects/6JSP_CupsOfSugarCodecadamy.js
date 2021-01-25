// Write your code below
const cupsOfSugarNeeded = 5; 
let cupsAdded = 0;
do {
  cupsAdded++; console.log(cupsAdded); 
  if (cupsOfSugarNeeded === cupsAdded) {
    console.log('Done!')
    } else {
    console.log('Still need more sugar.')
    }
} while (cupsAdded < cupsOfSugarNeeded);

