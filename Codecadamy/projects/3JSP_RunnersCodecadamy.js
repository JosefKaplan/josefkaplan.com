console.log('Adult registrants run at 9:30 am or 11:00 am.'+
'Early adults run at 9:30 am.'+
'Late adults run at 11:00 am.'+
'Youth registrants run at 12:30 pm (regardless of registration time.)')

let raceNumber = Math.floor(Math.random() * 1000);
const registeredEarly = true;
const age = 18;
if (age > 18) {
  raceNumber += 1000
} else {
};
if (registeredEarly === true && age > 18) {
  console.log(`You\'ll start the race at 9:30 AM with your race number ${raceNumber}.`)
} else if (age > 18 && !registeredEarly === true) {
  console.log(`You\'ll start the race at 11:00 AM with your race number ${raceNumber}.`)
} else if (age < 18 ) {
  console.log(`You\'ll start the race at 12:30 PM with your race number ${raceNumber}.`)
} else {
  console.log('Please see yourself to the registration desk for further instructions.')
}