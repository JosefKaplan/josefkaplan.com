// Wrap every letter in a span
var seosTextWrapper = document.querySelector('.ml6');
seosTextWrapper.innerHTML = seosTextWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: false})
  .add({
    targets: '.ml6 .letter',
    translateY: ["1.1em", 0],
    translateZ: 80,
    duration: 750,
	opacity: [0,1],
    delay: (el, i) => 80 * i
  })
  
  
  
var seosTextWrapper1 = document.querySelector('.ml2');
seosTextWrapper1.innerHTML = seosTextWrapper1.textContent.replace(/\S/g, "<span class='letter'>$&</span>"); 

anime.timeline({loop: false})
  .add({
    targets: '.ml2 .letter',     translateY: ["1.1em", 0],
    scale: [14,1],
    opacity: [0,1],
    translateZ: 7,
    easing: "easeOutExpo",
    duration: 700,
    delay: function(el, i) {
      return 50*i;
    }
  })