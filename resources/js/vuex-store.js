import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
     state: {
         quizId: null,
         running: false,

         questions: [],
         currentQuestionId: null,

         answers: {}
     },
    getters: {
        /**
         *
         * @param state
         * @returns {boolean} id the quiz is running
         */
        runningState(state) {
            return state.running;
        },
        /**
         *
         * @param state
         * @returns {number}
         */
        currentQuestionId(state) {
            return state.currentQuestionId;
        }
    },
    mutations: {
        /**
         * Sets new quiz id
         * @param state
         * @param id - id of the new quiz
         */
        setQuiz(state, id) {
            state.quizId = id;
        },
        /**
         * Starts the quiz
         * @param state
         */
        startQuiz(state) {
              state.running = true;
        },
        /**
         * Loads all the questions to the state
         * @param state
         * @param questions - object from API
         */
        setQuestions(state, questions) {
            state.currentQuestionId = questions[0].id;
            questions.shift();
            state.questions = questions;
        },
        /**
         * Completely resets the state
         * @param state
         */
        reset(state) {
            state.quizId = null;
            state.running = false;
            state.questions = [];
            state.currentQuestionId = null;
            state.answers = {};
        }
    }
});

export default store;
