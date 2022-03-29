<h2>Сортировка</h2>

<label for="file"><b>Файл:</b></label>
<input id="file" type="file" name="document" onchange="submitFile()">

<hr>

<div id="result"></div>

<script>
    function submitFile() {
        event.preventDefault();

        var $input = $("#file");
        var data = new FormData;

        data.append('file', $input.prop('files')[0]);

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