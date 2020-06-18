<template>
    <div class="score-wrapper">
        <Header title="Vaše výsledky"></Header>

        <!-- Results table -->
        <div v-if="comparedResults" class="results-wrapper">
            <ResultsHeader></ResultsHeader>
            <div class="results">
                <div v-for="result in comparedResults" class="result-wrapper">
                    <Result :result="result"></Result>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="rating">
            <p>Úspěšnost:</p>
            <CircleChart :percentage="this.score"></CircleChart>
        </div>
    </div>
</template>

<script>
    import Header from "../elements/Header";
    import Result from "./Result";
    import ResultsHeader from "./ResultsHeader";
    import CircleChart from "./CircleChart";

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
            /**
             * Gets all correct answers for each question
             * @return {Promise<AxiosResponse<T>>} - correct answers
             */
            fetchCorrectAnswers() {
                return axios.get('/api/correct-results/' + store.getters.quizId)
                    .then(response => {
                        this.correctResults = response.data;
                    })
            },
            /**
             * Compares user answers with the correct ones, saves them to comparedResults and calculates the
             * final score
             */
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
            // Header
            Header,
            // Header row for results
            ResultsHeader,
            // Individual result row
            Result,
            // Animated chart with success rate
            CircleChart
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
    .results-wrapper {
        width: 100%;
        overflow: auto;
    }
    .results {
        width: 100%;
        min-width: 480px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .result-wrapper {
        width: 100%;
    }
    .rating {
        margin-top: 30px;
    }
</style>
