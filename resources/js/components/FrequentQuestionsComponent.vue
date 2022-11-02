<script>
export default {
    props: {},
    data() {
        return {};
    },
};
</script>
<template>
    <div class="container">
        <div class="accordion-wrapper">
            <h3 class="faq-title text-white">FAQ</h3>
            <div class="accordion accordion-flush" id="faq">
                <div class="accordion-item bg-dark">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button
                            class="accordion-button collapsed bg-dark text-white"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false"
                            aria-controls="flush-collapseOne"
                        >
                            What is FilmFlix?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseOne"
                        class="accordion-collapse collapse bg-dark text-white"
                        aria-labelledby="flush-headingOne"
                        data-bs-parent="#faq"
                    >
                        <div class="accordion-body">
                            Placeholder content for this accordion, which is
                            intended to demonstrate the This is the first item's
                            accordion body.
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-dark text-white">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button
                            class="accordion-button collapsed bg-dark text-white"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo"
                            aria-expanded="false"
                            aria-controls="flush-collapseTwo"
                        >
                            How much cost FilmFlix?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseTwo"
                        class="accordion-collapse collapse"
                        aria-labelledby="flush-headingTwo"
                        data-bs-parent="#faq"
                    >
                        <div class="accordion-body">
                            FilmFlix is totaly free, no subscription or payment
                            are required for visit this site.
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-dark text-white">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button
                            class="accordion-button collapsed bg-dark text-white"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree"
                            aria-expanded="false"
                            aria-controls="flush-collapseThree"
                        >
                            How can I see all the shows?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseThree"
                        class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree"
                        data-bs-parent="#faq"
                    >
                        <div class="accordion-body">
                            <a href="#">Create</a> a free account to login to
                            the site or <a href="#">log-in</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style></style>
