const myAge = 10;
earlyYears = earlyYears * 10.5;
var laterYears = myAge - 2; /*The first two years of a dog’s life count as 10.5 dog years each.*/
laterYears *= 4; /*Number of dog years accounted for by your later years.*/
var myAgeInDogYears = earlyYears + laterYears; /* Sum of earlyYears and laterYears.*/
const myName = 'Josef Kaplan' .toLowerCase(); /*My name as a string in lowercase in variable myName.*/
console.log(`My name is ${myName}. I am ${myAge} years old in human years which is ${myAgeInDogYears} years old in dog years.`);