/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.$ = window.jQuery = require('jquery');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

window.toggleNav = function () {
    let main = document.getElementById("content-p");
    if (main.style.marginLeft == "250px") {
        main.style.marginLeft = "0px";
    } else {
        main.style.marginLeft = "250px";
    }
};

$('#confirm-delete-modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let id = button.data('id'); // Extract info from data-* attributes
    let name = button.data('name'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    let modal = $(this);
    $('#modal-text-delete').html('Are you sure you want to delete ' + name + '\'s reservation ?');
    modal.find('.input-id').val(id);
});


$('#confirm-cancel-modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget); // Button that triggered the modal
    let id = button.data('id'); // Extract info from data-* attributes
    let name = button.data('name'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    let modal = $(this);
    $('#modal-text-cancel').html('Are you sure you want to cancel ' + name + '\'s reservation ?');
    modal.find('.input-id').val(id);
});

window.addPersonalizedField = function($html) {
    $('#form-outter-div').append(decodeURI($html));

    let formGroup = $('.dynamic-field-group').last();

    let divs = formGroup.children('div');

    let rnd = Math.random().toString(36).substring(7);

    let hidden = formGroup.children('.field')[0];
    hidden.setAttribute('name', hidden.getAttribute('name') + '_' + rnd);

    $.each(divs, function() {

        let label = $(this).children('.dynamic-field-label')[0];
        let input = $(this).children('.dynamic-field')[0];

        label.setAttribute('for', label.getAttribute('for') + '-' + rnd);
        input.setAttribute('id', input.getAttribute('id') + '-' + rnd);
        input.setAttribute('name', rnd + '-' + input.getAttribute('name'));


    });
};