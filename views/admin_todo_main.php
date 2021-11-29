
<script type="text/javascript" src="<?php echo SITE_ROOT ?>js/jquery.min.js"></script>
<script>

function modify(id) {
    let uid = $('#uid_'+id).val();
    let title = $('#title_'+id).val();
    let completed = $('#comp_'+id).val();

    $.ajax({
        url: "https://jsonplaceholder.typicode.com/todos/" + id,
        type: 'PUT',
        data: {"id": id, "userId": uid, "title": title, "completed": completed},
        success: function(data) {
            let resp = "Sikeres módosítás!\n";
            resp += "Új adatok:\n";
            resp += "ID: " + data.id + "\n";
            resp += "User ID: " + data.userId + "\n";
            resp += "Title: " + data.title + "\n";
            resp += "Completed: " + data.completed + "\n";
            alert(resp);
            getAll();
        }
    });
}

function del(id) {
    $.ajax({
        url: "https://jsonplaceholder.typicode.com/todos/" + id,
        type: 'DELETE',
        success: function(data) {
            alert("Sikeres törlés!");
            getAll();
        }
    });    
}

function getAll() {
    $('#tennivalok').html('<p>Loading...</p>');
    $.get(
        "https://jsonplaceholder.typicode.com/todos",
        function(data) {
            $('#tennivalok').html('');
            let table = $('<table>').appendTo($('#tennivalok'));
            $('<tr>').append($('<th>').attr('class', 'idcol').append('Id')).
            append($('<th>').attr('class', 'uidcol').append('User Id')).
            append($('<th>').attr('class', 'titlecol').append('Title')).
            append($('<th>').attr('class', 'compcol').append('Completed')).appendTo(table);

            $.each(data, function(key, elem) {
                let row = $('<tr>').appendTo(table);
                $('<td>').attr('class', 'idcol').append($('<input>').attr('id', 'id_'+elem.id).attr('type', 'text').attr('disabled', 'disabled').val(elem.id)).appendTo(row);
                $('<td>').attr('class', 'uidcol').append($('<input>').attr('id', 'uid_'+elem.id).attr('type', 'text').val(elem.userId)).appendTo(row);
                $('<td>').attr('class', 'titlecol').append($('<input>').attr('id', 'title_'+elem.id).attr('type', 'text').val(elem.title)).appendTo(row);
                $('<td>').attr('class', 'compcol').append($('<input>').attr('id', 'comp_'+elem.id).attr('type', 'text').val(elem.completed)).appendTo(row);
                
                let btn_mod = $('<button>').append('Mod').click(() => modify(elem.id));
                $('<td>').append(btn_mod).appendTo(row);
                let btn_del = $('<button>').append('Del').click(() => del(elem.id));
                $('<td>').append(btn_del).appendTo(row);                
            })
        },
        "json"                                                    
    );    
}

function save() {
    let uid = $('#userid').val();
    let ttl = $('#title').val();
    
    $.post(
        "https://jsonplaceholder.typicode.com/todos",
        {"userid": uid, "title": ttl, "completed": "false"},
        function(data) {
            getAll();
            let text = "Sikeres felvétel!\nA felvett elem adatai:\n";
            text += "ID:" + data.id + "\n";
            text += "User ID:" + data.userid + "\n";
            text += "Title:" + data.title + "\n";
            text += "Completed:" + data.completed + "\n";
            alert(text);
            
        },
        'json'
    );
}

$(document).ready(function() {
    getAll();
    $('#save').click(save);
});

</script>
<style type="text/css">
    .uidcol, .idcol {
        width: 10%;
    }
    .compcol {
        width: 5%;
    }
    .titlecol {
        width: 85%;
    }
    td input {
        width: 100%;
    }
</style>


<label for="userid">User ID</label>
<input type="number" name="userid" id="userid" />
<label for="title">Title</label>
<input type="text" name="title" id="title" />
<button id="save">Ment</button>

<div id="tennivalok"></div>