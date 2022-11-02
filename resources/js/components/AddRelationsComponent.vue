<script>
export default {
    emits: ["addNewRelation"],
    props: {
        categories: Object,
        titleFilms: Object,
    },
    data() {
        return {
            film_id: "",
            category_id: "",
            statusMessage: undefined,
        };
    },
    methods: {
        addRelation() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            const data = new FormData();
            data.append("film_id", this.film_id);
            data.append("category_id", this.category_id);
            axios
                .post("http://localhost:8000/api/pivot", data, config)
                .then((response) => {
                    this.sendMessageConfirm(response.status);
                })
                .catch((error) => {
                    this.sendMessageConfirm(error.message);
                });
            this.sendToRoot();
        },
        sendToRoot() {
            this.$emit("addNewRelation");
        },
        sendMessageConfirm(status) {
            console.log("entra");
            if (status == 200) this.statusMessage = "Relation added correctly";
            else this.statusMessage = status;
        },

        resetMessage() {
            this.statusMessage = undefined;
        },
    },
};
</script>
<template>
    <div>
        <form
            @submit.prevent="addRelation()"
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
            <div class="form-group m-2">
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
            <div class="form-group m-2">
                <select
                    class="form-select"
                    name="category_id"
                    v-for="item in categories"
                    v-model="category_id"
                >
                    <option value="" disabled selected>Insert category</option>
                    <option v-for="(index, item) in item" :value="item">
                        {{ index }}
                    </option>
                </select>
            </div>
            <div class="m-2">
                <button
                    class="btn btn-sm btn-outline-success"
                    type="submit"
                    @click="resetMessage()"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</template>
