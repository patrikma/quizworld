<template>
    <div class="questions">
        <Question v-if="currentQuestionId" :id="currentQuestionId"></Question>
        <p>Neukončujte prosím kvíz před jeho vyhodnocením, jinak budete muset odpovídat znovu!</p>
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
            this.fetchQuestionsAnswers();
        },
        computed: {
            currentQuestionId() {
                return store.getters.currentQuestionId;
            }
        },
        methods: {
            fetchQuestionsAnswers() {
                axios.get('/api/all-questions/' + this.$route.params.id)
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
</style>
