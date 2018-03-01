
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
let $ = require('jquery');
require('select2');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$(document).ready(()=> {
    $('.movies-select').select2();
    $('.actors-select').select2();

    $(".search").keyup(function() {
        if ($(".search").val().length > 1) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: $("#route").val(),
                data: { search: $(".search").val()},
                success: function (results) {
                    $("#suggestion").html("");
                    $.each(results, function (i, result) {
                        $.each(result, function (j, data) {
                            $("#suggestion").append('<li><a href="/actors/'+data.id+'">'+data.name+'</a></li>');
                            console.log(data);
                        })
                    })
                }
            })
        }
    });
});





