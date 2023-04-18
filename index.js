let t = 500; //time duration

let textWrapper = document.querySelector('.ml12');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");// Wraps every letter in a span

anime.timeline({loop: false})
  .add({
    targets: '.ml12 .letter',
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: t,
    delay: (el, i) => t + 30 * i
  });

let textWrapper = document.querySelector('.ml13');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");// Wraps every letter in a span

anime.timeline({loop: false})
  .add({
    targets: '.ml13 .letter',
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: t,
    delay: (el, i) => t + 30 * i
  });


var textWrapper = document.querySelector('.ml14');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");// Wraps every letter in a span

anime.timeline({loop: false})
  .add({
    targets: '.ml14 .letter',
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: t,
    delay: (el, i) => t + 15 * i
  });


let tx = 100; //time duration
anime.timeline({loop: false})
  .add({
    targets: '.stag4',
    opacity: [0, 1],
    easing: "easeOutExpo",
    duration: tx,
  },)
  .add({
    targets: '.stag3',
    opacity: [0, 1],
    easing: "easeOutExpo",
    duration: tx,
  },'-=80') // relative offset
  .add({
    targets: '.stag2',
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: tx,
  },'-=80') // relative offset
  .add({
    targets: '.stag1',
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: tx,
  },'-=80') // relative offset
  .add({
    targets: '.stag0',
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: tx,
  },'-=80') // relative offset;

