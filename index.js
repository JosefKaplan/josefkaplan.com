var t = 600; //Delay time 
let firstText = document.getElementById("firstText");
anime.timeline({loop: false})
  .add({
  targets: firstText,
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: 1000,
  delay: t
  });

let secondText = document.getElementById("secondText");
anime.timeline({loop: false})
  .add({
    targets: secondTet,
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 1000,
    delay: t+(t/8)
  });

let thirdText = document.getElementById("thirdText");
anime.timeline({loop: false})
  .add({
    targets: thirdText,
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 1000,
    delay: t+(t/2)
  });

let fourthText = document.getElementById("fourthText");
anime.timeline({loop: false})
  .add({
    targets: fourthText,
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 1000,
    delay: t+t
  });

// Wrap every letter in a span
var textWrapper = document.querySelector('.ml12');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: false})
  .add({
    targets: '.ml12 .letter',
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 500,
    delay: (el, i) => 500 + 30 * i
  });

  
