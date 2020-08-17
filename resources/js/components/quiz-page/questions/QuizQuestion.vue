<template>
    <div class="question">
        <span class="counter">Otázka č. {{details.counter}} z celkem {{total}}</span>
        <h1 class="question-text">{{details.text}}</h1>
        <QuestionImage :questionId="details.id" :key="details.counter"></QuestionImage>
        <!-- Display suitable answer type -->
        <Options v-if="details.type === 0" :questionId="details.id" :key="details.id"></Options>
        <Answer v-if="details.type === 1" :questionId="details.id" :key="details.id"></Answer>
    </div>
</template>

<script>
    import Options from "./answer-types/QuizQuestionAnswerOptions";
    import Answer from "./answer-types/QuizQuestionAnswerText";
    import QuestionImage from "./QuizQuestionImage";

    export default {
        name: "Question",
        props: {
            /**
             * Info about the quiz and current question
             * props:
             * id - id
             * counter - current question index (starting from 1)
             * total - total number of questions
             * text - question text
             * type - question type (0/1)
             */
            details: Object,
            /**
             * Total number of questions
             */
            total: Number
        },
        components: {
            // Image for this question (if is available)
            QuestionImage,
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
        text-align: center;
    }
</style>
