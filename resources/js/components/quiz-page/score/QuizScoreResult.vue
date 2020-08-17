<template>
    <div class="result">
        <div class="question">
            {{result.question}}
        </div>
        <div class="user-answer" v-bind:class="{correct: result.isCorrect, incorrect: !result.isCorrect}">
            {{result.userAnswer}}
        </div>
        <div class="correct-answer">
            {{result.correctAnswer}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "Result",
        props: {
            /**
             * Result details
             * props:
             * question - text of the question
             * userAnswer - answer from the user
             * correctAnswer - correct answer
             */
            result: Object
        }
    }
</script>

<style scoped>
    .result {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        text-align: left;
        transition: background-color .25s;
        padding: 4px 0;
    }
    .result:hover {
        background-color: #eeeeee;
    }
    .question {
        flex-basis: 50%;
        padding-right: 5px;
    }
    .user-answer {
        flex-basis: 25%;
        font-weight: 700;
        padding-right: 5px;
    }
    .user-answer.correct {
        color: #2a9055;
    }
    .user-answer.incorrect {
        color: #bf0013;
    }
    .correct-answer {
        flex-basis: 25%;
    }
</style>
