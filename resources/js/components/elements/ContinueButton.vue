<template>
    <button class="button" :disabled="(disabled === true)">{{text}}</button>
</template>

<script>
    export default {
        name: "ContinueButton",
        props: {
            /**
             * Text in the button
             */
            text: String,
            /**
             * If button is disabled
             */
            disabled: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped>
    .button {
        margin-top: 20px;
        border: 0;
        border-radius: 25px;
        padding: 5px 30px;
        color: white;
        background-color: #307c90;
        transition: .5s background-color;
    }
    .button:hover {
        background-color: #29889e;
    }
    .button:focus {
        border: 0;
        outline: none;
    }
    .button:disabled {
        background-color: #85b1b7;
        cursor: not-allowed;
    }
</style>
