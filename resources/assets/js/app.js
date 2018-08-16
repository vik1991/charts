
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vue = new Charts()

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

export default class Charts {
     processData() {
        $.ajax({
            url: "/chartData",
            dataType: 'json',
            context: document.body
        }).done(function (data) {

            let chartData = JSON.parse(data);
            let dates = Object.keys(chartData)

            $.each(chartData, function (index, value) {
                let myChart = new Highcharts.chart('container', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'User Flow'
                    },
                    xAxis: {
                        categories: dates // unique
                    },
                    yAxis: {
                        categories: index  //the keys of the array are the values of the proccessing steps ex, 20,40,99,100..
                    },
                    series: [{
                        name: index,
                        data: chartData[index]['onboarding_percentage']
                    }]
                })
            })
        })
    }
}
