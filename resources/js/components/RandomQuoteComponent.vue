<script>
import { getSomeRandom } from "popular-movie-quotes";
// console.log(getSomeRandom(1)); // returns an object of x random quotes.
export default {
    data() {
        return {
            randomQuote: getSomeRandom(1)[0],
        };
    },
};
</script>
<template>
    <div class="quote-container text-white">
        <blockquote class="quote animate__animated animate__zoomIn">"{{ randomQuote.quote }}"</blockquote>
        <p class="movie-cite animate__animated animate__fadeIn">{{ randomQuote.movie }}</p>
    </div>
</template>
<style>
@import 'animate.css';
@import url('https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap');
div.quote-container {
    text-align: center;
    margin: 4em auto;
    width: 90vw;
    padding: 1em;

}
p.movie-cite{
    font-family: 'Rock Salt', cursive;
    font-size: 1.3em;
    color: rgb(176, 156, 158);
}
p.movie-cite::before {
    content: "- ";
}
.quote {
    color: white;
    text-shadow: 0 0 5px rgb(0, 0, 0), 0 0 10px rgb(226, 70, 70), 0 0 20px #fff, 0 0 40px rgb(226, 67, 67),
        0 0 80px rgb(246, 31, 7), 0 0 90px rgb(198, 41, 10), 0 0 100px rgb(133, 3, 3), 0 0 150px rgb(89, 6, 6);
        font-weight: 600;
  text-align: center;
  text-transform: uppercase;
  font-family: "Source Sans Pro", sans-serif;
  font-size: 3em;

}
</style>
