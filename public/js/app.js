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

function statusFilter() {
    const Sbuttons = document.querySelectorAll('.btn-status');
    const comments = document.querySelectorAll('.comment');

    function filter(comment, items) {
        items.forEach((item) => {
            const isItemFiltered = !item.classList.contains(comment);
            const isShowAll = comment.toLowerCase() === "all";

            if(isItemFiltered && !isShowAll) {
                item.classList.add('hide');
            } else {
                item.classList.remove('hide');
            }
        });
    }

    Sbuttons.forEach((Sbutton) => {
        Sbutton.addEventListener('click', () => {
            const currentCategory = Sbutton.dataset.filter;
            console.log(currentCategory);
            filter(currentCategory, comments);
        });
    });
}

tagFilter();
statusFilter();