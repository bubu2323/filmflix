<script>
export default {
    emits: ["deleteSingleFilm"],
    props: {
        categories: Object,
        titleFilms: Object,
        listFilm: Array,
    },
    data() {
        return {
            film_id: "",
            statusMessage: undefined,
        };
    },
    methods: {
        deleteFilm() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            const data = new FormData();
            data.append("_method", "delete");
            axios
                .delete(
                    `http://localhost:8000/api/films/${this.film_id}`,
                    data,
                    config
                )
                .then((response) => {
                    this.sendMessageConfirm(response.status);
                })
                .catch((error) => {
                    this.sendMessageConfirm(error.message);
                });
            this.deleteSingleFilm();
        },
        deleteSingleFilm() {
            this.$emit("deleteSingleFilm", { film_id: this.film_id });
        },
        sendMessageConfirm(status) {
            if (status == 200) this.statusMessage = "Film deleted correctly";
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
        @submit.prevent="deleteFilm()"
        enctype="multipart/form-data"
        method="delete"
    >
        <div v-if="statusMessage">
            <div class="alert">
                <p>
                    {{ statusMessage }}
                </p>
            </div>
        </div>
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
        <div class="my-2">
            <button class="btn btn-sm btn-outline-danger">delete</button>
        </div>
    </form>
</template>
