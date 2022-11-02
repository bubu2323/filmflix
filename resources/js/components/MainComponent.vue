<script>
export default {
    emits: ["updAddCurrentLikes"],
    props: {
        filmsList: Array,
        idUser: String,
        currentLikes: Array,
    },
    data() {
        return {};
    },
    mounted() {},
    methods: {
        updCurrentLikes(idUser, filmId) {
            this.$emit("updAddCurrentLikes", idUser, filmId);
        },
    },
    computed: {},
};
</script>

<template>
    <div class="container">
        <div class="m-4"><h3 class="text-light">All shows</h3></div>

        <div class="cards-container">
            <div v-for="film in filmsList" class="cardfilm card wallpaper">
                <div class="infos">
                    <h4 class="film-title">
                        {{ film.title }}
                        <span class="film-year">({{ film.year }})</span>
                    </h4>
                    <hr class="hr-card" />
                    <div class="reverse">
                        <div>
                            <span
                                v-for="x in film.categories"
                                class="category-name"
                                >{{ x.category_name }} |
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <img
                        :src="'storage/' + film.image"
                        alt=""
                        class="img-card"
                    />
                    <p>{{ film.plot }}</p>
                </div>

                <div class="rating">{{ film.rating }}★</div>
                <div>
                    <LikeComponent
                        :filmsList="filmsList"
                        :filmId="film.id"
                        :idUser="idUser"
                        :currentLikes="currentLikes"
                        @upd-add-current-likes="updCurrentLikes"
                    ></LikeComponent>
                </div>
              
            </div>
        </div>
    </div>
</template>

<style scoped>
@import "../../css/main.css";

</style>
