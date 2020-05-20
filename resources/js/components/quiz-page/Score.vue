<template>
    <div class="score-wrapper">
        <Header title="Vaše výsledky"></Header>
        <div v-if="comparedResults" class="results">
            <div class="result">

            </div>
        </div>
    </div>
</template>

<script>
    import Header from "../elements/Header";

    export default {
        name: "Score",
        data() {
            return {
                comparedResults: null
            }
        },
        methods: {
            fetchCorrectAnswers() {

            }, 
            compareAnswers() {

            }
        },
        components: {
            Header
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
</style>
