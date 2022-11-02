<script>
import { assert } from "@vue/compiler-core";
import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";
export default {
    components: { VueperSlides, VueperSlide },

    props: {
        filmsList: Array,
    },
    data() {
        return {
            films: this.filmsList,
            slides: [],
        };
    },

    methods: {
        getFilmsForSlider() {
            let threeFilms = this.films.slice(4, 7);
            threeFilms.forEach((film) => {
                let obj = {
                    title: film.title,
                    image: film.image,
                    plot: film.plot,
                };
                this.slides.push(obj);
            });
        },
    },
    updated() {},
    mounted() {
        this.getFilmsForSlider();
    },
};
</script>
<template>
    <vueper-slides slideImageInside autoplay>
        <vueper-slide
            v-for="(slide, i) in slides"
            :key="i"
            :title="slide.title"
            :content="slide.plot"
            :image="'storage/' + slide.image"
        >
            <button>ciao</button>
        </vueper-slide>
    </vueper-slides>
</template>
<style>
@import "../../css/addFilm.css";

</style>
