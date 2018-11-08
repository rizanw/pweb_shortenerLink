<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 05/11/2018
 * Time: 18:29
 */?>

<div class="gen-form">
	<h1 style="text-align: center">Simple but Beautiful <br>Link Shortener</h1>
	<form align="center" method="post" action="index.php">
		<input type="text" name="url_value" placeholder="Masukkan URL">
		<input type="submit" name="unregis_url">
	</form>

</div><br>
<div class="gen-form" style="text-align: center; margin-bottom: 60px">
	<h2><a class="alink" href="register">Daftar</a> / <a class="alink" href="login">Masuk</a></h2>
	<h5>untuk fitur yang lebih cantik</h5>
</div>

<?php
//Get Success confirmation
if(isset($_COOKIE['alert'])){
    echo "<div align='center' class=\"alert success\">
  <span class=\"closebtn\">&times;</span>";
    echo "<strong>Berhasil!</strong> short link anda <a class='success-link' href='http://pweb.test/r?c=". $_COOKIE['alert'] ."'> http://pweb.test/r?c=" . $_COOKIE['alert'] . "</a> <p>Daftar untuk mempecantik link!</p>";
    echo "</div>";
}elseif(!isset($_COOKIE['alert']) && isset($_COOKIE['afail'])){
    echo "<div align='center' class=\"alert failed\">
    <span class=\"closebtn\">&times;</span>";
    echo "<strong>Gagal!</strong> Tidak ada URL!";
    echo "</div>";
}
?>
