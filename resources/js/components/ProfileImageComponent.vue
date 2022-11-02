<script>
import FooterComponent from "./FooterComponent.vue";

export default {
    props: {
        avatar: String,
        username: String,
    },
    data() {
        return {
            avatar_image: null,
            updated: false,
        };
    },
    methods: {
        insertedFile(e) {
            this.avatar_image = e.target.files[0];
        },
        updImage() {
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            const data = new FormData();
            data.append("avatar", this.avatar_image);
            console.log(data);
            axios
                .post("http://localhost:8000/profile", data, config)
                .then((response) => {
                    this.updated = true;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    components: { FooterComponent },
};
</script>
<template>
    <div class="container">
        <div v-if="!updated">
            <div class="text-white">
                <div class="d-flex align-items-center">
                    <div class="avatar-container">
                        <img
                            :src="'/uploads/avatars/' + avatar"
                            class="current-avatar"
                        />
                    </div>
                    <div class="ms-5">
                        <h2>{{ username }}'s profile</h2>
                        <form
                            @submit.prevent="updImage()"
                            enctype="multipart/form-data"
                            action="/profile"
                            method="POST"
                        >
                            <label class="form-label"
                                >Select a new profile image</label
                            >
                            <input
                                type="file"
                                name="avatar_image"
                                @change="insertedFile($event)"
                                class="form-control"
                            />
                            <div class="mt-4">
                                <button class="btn btn-danger">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="alert text-center py-3" role="alert">
                <h3>
                    Image updated with success! <br />
                    Return to the
                    <a
                        href="http://localhost:8000/home"
                        class="text-decoration-none text-danger"
                        >home page.</a
                    >
                </h3>
            </div>
        </div>
    </div>
    <div class="footer-container">
        <FooterComponent></FooterComponent>
    </div>
</template>
<style scoped>

.current-avatar {
    width: 10em;
    border-radius: 50%;
    border: 10px solid red;
    transition: all ease-in-out 0.6s;
}
.current-avatar:hover {
    transform: scale(1.1);
    transition: all ease-in-out 0.5s;
}
.footer-container{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
}
</style>
