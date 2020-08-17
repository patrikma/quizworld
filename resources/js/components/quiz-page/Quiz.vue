<template>
    <div class="quiz-area">
        <!-- Display specific content depending on the state in the Vuex store -->
        <Initial v-if="!isRunning"></Initial>
        <Questions v-if="isRunning && !hasFinished"></Questions>
        <Score v-if="hasFinished"></Score>
    </div>
</template>

<script>
    import Initial from "./initial/QuizInitial";
    import Score from "./score/QuizScore";
    import Questions from "./questions/QuizQuestions";

    import store from "../../vuex-store";

    export default {
        name: "Quiz",
        data() {
            return {
                running: false
            }
        },
        created() {
            this.saveId();
        },
        computed: {
            /**
             * Checks if the quiz has been started
             */
            isRunning() {
                return store.getters.runningState;
            },
            /**
             * Checks if the quiz has finished
             */
            hasFinished() {
                return store.getters.hasFinished;
            }
        },
        methods: {

            /**
             * Save id of the current quiz for future operations
             */
            saveId() {
                store.commit('setQuiz', this.$route.params.id);
            }
        },
        components: {
            // Initial screen with a start button
            Initial,
            // Questions
            Questions,
            //Final screen with results
            Score
        }
    }
</script>

<style scoped>
    .quiz-area {
        background-color: white;
        padding: 30px 15px;
        margin-bottom: 30px;
        box-shadow: 0 0 14px -5px rgba(0,0,0,0.46);
    }
</style>
