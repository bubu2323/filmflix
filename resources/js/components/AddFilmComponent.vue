<script>
export default {
    emits: ["addNewFilm"],
    data() {
        return {
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
            // URL.createObjectURL()
        },
        addFilm() {
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
            console.log(data);
            axios
                .post("http://localhost:8000/api/films", data, config)
                .then((response) => {
                    this.sendMessageConfirm(response.status);
                    this.sendToRoot();
                })
                .catch((error) => {
                    this.sendMessageConfirm(error.message);
                });
            
        },
        sendToRoot() {
           
            let currImg = URL.createObjectURL(this.image)
            this.$emit("addNewFilm", {
                title: this.title,
                year: this.year,
                director: this.director,
                plot: this.plot,
                rating: this.rating,
                image:  currImg.replace('http://localhost:8000/storage/blob:','')
            });
            // let img = URL.createObjectURL(this.image)
            // console.log( img.replace("http://localhost:8000/storage/blob:",""));
        },
        sendMessageConfirm(status) {
            console.log(this.image);
            if (status == 200) this.statusMessage = "Film added correctly";
            else this.statusMessage = status;
        },

        resetMessage() {
            this.statusMessage = undefined;
        },
    },
};
</script>
<template>
    <form
        @submit.prevent="addFilm()"
        enctype="multipart/form-data"
        method="post"
    >
        <div v-if="statusMessage">
            <div class="alert">
                <p>
                    {{ statusMessage }}
                </p>
            </div>
        </div>
        <div class="m-2 input-group">
            <span class="input-group-text" id="basic-addon1">Title</span>
            <input
                type="text"
                name="title"
                placeholder="Spiderman"
                v-model="title"
                class="form-control"
                required
            />
        </div>
        <div class="m-2 input-group">
            <span class="input-group-text" id="basic-addon1">Year</span>
            <input
                type="number"
                name="year"
                placeholder="1999"
                v-model="year"
                class="form-control"
                min="1895"
                required
            />
        </div>
        <div class="m-2 input-group">
            <span class="input-group-text" id="basic-addon1">Director</span>
            <input
                type="text"
                name="director"
                placeholder="Stanley Kubric"
                v-model="director"
                class="form-control"
                required
            />
        </div>

        <div class="m-2 input-group">
            <span class="input-group-text" id="basic-addon1">Plot</span>
            <textarea
                name="plot"
                placeholder="a fantastic story"
                v-model="plot"
                class="form-control"
                required
            ></textarea>
        </div>

     
        <div class="m-2 input-group">
            <span class="input-group-text" id="basic-addon1">Rating</span>
            <input
                class="form-control"
                type="number"
                name="rating"
                placeholder="4"
                max="5"
                min="1"
                v-model="rating"
                required
            />
        </div>
        <div class="m-2 input-group">
            <span class="input-group-text " id="basic-addon1">Poster</span>
            <input
                class="form-control"
                type="file"
                name="image"
                id="image"
                @change="insertedFile($event)"
                required
            />
        </div>
        <div class="m-2">
            <button
                class="btn btn-outline-success mt-2"
                type="submit"
                @click="resetMessage()"
                required
            >
                Add this film
            </button>
        </div>
    </form>
</template>
<style>
@import "../../css/addFilm.css";

</style>
