<script>
export default {
    props: {
        filmsList: Array,
    },
    data() {
        return {
            search: "",
        };
    },
    computed: {
        filteredFilms() {
            return this.filmsList.filter((film) => {
                return (
                    film.title
                        .toLowerCase()
                        .indexOf(this.search.toLowerCase()) != -1
                );
            });
        },
    },
};
</script>
<template>
    <div class="container">
        <div class="container-search text-center">
            <h4 class="text-white main-text">
                Looking for a special movie? Search it here:
            </h4>
            <div class="w-50 m-auto">
                <input
                    type="text"
                    name="search"
                    placeholder="The Father"
                    v-model="search"
                    class="form-control"
                />
            </div>
        </div>
        <div class="container-result">
            <div
                v-if="search !== ''"
                v-for="film in filteredFilms"
                :key="film.id"
                class="text-white"
            >
                <div class="d-flex margin-x">
                    <div class="">
                        <img
                            :src="'storage/' + film.image"
                            alt=""
                            class="result-img"
                        />
                    </div>
                    <div class="text-search">
                        <h5 class="title-film-search">{{ film.title }}</h5>
                        <h6>{{ film.year }}</h6>
                        <p>{{ film.plot }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
div.container-search {
    margin-top: 6em;
    margin-bottom: 2em;
}
div.container-result {
    width: 50vh;
    margin: 0 auto;
}
.result-img {
    width: 8em;
}
.margin-x {
    margin: 0.6em 0;
}
/*  -- typography --  */
h5.title-film-search {
    background-color: rgb(219, 0, 20);
    padding: 0 0.5em;
}
.text-search {
    margin-top: 0.3em;
    margin-left: 0.5em;
}
h4.main-text {
    font-size: 3vh;
}
</style>
