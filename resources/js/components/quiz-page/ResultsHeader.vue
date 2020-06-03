<template>
    <div class="results-header">
        <div class="question">
            Otázka
        </div>
        <div class="user-answer">
            Vaše odpověď
        </div>
        <div class="correct-answer">
            Správná odpověď
        </div>
    </div>
</template>

<script>
    export default {
        name: "ResultsHeader"
    }
</script>

<style scoped>
    .results-header {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        text-align: left;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .question {
        flex-basis: 50%;
    }
    .user-answer {
        flex-basis: 25%;
    }
    .correct-answer {
        flex-basis: 25%;
    }
</style>
