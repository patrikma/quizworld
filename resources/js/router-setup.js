import VueRouter from "vue-router";
import List from "./components/listing/List";
import Quiz from "./components/quiz-page/Quiz";

const router = new VueRouter({
    mode: 'history',
    routes: [
        /**
         * List of all available quizzes
         */
        {
            path: '/play',
            name: 'list',
            component: List
        },
        /**
         * Page where the quiz is running
         */
        {
            path: '/play/quiz/:id',
            name: 'quizPage',
            component: Quiz
        }
    ]
});

export default router;
