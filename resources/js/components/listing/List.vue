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
                <Item :id="id" :name="name" :total="total"></Item>
            </div>
        </div>
    </div>
</template>

<script>
    import Header from "../elements/Header";
    import Item from "./Item";

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
             * Resets store tu default state (in case a user returned from a quiz)
             */
            resetStore() {
                store.commit('reset');
            }
        },
        components: {
            // Header
            Header,
            // Quiz item in the list
            Item
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
</style>
