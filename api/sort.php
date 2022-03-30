<h2>Сортировка</h2>

<label for="file"><b>Файл:</b></label>
<input id="file" type="file" name="document" onchange="submitFile()">

<label for="sorting"><b>Сортировать по:</b></label>
<select id="sorting" onchange="submitFile()">
    <option value="mark">Модель</option>
    <option value="art">Артикул</option>
    <option value="qty">Количество</option>
</select>

<hr>

<div id="result"></div>

<script>
    function submitFile() {
        event.preventDefault();

        var $input = $("#file");
        var data = new FormData;

        data.append('file', $input.prop('files')[0]);
        data.append('sort', $("#sorting").val());

        isLoading();
        $.ajax({
            type: "POST",
            url: "api/sort-result.php",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                $("#result").html(response);
            },
        });
    }

    function isLoading() {
        $("#result").html(`
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
</script>