<template>
    <div class="questions">
        <Question v-if="currentQuestion.id" :details="currentQuestion" :total="getTotalNumberOfQuestions"></Question>
        <hr class="divider">
        <p class="warning">Neukončujte prosím kvíz před jeho vyhodnocením, jinak se odpovědi resetují.</p>
    </div>
</template>

<script>
    import Question from "./Question";

    import axios from "axios";
    import store from "../../vuex-store";

    export default {
        name: "Questions",
        data() {
            return {
            }
        },
        created() {
            this.fetchQuestions();
        },
        computed: {
            /**
             * Gets current question details
             */
            currentQuestion() {
                return store.getters.currentQuestion;
            },
            /**
             * Gets total number of questions for this quiz
             */
            getTotalNumberOfQuestions() {
                return store.getters.total;
            }
        },
        methods: {
            /**
             * Loads all questions for this quiz and saves them to the store
             */
            fetchQuestions() {
                axios.get('/api/all-questions/' + store.getters.quizId)
                    .then(response => {
                        store.commit('setQuestions', response.data);
                    })
            }
        },
        components: {
            //Question with answers
            Question
        }
    }
</script>

<style scoped>
    .questions {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .divider {
        margin: 25px 0;
        width: 75px;
    }
    .warning {
        margin-bottom: 0;
        font-size: .7rem;
    }
</style>
