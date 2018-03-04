
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

    $(".search").focusout(function() {
        setTimeout(
            function()
            {
                $('#suggestion').hide();
            }, 500);
    });

    $(".search").keyup(function() {
        if ($(".search").val().length > 1) {
            $(".search").focusin(function() {
                $('#suggestion').show();
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: $("#route").val(),
                data: { search: $(".search").val()},
                success: function (results) {
                    $("#suggestion").html("");
                    $("#suggestion").show();
                    $.each(results, function (i, result) {
                        $.each(result, function (j, data) {
                            $("#suggestion").append('<a href="'+data.url+'"><li><img id="suggestion-img" src="'+data.image+'"/>'+ data.name +'</li></a>');
                            console.log(data);
                        })
                    })
                }
            })
        } else {
            $("#suggestion").hide();
        }
    });
});





