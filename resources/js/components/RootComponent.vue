<script>
import MainComponent from "./MainComponent.vue";
import HeroComponent from "./HeroComponent.vue";
import AddFilmComponent from "./AddFilmComponent.vue";
import AddRelationsComponent from "./AddRelationsComponent.vue";
import EditFilmComponent from "./EditFilmComponent.vue";
import DeleteFilmComponent from "./DeleteFilmComponent.vue";
import MostPopularComponent from "./MostPopularComponent.vue";
import SearchComponent from "./SearchComponent.vue";

export default {
    props: ["id_user"],
    data() {
        return {
            films: [],
            categories: [],
            filterCat: "",
            filterFilm: "",
            idUser: this.id_user,
            likes: [],
            filmsFetched: false,
        };
    },
    methods: {
        getFilms() {
            axios.get("/api/films").then((response) => {
                this.films = response.data;
                console.log(this.films);
                let map = new Map();

                this.films.forEach((film) => {
                    map.set(film.id, film.title);
                });

                this.filterFilm = Object.fromEntries(map);
                this.filmsFetched = true;
            });
        },
        getCategories() {
            axios.get("/api/categories").then((response) => {
                this.categories = response.data;

                let map = new Map();

                this.categories.forEach((cat) => {
                    map.set(cat.id, cat.category_name);
                });

                this.filterCat = Object.fromEntries(map);
            });
        },
        //viene chiamata all'add e aggiorna i dati di likes senza l'id'
        updateLikes(idUser, filmId) {
            this.getLikes();
        },
        reload() {
            console.log('entrato in relof');
            this.getFilms();
        },
        deleteSingleFilm(x) {
            this.films = this.films.filter((film) => film.id !== x);
        },
        getLikes() {
            axios
                .get("http://localhost:8000/api/likes")
                .then((response) => {
                    console.warn(response);
                    this.likes = response.data;
                    console.log(this.likes);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getFilms();
        this.getCategories();
        this.getLikes();
    },
    updated() {
        console.log("aggiornato");
    },
    components: {
    MainComponent,
    HeroComponent,
    AddFilmComponent,
    AddRelationsComponent,
    EditFilmComponent,
    DeleteFilmComponent,
    MostPopularComponent,
    SearchComponent,
    
},
};
</script>
<template>
    <div v-if="filmsFetched">
        <HeroComponent :filmsList="this.films"></HeroComponent>

        <randomQuoteComponent></randomQuoteComponent>


        <MostPopularComponent :filmsList="this.films"></MostPopularComponent>
        <MainComponent
            :filmsList="this.films"
            :idUser="idUser"
            @upd-add-current-likes="updateLikes"
            :currentLikes="likes"
        ></MainComponent>

        <template v-if="id_user === '1'">
            <div class="container">
                <!-- Modal add film -->
                <div
                    class="modal fade"
                    id="addFilmModal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div
                        class="modal-dialog modal-dialog modal-dialog-centered"
                    >
                        <div class="modal-content">
                            <h3 class="text-center m-2">Add new film</h3>
                            <div class="modal-body">
                                <AddFilmComponent
                                    @add-new-film="reload()"
                                ></AddFilmComponent>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal add film -->
                <div
                    class="modal fade"
                    id="addRelationModal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div
                        class="modal-dialog modal-dialog modal-dialog-centered"
                    >
                        <div class="modal-content">
                            <h3 class="text-center m-2">Add new relation</h3>
                            <div class="modal-body">
                                <!-- emit inefficente -->
                                <AddRelationsComponent
                                    :categories="{ filterCat }"
                                    :titleFilms="{ filterFilm }"
                                    @add-new-relation="reload()"
                                ></AddRelationsComponent>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal edit film -->
                <div
                    class="modal fade"
                    id="editFilm"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div
                        class="modal-dialog modal-dialog modal-dialog-centered"
                    >
                        <div class="modal-content">
                            <h3 class="text-center m-2">Edit film</h3>
                            <div class="modal-body">
                                <EditFilmComponent
                                    :categories="{ filterCat }"
                                    :titleFilms="{ filterFilm }"
                                    :listFilm="films"
                                    @update-film="reload()"
                                ></EditFilmComponent>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- delete modal -->
                <div
                    class="modal fade"
                    id="deleteFilm"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                >
                    <div
                        class="modal-dialog modal-dialog modal-dialog-centered"
                    >
                        <div class="modal-content">
                            <h3 class="text-center m-2">delete film</h3>
                            <div class="modal-body">
                                <DeleteFilmComponent
                                    :categories="{ filterCat }"
                                    :titleFilms="{ filterFilm }"
                                    :listFilm="films"
                                    @delete-single-film="reload()"
                                ></DeleteFilmComponent>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            <SearchComponent :filmsList="this.films"></SearchComponent>
        </div>

            <FooterComponent></FooterComponent>
        </template>
    </div>
</template>
