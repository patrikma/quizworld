<template>
    <div class="score-wrapper">
        <Header title="Vaše výsledky"></Header>

        <ResultsHeader></ResultsHeader>

        <div v-if="comparedResults" class="results">
            <div v-for="result in comparedResults" class="result-wrapper">
                <Result :result="result"></Result>
            </div>
        </div>
        <div class="rating">
            <p>Úspěšnost:</p>
            <p>{{this.score}} %</p>
        </div>
    </div>
</template>

<script>
    import Header from "../elements/Header";
    import Result from "./Result";
    import ResultsHeader from "./ResultsHeader";

    import axios from "axios";
    import store from "../../vuex-store";

    export default {
        name: "Score",
        data() {
            return {
                correctResults: null,
                comparedResults: null,
                score: null
            }
        },
        created() {
            this.fetchCorrectAnswers().then(this.compareAnswers);
        },
        methods: {
            fetchCorrectAnswers() {
                return axios.get('/api/correct-results/' + store.getters.quizId)
                    .then(response => {
                        this.correctResults = response.data;
                    })
            },
            compareAnswers() {
                const userResults = store.getters.answers;
                let compared = [];
                let correctAnswers = 0;
                for (let question of this.correctResults) {
                    const is_correct = (userResults[question.question_id] === question.answer);
                    if (is_correct) {
                        correctAnswers++;
                    }
                    compared.push({
                        question: question.text,
                        isCorrect: is_correct,
                        userAnswer: userResults[question.question_id],
                        correctAnswer: question.answer
                    })
                }
                this.comparedResults = compared;
                this.score = (correctAnswers / this.comparedResults.length) * 100;
            }
        },
        components: {
            Header,
            ResultsHeader,
            Result
        }
    }
</script>

<style scoped>
    .score-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .score-head {
        text-align: left;
    }
    .results {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .result-wrapper {
        width: 100%;
    }
</style>
