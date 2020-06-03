<template>
    <div class="options-wrapper">
        <ol v-if="options" class="options-list">
            <li v-for="{id, text} in options" :key="id"
                @click="selectOption(text)" v-bind:class="{selected: (selectedOption === text)}">
                {{text}}
            </li>
        </ol>
        <ContinueButton text="Pokračovat" :disabled="!isOptionSelected"
                        v-on:click.native="saveAndContinue"></ContinueButton>
    </div>
</template>

<script>
    import ContinueButton from "../../elements/ContinueButton";

    import axios from "axios";
    import store from "../../../vuex-store";

    export default {
        name: "Options",
        props: ['questionId'],
        data() {
            return {
                options: null,
                id: this.questionId,

                selectedOption: ""
            }
        },
        created() {
            this.fetchOptions();
        },
        computed: {
            isOptionSelected() {
                return this.selectedOption !== "";
            },
        },
        methods: {
            /**
             * Gets all options for this question
             */
            fetchOptions() {
                axios.get('/api/all-options/' + this.id)
                    .then(response => {
                        this.options = response.data
                    })
            },
            /**
             * Marks the selected option and saves it
             * @param text - option
             */
            selectOption(text) {
                this.selectedOption = text;
            },
            /**
             * Saves selected option ID to store and proceeds to the next question, if no other questions
             * are available, finishes the quiz to allow displaying the score.
             */
            saveAndContinue() {
                if (!this.selectedOption) {
                    return;
                }
                store.commit('saveAnswer', {questionId: this.id, answer: this.selectedOption});
                if (store.getters.isLastQuestion) {
                    store.commit('finish');
                    return;
                }
                store.commit('nextQuestion');
            }
        },
        components: {
            ContinueButton
        }
    }
</script>

<style scoped>
    .options-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .options-list {
        list-style: none;
        counter-reset: options-counter;
        margin-bottom: 0;
        padding: 0;
    }
    .options-list li {
        counter-increment: options-counter;
        font-size: 1.2rem;
    }
    .options-list > li:hover::before{
        background-color: #10a187;
    }
    .options-list > li:hover{
        cursor: pointer;
    }
    .options-list > li.selected::before {
        background-color: #10a187;
    }
    .options-list li::before {
        content: counter(options-counter, upper-alpha);
        color: white;
        background-color: #2172a1;
        border-radius: 50%;
        font-weight: 700;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 32px;
        width: 32px;
        transition: background-color .5s;
    }

    .options-list li:not(:last-child) {
        margin-bottom: 15px;
    }

</style>
