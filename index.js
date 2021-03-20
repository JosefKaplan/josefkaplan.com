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
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: 1500,
  delay: 1000
});

let thirdText = document.getElementById("thirdText");
anime.timeline({loop: false})
  .add({
  targets: thirdText,
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: 2000,
  delay: 2300
});

let fourthText = document.getElementById("fourthText");
anime.timeline({loop: false})
  .add({
  targets: fourthText,
  opacity: [0,1],
  easing: "easeInOutQuad",
  duration: 2500,
  delay: 5000
});

