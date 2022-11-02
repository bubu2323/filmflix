<script>
export default {
    emits: ["updateFilm"],
    props: {
        categories: Object,
        titleFilms: Object,
        listFilm: Array,
    },
    data() {
        return {
            film_id: null,
            selected_film: undefined,
            title: undefined,
            year: undefined,
            director: undefined,
            plot: undefined,
            rating: undefined,
            image: null,
            statusMessage: undefined,
        };
    },
    methods: {
        insertedFile(e) {
            this.image = e.target.files[0];
        },
        editFilm() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            const data = new FormData();
            data.append("title", this.title);
            data.append("year", this.year);
            data.append("director", this.director);
            data.append("plot", this.plot);
            data.append("rating", this.rating);
            data.append("image", this.image);
            //Laravel can not handle multipart-formdata well with PUT method; instead of PUT method, use POST method with _method parameter value set to PUT (called 'method spoofing')
            data.append("_method", "put");
            console.log(data);
            axios
                .post(
                    `http://localhost:8000/api/films/${this.film_id}`,
                    data,
                    config
                )
                .then((response) => {
                    this.sendMessageConfirm(response.status);
                    this.updateFilm();
                })
                .catch((error) => {
                    console.log(error);
                    this.sendMessageConfirm(error.message);
                });      
        },
        updateFilm() {
            this.$emit("updateFilm");
        },
        sendMessageConfirm(status) {
            console.log("entra");
            if (status == 200) this.statusMessage = "Film edited correctly";
            else this.statusMessage = status;
        },

        resetMessage() {
            this.statusMessage = undefined;
        },
    },
    computed: {
        getSelectedFilm() {
            return (this.selected_film = this.listFilm.find(
                (film) => film.id === +this.film_id
            ));
        },
    },
};
</script>
<template>
    <div v-if="statusMessage">
                <div class="alert">
                    <p>
                        {{ statusMessage }}
                    </p>
                </div>
            </div>
    <div class="m-2 input-group">
        <span class="input-group-text" id="basic-addon1">Title</span>

        <select
            class="form-select"
            name="film_id"
            v-for="item in titleFilms"
            v-model="film_id"
           
        >
            <option value="" disabled>Select a film</option>
            <option v-for="(index, item) in item" :value="item">
                {{ index }}
            </option>
        </select>
    </div>
    <!-- placeholder used to display value to avoid coflict with binding -->
    <div v-if="getSelectedFilm">
        <form
            @submit.prevent="editFilm()"
            enctype="multipart/form-data"
            method="put"
        >
            
            <div class="m-2 input-group">
                <span class="input-group-text" id="basic-addon1">New title</span>

                <input
                    class="form-control"
                    type="text"
                    name="title"
                    :placeholder="getSelectedFilm.title"
                    v-model="title"
                />
            </div>
            <div class="m-2 input-group">
                <span class="input-group-text" id="basic-addon1">Year</span>

                <input
                    class="form-control"
                    type="number"
                    name="year"
                    min="1895"
                    :placeholder="getSelectedFilm.year"
                    v-model="year"
                />
            </div>
            <div class="m-2 input-group">
                <span class="input-group-text" id="basic-addon1">Director</span>

                <input
                    class="form-control"
                    type="text"
                    name="director"
                    :placeholder="getSelectedFilm.director"
                    v-model="director"
                />
            </div>
            <div class="m-2 input-group">
                <span class="input-group-text" id="basic-addon1">Plot</span>

                <textarea
                    class="form-control"
                    name="plot"
                    id=""
                    :placeholder="getSelectedFilm.plot"
                    v-model="plot"
                ></textarea>
            </div>
            <div class="m-2 input-group">
                <span class="input-group-text" id="basic-addon1">Rating</span>

                <input
                    class="form-control"
                    type="number"
                    name="rating"
                    :placeholder="getSelectedFilm.rating"
                    v-model="rating"
                />
            </div>
            <div class="m-2 input-group">
                <span class="input-group-text" id="basic-addon1">Poster</span>

                <input
                    class="form-control"
                    type="file"
                    name="image"
                    id="image"
                    @change="insertedFile($event)"
                />
            </div>
            <div class="m-2 ">

                <div class="my-2">
                    <button
                        class="btn btn-sm btn-outline-success"
                        @click="resetMessage()"
                        type="submit"
                    >
                        Update film info's
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
