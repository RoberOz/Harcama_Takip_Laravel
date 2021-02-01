
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('expense-create', require('./components/ExpenseCreateFormComponent.vue'));
Vue.component('most-expense', require('./components/MostExpenseComponent.vue'));
Vue.component('recent-expense', require('./components/RecentExpenseComponent.vue'));
Vue.component('least-expense', require('./components/LeastExpenseComponent.vue'));
Vue.component('expense-list-yearly', require('./components/ExpenseListYearlyComponent.vue'));
Vue.component('expense-location-counts', require('./components/ExpenseLocationCountsComponent.vue'));
Vue.component('current-month-expenses', require('./components/CurrentMonthExpensesComponent.vue'));
Vue.component('categories-group-by-location', require('./components/CategoriesGroupByLocationComponent.vue'));
Vue.component('expense-pages', require('./components/ExpensePagesComponent.vue'));


const app = new Vue({
    el: '#app',
});
