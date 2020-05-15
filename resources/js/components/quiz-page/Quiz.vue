<template>
    <div class="quiz-area">
        <Initial v-if="!isRunning"></Initial>
        <Questions v-if="isRunning"></Questions>
    </div>
</template>

<script>
    import Initial from "./Initial";

    import store from "../../vuex-store";
    import Questions from "./Questions";

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
            Questions
        }
    }
</script>

<style scoped>
    .quiz-area {
        background-color: white;
        padding: 30px 15px;
        box-shadow: 0 0 14px -5px rgba(0,0,0,0.46);
    }
</style>
