cb_actor = document.getElementById('actor');
cb_movie = document.getElementById('movie');
actor_form = document.getElementById('actor_form');
movie_form = document.getElementById('movie_form');
actor_label = document.getElementById('actor_label');
movie_label = document.getElementById('movie_label');

actor_label.style.backgroundColor = "rgb(67, 71, 76)";

// pasirenkam aktoriu
actor_label.addEventListener('click', function() {
    console.log('aa');
    cb_actor.checked = true;
    cb_movie.checked = false;
    actor_form.style.display = "block";
    movie_form.style.display = "none";
    actor_label.style.backgroundColor = "#43474c";
    movie_label.style.backgroundColor = "#868e96";
});

// pasirenkam filma
movie_label.addEventListener('click', function() {
    cb_actor.checked = false;
    cb_movie.checked = true;
    movie_form.style.display = "block";
    actor_form.style.display = "none";
    movie_label.style.backgroundColor = "#43474c";
    actor_label.style.backgroundColor = "#868e96";

});
