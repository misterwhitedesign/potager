function shuffle(array){
  let currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

document.addEventListener("DOMContentLoaded", function(event) {
  let animaux = shuffle(Array.from(document.querySelectorAll(".animal")));
  let precedent = null;
  function trigger() {
    if (precedent) {
      precedent.classList.toggle("hide");
    }
    let prochain = animaux.pop();
    if (prochain) {
      precedent = prochain;
      prochain.addEventListener("animationend", trigger);
      prochain.classList.toggle("hide");
      prochain.classList.toggle("start");
    }
  }
  trigger();
});
