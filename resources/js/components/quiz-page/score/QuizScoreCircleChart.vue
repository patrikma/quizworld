<template>
    <div class="success-chart">
        <svg viewBox="0 0 36 36" class="chart-inner">
            <path class="circle-background"
                  d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path v-if="this.percentage" class="circle-success" id="circleSuccess"
                  :stroke-dasharray="getChartPerimeter()"
                  d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
            />
        </svg>
        <span class="percentage">{{this.round(this.percentage)}} %</span>
    </div>
</template>

<script>
    export default {
        name: "CircleChart",
        props: {
            /**
             * Success rate (successfully answered questions / all questions)
             */
            percentage: Number
        },
        methods: {
            /**
             * Generates data for the svg format to fill the circle
             * @return {string} - formatted number for stroke-dasharray
             */
            getChartPerimeter() {
                return this.percentage + ", 100"
            },
            /**
             * Rounds number to one decimal max.
             * @param number - to be rounded
             * @return {number} - rounded number
             */
            round(number) {
                return Math.round(number * 10) / 10;
            }
        }
    }
</script>

<style scoped>
    .success-chart {
        width: 120px;
        fill: none;
        position: relative;
    }
    .percentage {
        position: absolute;
        display: block;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.2rem;
        font-weight: 700;
    }
    .circle-background {
        stroke: #e8e8e8;
        stroke-width: 2.5;
    }
    .circle-success {
        stroke: #2a9055;
        stroke-width: 2.5;
        animation: load 1s;
    }
    @keyframes load {
        0% {
            stroke-dasharray: 0 100;
        }
    }
</style>
