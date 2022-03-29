import * as jquery from "../node_modules/jquery/dist/jquery.js";

function isLoading() {
    $("#root").html(`
        <div class="lds-spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    `);
}

$(".nav-item").on('click', (item) => {
    event.preventDefault();
    var navs = $(".nav-item");

    for (let index = 0; index < navs.length; index++) navs[index].classList.remove('active');
    item.target.classList.add('active');

    isLoading();
    $.ajax(item.target.dataset.url).then((responce) => {
        $("#root").html(responce);
    });
})
