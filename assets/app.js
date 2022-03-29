import * as jquery from "../node_modules/jquery/dist/jquery.js";


$(".nav-item").on('click', (item) => {
    var navs = $(".nav-item");

    for (let index = 0; index < navs.length; index++) navs[index].classList.remove('active');
    item.target.classList.add('active');

    $.ajax(item.target.dataset.url).then((responce) => {
        $("#root").html(responce);
    });
})
