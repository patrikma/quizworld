<template>
    <h1 class="heading">{{title}}</h1>
</template>

<script>
    export default {
        name: "Header",
        props: {
            /**
             * Title to display
             */
            title: String
        }
    }
</script>

<style scoped>
    .heading {
        color: #595959;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }
</style>
