<template>
    <div class="question">
        <span class="counter">Otázka č. {{details.counter}} z celkem {{total}}</span>
        <h1 class="question-text">{{details.text}}</h1>
        <Options v-if="details.type === 0" :questionId="details.id" :key="details.id"></Options>
        <Answer v-if="details.type === 1" :questionId="details.id" :key="details.id"></Answer>
    </div>
</template>

<script>
    import Options from "./answer-types/Options";
    import Answer from "./answer-types/Answer";

    import axios from "axios";
    import store from "../../vuex-store";

    export default {
        name: "Question",
        props: ['details', 'total'],
        components: {
            // First type of a question - a couple of options to choose from
            Options,
            // Second type of a question - a text answer
            Answer
        }
    }
</script>

<style scoped>
    .question {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .counter {
        font-size: .9rem;
        margin-bottom: 10px;
    }
    .question-text {
        font-size: 1.6rem;
        margin-bottom: 20px;
    }
</style>
