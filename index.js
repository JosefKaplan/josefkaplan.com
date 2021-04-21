let firstText = document.getElementById("firstText");
anime.timeline({loop: false})
  .add({
  targets: firstText,
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: 1500,
  delay: 0
  });

let secondText = document.getElementById("secondText");
anime.timeline({loop: false})
  .add({
    targets: secondText,
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 1200,
    delay: 2000
  });

let thirdText = document.getElementById("thirdText");
anime.timeline({loop: false})
  .add({
    targets: thirdText,
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 1200,
    delay: 3300
  });

let fourthText = document.getElementById("fourthText");
anime.timeline({loop: false})
  .add({
    targets: fourthText,
    translateX: [40,0],
    translateZ: 0,
    opacity: [0,1],
    easing: "easeOutExpo",
    duration: 1200,
    delay: 5300
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
    duration: 1200,
    delay: (el, i) => 500 + 30 * i
  });

