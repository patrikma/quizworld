import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const store = new Vuex.Store({
     state: {
         quizId: null,
         running: false,
         finished: false,

         questions: [],
         total: null,
         currentQuestion: {
             id: null,
             type: null,
             text: "",

             counter: null
         },

         answers: {}
     },
    getters: {
        /**
         * State of the quiz
         * @param state
         * @returns {boolean} if the quiz is running
         */
        runningState(state) {
            return state.running;
        },
        /**
         * Gets id of the current quiz
         * @param state
         * @returns {number} - id of the started quiz
         */
        quizId(state) {
            return state.quizId;
        },
        /**
         * ID and name of the current question (removed from the questions array)
         * @param state
         * @returns {object} question details
         */
        currentQuestion(state) {
            return state.currentQuestion;
        },
        /**
         * Checks if no other questions are available
         * @param state
         * @returns {boolean}
         */
        isLastQuestion(state) {
            return state.questions.length === 0;
        },
        /**
         * Checks if the user has answered all questions and the quiz has finished
         * @param state
         * @returns {boolean} if the quiz has finished
         */
        hasFinished(state) {
            return state.finished;
        },
        /**
         * Returns total number of questions
         * @param state
         * @returns {number} - number of questions
         */
        total(state) {
            return state.total;
        },
        /**
         * Returns answers
         * @param state
         * @returns {object}
         */
        answers(state) {
            return state.answers;
        }
    },
    mutations: {
        /**
         * Sets a new quiz id
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
         * @param questions {array} - objects from API
         */
        setQuestions(state, questions) {
            state.total = questions.length;
            state.currentQuestion = {
                id: questions[0].id,
                type: questions[0].type,
                text: questions[0].text,
                counter: 1
            };
            questions.shift();
            state.questions = questions;
        },
        /**
         * Saves either an option text or a string entered by user as an answer
         * @param state
         * @param questionId {number}
         * @param answer {string}
         */
        saveAnswer(state, {questionId, answer}) {
            Vue.set(state.answers, questionId, answer);
        },
        /**
         * Exits the quiz, used when the last question is answered
         * @param state
         */
        finish(state) {
            state.currentQuestion = {id: null, type: null, text: "", counter: null};
            state.finished = true;
        },
        /**
         * Gets next questions
         * @param state
         */
        nextQuestion(state) {
            if (state.questions.length === 0) {
                return;
            }
            state.currentQuestion.id = state.questions[0].id;
            state.currentQuestion.type = state.questions[0].type;
            state.currentQuestion.text = state.questions[0].text;
            state.currentQuestion.counter++;
            state.questions.shift();
        },
        /**
         * Completely resets the state
         * @param state
         */
        reset(state) {
            state.quizId = null;
            state.running = false;
            state.questions = [];
            state.total = null;
            state.currentQuestion = {id: null, type: null, text: "", counter: null};
            state.answers = {};
        }
    }
});

export default store;
