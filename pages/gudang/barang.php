<?php
ob_start();
?>
<form name="form1" method="post" action="?cat=gudang&page=barang&act=1">
 
      <label>Nama Barang</label>
      <input type="text" name="namabarang" id="namabarang">
      <label>Jenis Barang</label>
     <select name="jenis" id="jenis" >
        <option value="jenis1">Jenis 1</option>
        <option value="jenis2">Jenis 2</option>
        <option value="jenis3">Jenis 3</option>
      </select>
   
      <p></p>
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Daftar">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset">
</form>
<?php
ob_end_flush();
?>
<p></p>
<p></p>
<span class="span4">
<?php
include("pages/gudang/barangview.php");
?>
</span>
<?php
if(isset($_GET['act']))
{
	
	$rs=mysql_query("Insert into data_barang (`nama_barang`,`jenis_barang`) values ('".$_POST['namabarang']."','".$_POST['jenis']."')") or die(mysql_error());
	if($rs)
	{
		
		echo "<script>window.location='?cat=gudang&page=barang'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from data_barang Where sha1(kode_barang)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=gudang&page=barang'</script>";
	}
}
?>
