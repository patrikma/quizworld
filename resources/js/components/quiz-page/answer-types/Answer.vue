<template>
    <div class="answer-wrapper">
        <label for="answer">Vaše odpověď:</label>
        <input type="text" v-model="userAnswer" id="answer">
        <ContinueButton text="Pokračovat" :disabled="!userAnswer"
                        v-on:click.native="saveAndContinue"></ContinueButton>
    </div>
</template>

<script>
    import ContinueButton from "../../elements/ContinueButton";

    import store from "../../../vuex-store";

    export default {
        name: "Answer",
        props: {
            /**
             * ID of the question
             */
            questionId: {
                type: Number
            }
        },
        data() {
            return {
                options: null,
                id: this.questionId,

                userAnswer: ""
            }
        },
        methods: {
            /**
             * Saves selected option ID to store and proceeds to the next question, if no other questions
             * are available, finishes the quiz to allow displaying the score.
             */
            saveAndContinue() {
                if (!this.userAnswer) {
                    return;
                }
                store.commit('saveAnswer', {questionId: this.id, answer: this.userAnswer});
                if (store.getters.isLastQuestion) {
                    store.commit('finish');
                    return;
                }
                store.commit('nextQuestion');
            }
        },
        components: {
            // Button to confirm the answer and proceed to the next question/finish
            ContinueButton
        }
    }
</script>

<style scoped>
    .answer-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
</style>
