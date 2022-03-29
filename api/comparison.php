<h2>Сравнение</h2>

<label for="file1"><b>Файл (старый):</b></label>
<input id="file1" type="file" name="file1" onchange="submitFile()">

<label for="file2"><b>Файл (новый):</b></label>
<input id="file2" type="file" name="file2" onchange="submitFile()">

<hr>

<div id="result"></div>

<script>
    function submitFile() {
        event.preventDefault();
        var data = new FormData;
        var file1 = $("#file1");
        var file2 = $("#file2");

        if(file1.val() && file2.val()){
            data.append('file1', file1.prop('files')[0]);
            data.append('file2', file2.prop('files')[0]);
    
            isLoading();
            $.ajax({
                type: "POST",
                url: "api/comparison-result.php",
                processData: false,
                contentType: false,
                data: data,
                success: function (response) {
                    $("#result").html(response);
                },
            });
        }
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