<template>
    <div v-if="info" class="info">
        <Header :title="info.name"></Header>
        <p class="count">Kvíz obsahuje celkem <strong>{{info.total}}</strong> otázek. Bez časového omezení.</p>
        <button @click="startQuiz" class="play-button">Spustit</button>
    </div>
</template>

<script>
    import Header from "../elements/Header";

    import axios from "axios";
    import store from "../../vuex-store";

    export default {
        name: "Initial",
        data() {
            return {
                info: null
            }
        },
        created() {
            this.fetchInfo();
        },
        methods: {
            /**
             * Gets basic info about the quiz
             */
            fetchInfo() {
                axios.get('/api/quiz-info/' + this.$route.params.id)
                    .then(response => {
                        this.info = response.data;
                    })
            },
            /**
             * Starts the quiz by registering it in the store
             */
            startQuiz() {
                store.commit('startQuiz');
            }
        },
        components: {
            // Header with a name
            Header
        }
    }
</script>

<style scoped>
    .info {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .count {
        text-align: center;
    }
    .play-button {
        margin-top: 30px;
        border: 0;
        border-radius: 25px;
        padding: 5px 30px;
        color: white;
        background-color: #307c90;
        transition: .5s background-color;
    }
    .play-button:hover {
        background-color: #29889e;
    }
    .play-button:focus {
        border: 0;
        outline: none;
    }
</style>
