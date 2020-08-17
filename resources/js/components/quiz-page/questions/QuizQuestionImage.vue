<template>
    <div v-if="path" class="img-wrapper">
        <img :src="path" class="img" alt="obrázek k otázce">
    </div>
</template>

<script>
    export default {
        name: "QuestionImage",
        props: {
            /**
             * ID of the question it belongs to
             */
            questionId: Number
        },
        data() {
            return {
                path: null
            }
        },
        created() {
            this.fetchImagePath();
        },
        methods: {
            /**
             * Gets path of the image with the given ID and saves it
             * Image is optional and does not have to be loaded
             */
            fetchImagePath() {
                axios.get('/api/question-image/' + this.questionId)
                    .then( response => {
                        this.path = response.data.path;
                    })
            }
        }
    }
</script>

<style scoped>
    .img-wrapper {
        width: 100%;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img {
        max-width: 100%;
        box-shadow: 0 0 10px -1px rgba(0,0,0,0.46);
    }
    @media screen and (min-width: 576px)  {
        .img {
            max-width: 80%;
        }
    }
</style>
