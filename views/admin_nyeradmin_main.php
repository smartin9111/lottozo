
<script type="text/javascript" src="<?php echo SITE_ROOT ?>js/jquery.min.js"></script>
<script>

const SITE_ROOT = "<?=SITE_ROOT?>";

function modify(id) {
    let hid = $('#hid_'+id).val();
    let szam = $('#szam_'+id).val();

    $.ajax({
        url: SITE_ROOT + "service/nyerrest",
        type: 'PUT',
        data: {"id": id, "hid": hid, "szam": szam},
        success: function(data) {
            getAll();
        }
    });
}

function del(id) {
    $.ajax({
        url: SITE_ROOT + "service/nyerrest",
        type: 'DELETE',
        data: {"id": id},
        success: function(data) {
            getAll();
        }
    });    
}

function getAll() {
    $('#nyeremenyek').html('<p>Loading...</p>');
    $.get(
        SITE_ROOT + "service/nyerrest",
        function(data) {
            $('#nyeremenyek').html('');
            let table = $('<table>').appendTo($('#nyeremenyek'));
            $('<tr>').append($('<th>').append('id')).
            append($('<th>').append('huzasid')).
            append($('<th>').append('szam')).appendTo(table);

            $.each(data, function(key, elem) {
                let row = $('<tr>').appendTo(table);
                $('<td>').append($('<input>').attr('id', 'id_'+elem.id).attr('type', 'text').attr('disabled', 'disabled').val(elem.id)).appendTo(row);
                $('<td>').append($('<input>').attr('id', 'hid_'+elem.id).attr('type', 'text').val(elem.huzasid)).appendTo(row);
                $('<td>').append($('<input>').attr('id', 'szam_'+elem.id).attr('type', 'text').val(elem.szam)).appendTo(row);
                
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
    let hid = $('#huzasid').val();
    let szam = $('#szam').val();
    $.post(
        SITE_ROOT + "service/nyerrest",
        {"huzasid": hid, "szam": szam},
        function(data) {
            getAll();
        },
        'json'
    );
}

$(document).ready(function() {
    getAll();
    $('#save').click(save);
});

</script>


<label for="huzasid">Huzás ID</label>
<input type="number" name="huzasid" id="huzasid" />
<label for="szam">Huzott szám</label>
<input type="number" name="szam" id="szam" />
<button id="save">Ment</button>

<div id="nyeremenyek"></div>