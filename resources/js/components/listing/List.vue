<template>
    <div class="quizzes-list">
        <Header title="Všechny kvízy"></Header>
        <div class="sort-settings">
            <button class="option selected">
                Od nejnovějších
            </button>
        </div>
        <div v-if="quizzes">
            <div v-for="{id, name, total} in quizzes" class="item-wrapper">
                <router-link :to="{name: 'quizPage', params: {id: id}}" class="quiz-item">
                    <div class="left">
                        <img src="/img/list-icon.svg" alt="ikona">
                        <div class="info">
                            <span class="name">{{name}}</span>
                            <span class="total">Celkem otázek: {{total}}</span>
                        </div>
                    </div>
                    <div class="right">
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import Header from "../elements/Header";

    import axios from 'axios';
    import store from "../../vuex-store";

    export default {
        name: "List",
        data() {
            return {
                quizzes: null
            }
        },
        created() {
            this.fetchQuizzes();
            this.resetStore();
        },
        methods: {
            /**
             * Gets quizzes in a default order (sorted by the newest articles)
             */
            fetchQuizzes() {
                axios.get('/api/all-quizzes')
                    .then(response => {
                        this.quizzes = response.data;
                    })
            },

            /**
             * Resets store tu default state (in case a user returned from quiz)
             */
            resetStore() {
                store.commit('reset');
            }
        },
        components: {
            Header
        }
    }
</script>

<style scoped>
    .quizzes-list {
        background-color: white;
        padding: 30px 15px;
        box-shadow: 0 0 14px -5px rgba(0,0,0,0.46);
    }
    .sort-settings {
        width: 100%;
        margin-bottom: 20px;
    }
    button.option {
        border: none;
        background-color: white;
        font-size: .8rem;
    }
    button.option.selected {
        border-bottom: 1px solid grey;
    }
    button.option.selected:hover {
        cursor: default;
    }
    *:focus {
        outline: none;
    }
    .quiz-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 2px solid grey;
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
    .right {
        display: flex;
        flex-direction: column;
        justify-content: center;
        transition: color .5s;
    }
</style>
