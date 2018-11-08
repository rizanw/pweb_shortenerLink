<div style="margin: auto 3%">
    <p style="margin: 5px 0px;">Selamat Datang, <?php echo $_SESSION['name_user']; ?></p>
    <button class="button" id="create-link">Buat</button>
    <div id="link-table"></div>
    <div class="note-d">
        <label>Catatan : </label>
        <p>-&#128221; : tombol edit link</p>
        <p>-&#10060; : tombol hapus link</p>
        <p>-&#128190; : tombol backup/download wallpaper</p>
    </div>
</div>
<div id="modal-clink" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <form method="post" action="../home.php">
            <p>Masukkan URL :</p>
            <input type="text" name="url_value" placeholder="Masukkan URL">
            <input type="submit" name="regis_link">
        </form>
    </div>
</div>

<script>
    var modal = document.getElementById('modal-clink');
    var btn = document.getElementById("create-link");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
        modal.style.display = "block";
    };

    span.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    var editIcon = function(cell, formatterParams){
        return "&#128221;";
    };

    var deleteIcon = function(cell, formatterParams){
        return "&#10060;";
    };

    var downloadIcon = function(cell, formatterParams){
        return "&#128190;";
    };

    var shortLink = function (cell, formatterParams) {
      return "<?php echo $_SERVER['HTTP_HOST']?>/r?c=" + cell.getValue();
    };

    var table = new Tabulator("#link-table", {
        layout:"fitDataFill",
        placeholder:"Tidak ada Link",
        columns:[
            {title:"No", formatter:"rownum", align:"center"},
            {title:"nama", field:"name"},
            {formatter:shortLink, title:"shorten link", field:"slug", cellClick:function(e, cell){
                window.open("r?c=" + cell.getRow().getData().slug)
            }},
            {title:"original link", field:"url"},
            {title:"dibuat pada", field:"createdat"},
            {field:"id", visible: false},
            {formatter:editIcon, align:"center", cellClick:function(e, cell){
                    window.location.replace("edit?id=" + cell.getRow().getData().slug)
            }},
            {formatter:downloadIcon, align:"center", cellClick:function(e, cell){
                    window.location.replace("download?dw=" + cell.getRow().getData().slug)
                }},
            {formatter:deleteIcon, align:"center", cellClick:function(e, cell){
                    window.location.replace("?deleteid=" + cell.getRow().getData().id)
            }}
        ],
    });
    table.setData('progressiveData.php');
</script>