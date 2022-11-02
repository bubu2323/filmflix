<script>
export default {
    emits: ["updAddCurrentLikes"],
    props: ["filmsList", "filmId", "idUser", "currentLikes"],
    data() {
        return {
            liked: false,
            likes: [],
            likesOfThisUser: [],
            iconLike: "http://127.0.0.1:5173/resources/icons/bookmark.png",
            iconRemoveLike:
                "http://127.0.0.1:5173/resources/icons/no-bookmark.png",
            likeId: null,
            currentIdLike: null,
        };
    },
    updated() {
        this.getId();
    },
    methods: {
        //get id like
        getId() {
            this.currentLikes.forEach((like) => {
                if (
                    like.film_id == this.filmId &&
                    like.user_id == this.idUser
                ) {
                    this.currentIdLike = like.id;
                
                }
            });
        },
        addLike() {
         
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            const data = new FormData();
            data.append("user_id", +this.idUser);
            data.append("film_id", this.filmId);
            console.log(data);
            axios
                .post("http://localhost:8000/api/likes", data, config)
                .then((response) => {
                    console.warn(response);
                    console.log(response.data.success);
                })
                .catch((error) => {
                    console.log(error);
                });
            this.updAddCurrentLikes(this.idUser, this.filmId);
        },
        removeLike() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            const data = new FormData();
            data.append("_method", "delete");
            axios
                .delete(
                    `http://localhost:8000/api/likes/${this.currentIdLike}`,
                    data,
                    config
                )
                .then((response) => {
                    console.warn(response);
                })
                .catch((error) => {
                    console.log(error.response);
                });
        //    this.updDeleteCurrentLikes(this.idUser, this.filmId);
        },
        updAddCurrentLikes(idUser, filmId) {
            this.$emit("updAddCurrentLikes", idUser, filmId);
        },
        updDeleteCurrentLikes() {
            this.$emit("updDeleteCurrentLikes", idUser, filmId);

        },
        toggleIcon() {
            //non funziona assegnazione con variabile:
            //let targetSrc = this.$refs.buttonIcon.src;

            this.$refs.buttonIcon.src === this.iconLike
                ? (this.$refs.buttonIcon.src = this.iconRemoveLike)
                : (this.$refs.buttonIcon.src = this.iconLike);
        },
    },
    computed: {
        checkCurrLikes() {
            this.idUser;
            let idListFilms = [];
            let notShow = [];

            //likes dell'utente corrente
            this.likesOfThisUser = this.currentLikes.filter(
                (elem) => elem.user_id == this.idUser
            );

            //lista degli id dei film
            this.filmsList.forEach((element) => idListFilms.push(element.id));
            //verifica se si e' messo like ad un film nella lista
            for (let i = 0; i < this.likesOfThisUser.length; i++) {
                for (let x = 0; x < idListFilms.length; x++) {
                    if (this.likesOfThisUser[i].film_id == idListFilms[x]) {
                        notShow.push(idListFilms[x]);
                    }
                }
            }

            //film a cui ha messo like l'utente corrente
            return notShow;
        },
    },
};
</script>
<template>
    <div v-if="!checkCurrLikes.includes(filmId)">
        <form
            @submit.prevent="addLike($event)"
            enctype="multipart/form-data"
            method="post"
        >
            <button class="favourite" type="submit">
                <img
                    class="icon-fav"
                    :src="iconRemoveLike"
                    alt=""
                    @click="toggleIcon"
                    ref="buttonIcon"
                />
            </button>
        </form>
    </div>

    <div v-else>
        <form
            @submit.prevent="removeLike($event)"
            enctype="multipart/form-data"
            method="post"
        >
            <button class="favourite" type="submit">
                <img
                    class="icon-fav"
                    :src="iconLike"
                    alt=""
                    @click="toggleIcon"
                    ref="buttonIcon"
                    :data-likeId="likeId"
                />
            </button>
        </form>
    </div>
</template>
<style>
@import "../../css/app.css";

</style>
