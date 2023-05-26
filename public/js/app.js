/**
 * Filter post tags
 */
function tagFilter() {
    const buttons = document.querySelectorAll('.btn-tags');
    const posts = document.querySelectorAll('.card-post');

    function filter(tag, items) {
        items.forEach((item) => {
            const isItemFiltered = !item.classList.contains(tag);
            const isShowAll = tag.toLowerCase() === "all";

            if(isItemFiltered && !isShowAll) {
                item.classList.add('hide');
            } else {
                item.classList.remove('hide');
            }
        });
    }

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const currentCategory = button.dataset.filter;
            console.log(currentCategory);
            filter(currentCategory, posts);
        });
    });
}

tagFilter();

/**
 * Auth Flip Card
 */
window.requestAnimFrame = (function(){
    return  window.requestAnimationFrame       ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            function( callback ){
              window.setTimeout(callback, 1000 / 60);
            };
  })();

  var goButton = document.querySelectorAll(".livedemo");
  var container = document.getElementById("auth");
  var animating = false;

  goButton.forEach((button) => {
    button.addEventListener('click', function() {

        if (animating)
        return;

        container.classList.add('active');
        animating = true;

        setTimeout(function() {
        requestAnimFrame(function() {
            animating = false;
            container.classList.remove('active');
            container.classList.toggle('reverse');
        });
        }, 680);
    });
  });
// goButton.addEventListener('click', function() {

//     if (animating)
//     return;

//     container.classList.add('active');
//     animating = true;

//     setTimeout(function() {
//     requestAnimFrame(function() {
//         animating = false;
//         container.classList.remove('active');
//         container.classList.toggle('reverse');
//     });
//     }, 680);
// });