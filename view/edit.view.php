<style>
    input[type=password], select {
    width: 100% !important;
    padding: 12px 20px !important;
    margin: 8px 0 !important;
    display: inline-block !important;
    border: 1px solid #ccc !important;
    border-radius: 4px !important;
    box-sizing: border-box !important;
}
</style>
<div class="gen-form" style="text-align: center; margin-bottom: 60px">
<form align="center" method="post" action="edit.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <p style="text-align: left">Judul : </p>
    <input type="text" name="url_title" value="<?php echo $title?>" placeholder="Masukkan Judul">
    <p style="text-align: left">Short URL : </p>
    <input type="text" name="url_short" value="<?php echo $slug?>" placeholder="Masukkan Short URL">
    <p style="text-align: left">Original URL : </p>
    <input type="text" name="url_value" value="<?php echo $url?>" placeholder="Masukkan URL">
    <p style="text-align: left">Wallpaper : </p>
    <input type="file" name="wallpaper"><br>
    <input type="submit" name="edit_url">
</form>
</div>