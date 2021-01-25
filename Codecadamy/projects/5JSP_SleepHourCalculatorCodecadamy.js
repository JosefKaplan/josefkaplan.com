const getSleepHours = day => {
  if (day === 'monday') {
  return 6;
  } else if (day === 'tuesday') {
  return 8;
  } else if (day === 'wednesday') {
  return 7;
  } else if (day === 'thursday') {
  return 5;
  } else if ( day === 'friday') {
  return 4;
  } else if ( day === 'saturday') {
  return 10;
  } else if ( day === 'sunday') {
  return 9;
  } else {
   return 'Error, not a defined day of the week!';
  }
};
/* to test the function:
  console.log(getSleepHours('monday')) */
const getActualSleepHours = () => {
  return getSleepHours('monday')
  + getSleepHours('tuesday')
  + getSleepHours('thursday')
  + getSleepHours('friday')
  + getSleepHours('saturday')
  + getSleepHours('sunday')
};
const getIdealSleepHours = () => {
  const idealHours = 8;
  return idealHours * 7;
};
/* to test the functions so far:
  console.log(getIdealSleepHours());
  console.log(getActualSleepHours()); */
const calculateSleepDebt = () => {
  const actualSleepHours = getActualSleepHours();
  const idealSleepHours = getIdealSleepHours();
  if (actualSleepHours === idealSleepHours) {
  console.log('Congratulation! You\'ve had perfect amount of sleep!');
  } else if (actualSleepHours > idealSleepHours) {
  console.log('You\'ve had more than enough sleep than needed.');
  } else {
  console.log('You should get some rest.');
  }
};
