<script>

import { VueperSlides, VueperSlide } from "vueperslides";
import "vueperslides/dist/vueperslides.css";

export default {
    components: { VueperSlides, VueperSlide },
    props: {
        filmsList: Array,
        filteredBy:String
    },
    data() {
        return {
            films: this.filmsList,

            slides: [],
            currentYear: new Date().getFullYear(),
        };
    },
    methods: {
        getFilmsForSlider() {
            this.films.forEach((film) => {
                if(film.year >= this.currentYear){
                let obj = {
                    title: film.title,
                    image: film.image,
                    plot: film.plot,
                    year:film.year
                };
                    this.slides.push(obj);
                }
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
    <div class="container-pop">
        <div class="m-4"><h3 class="most-popular">New releases</h3></div>
        <div>
            <vueper-slides
                class="no-shadow"
                :visible-slides="6"
                slide-multiple
                :slide-ratio="1 / 5"
                :gap="2"
                :arrows-outside="false"
                :breakpoints="
    {
        600:
            { visibleSlides: 2, slideMultiple: 2 },

            900: {visibleSlides: 3, slideMultiple: 2 },
    }"
            >
                <vueper-slide
                    v-for="(slide, i) in slides"
                    :key="i"
                    
                    :image="'storage/' + slide.image"
                />
            </vueper-slides>
        </div>
    </div>
</template>
<style>
@import "../../css/mostPopular.css";


</style>
