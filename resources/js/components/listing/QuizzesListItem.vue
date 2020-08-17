<template>
    <router-link :to="{name: 'quizPage', params: {id: id}}" class="quiz-item">
        <div class="left">
            <img src="/img/list-icon.svg" alt="ikona">
            <div class="info">
                <span class="name">{{name}}</span>
                <span class="total">Celkem otázek: {{total}}</span>
            </div>
        </div>
    </router-link>
</template>

<script>
    export default {
        name: "Item",
        props: {
            /**
             * ID of the quiz
             */
            id : Number,
            /**
             * Name of the quiz
             */
            name: String,
            /**
             * Total number of questions belonging to the quiz
             */
            total: Number
        }
    }
</script>

<style scoped>
    *:focus {
        outline: none;
    }
    .quiz-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 2px solid #dfdfdf;
        text-decoration: none;
        color: inherit;
        transition:  border-bottom-color .5s;
    }
    .quiz-item:hover {
        border-bottom-color: #287a97;
    }
    .left {
        display: flex;
        flex-grow: 1;
        align-items: center;
        margin-right: 5px;
    }
    .left img {
        max-width: 30px;
        margin-right: 10px;
    }
    .info {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .info .name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #287a97;
    }
    .info .total {
        font-size: .9rem;
    }
</style>
