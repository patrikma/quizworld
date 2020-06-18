<template>
    <div class="app-background">
        <!-- Header with a menu -->
        <header class="background-header">
            <nav class="navigation">
                <div class="left menu-area">
                    <a href="/play">Seznam kvízů</a>
                </div>
                <div class="logo">Quiz World</div>
                <div class="right menu-area">
                    <a href="" @click="goToRandomQuiz($event)">Náhodný kvíz</a>
                </div>
            </nav>
        </header>
        <!-- Main content from the router view-->
        <div class="container">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
    import axios from "axios";

    export default {
        name: "App",
        methods: {
            /**
             * Goes to a randomly selected quiz, doesn´t use Vue router
             * @param ev - event
             */
            goToRandomQuiz(ev) {
                ev.preventDefault();
                axios.get('/api/random-quiz')
                    .then(response => {
                        window.location.replace('/play/quiz/' + response.data.id);
                    });
            }
        }
    }
</script>

<style scoped>
    .app-background {
        background-color: #f4f8ff;
        width: 100%;
        height: 100vh;
    }
    .background-header {
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-bottom: 65px;
        padding-top: 15px;
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#18b6b6+0,41d3d1+100 */
        background: #18b6b6; /* Old browsers */
        background: -moz-linear-gradient(top,  #18b6b6 0%, #41d3d1 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  #18b6b6 0%,#41d3d1 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  #18b6b6 0%,#41d3d1 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#18b6b6', endColorstr='#41d3d1',GradientType=0 ); /* IE6-9 */
    }
    @media screen and (min-width: 576px)  {
        .background-header {
            height: 400px;
            padding-bottom: 0;
            padding-top: 0;
        }
    }
    .navigation {
        width: 100%;
        max-width: 1100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
    }
    @media screen and (min-width: 576px)  {
        .navigation {
            flex-direction: row;
        }
    }
    .navigation a {
        color: white;
        text-transform: uppercase;
    }
    .navigation .menu-area {
        display: flex;
        align-items: center;
        font-size: 1rem;
        letter-spacing: 4px;
        text-transform: capitalize;
    }
    .navigation .logo {
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 0 2px 6px rgba(150, 150, 150, 1);
        color: white;
        margin-bottom: 15px;
    }
    .navigation .left {
        order: 2;
        margin-bottom: 15px;
    }
    .navigation .right {
        order: 3;
    }
    @media screen and (min-width: 576px)  {
        .navigation .left {
            order: initial;
            margin-bottom: 0;
        }
        .navigation .logo {
            margin-bottom: 0;
        }
        .navigation .right {
            order: initial;
        }
    }
    .container {
        margin-top: -50px;
    }
</style>
