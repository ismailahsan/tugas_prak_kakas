<?php
ob_start();
?>

<link href="style.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
  $("#uploadForm").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
          url: "upload.php",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
          cache: false,
      processData:false,
      success: function(data)
        {
      $("#targetPhoto").html(data);
        },
        error: function() 
        {
        }           
     });
  }));
});
</script>

<form name="form1" method="post" action="?cat=administrator&page=user&act=1" id="daftar">
  <label>Username</label>

      <input type="text" name="username" id="username">
      <label>Password</label>
      <input type="text" name="password" id="password">
      <label>Jenis Login</label>
     <select name="jenis" id="jenis">
        <option value="gudang">Bagian Gudang</option>
        <option value="pimpinan">Pimpinan</option>
      </select>
      <div class="container">
  <form id="uploadForm" action="upload.php" method="post">
    <div id="targetPhoto">No Image</div>
    <div id="uploadFormContent">
      <label>Upload Foto Anda:</label><br/>
      <input name="userImage" type="file" class="inputFile" />
      <input type="submit" value="Submit" class="btnSubmit" />
    </div>
  </form>
</div>
      <p></p>
      <input type="submit" class="btn btn-primary" name="button" id="button" value="Daftar">&nbsp;&nbsp;<input type="reset" class="btn btn-danger" name="reset" id="reset" value="Reset">
</form>
<?php
ob_end_flush();
?>
<p></p>
<p></p>
<span class="span4">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Username</td>
    <td>Jenis Login</td>   
    <td>&nbsp;</td>
  </tr>
  <?php
  $rw=mysql_query("Select * from user_login");
  while($s=mysql_fetch_array($rw))
  {
  ?>
  <tr>
    <td><?php echo $s['username']; ?></td>
    <td><?php echo $s['login_hash']; ?></td>

    <td><a href="?cat=administrator&page=useredit&id=<?php echo sha1($s['username']); ?>">Edit</a> - <a href="?cat=administrator&page=user&del=1&id=<?php echo sha1($s['username']); ?>">Hapus</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</span>
<?php
if(isset($_GET['act']))
{
	
	$rs=mysql_query("Insert into user_login (`username`,`password`,`login_hash`) values ('".$_POST['username']."','".md5($_POST['password'])."','".$_POST['jenis']."')") or die(mysql_error());
	if($rs)
	{
		echo "<script>window.location='?cat=administrator&page=user'</script>";
	}
}
?>

<?php
if(isset($_GET['del']))
{
	$ids=$_GET['id'];
	$ff=mysql_query("Delete from user_login Where sha1(username)='".$ids."'");
	if($ff)
	{
		echo "<script>window.location='?cat=administrator&page=user'</script>";
	}
}
?>

<script type="text/javascript" src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        console.log('ok');
        $("#daftar").on("submit", function  {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "daftar",
                type: "post",
                contentType: false,
                processData: false,
                data: formData,
//                data: $('#daftar').serialize(),
                beforeSend: function(){
                    swal({ title:"Mohon Tunggu", text:"Proses sedang berlangsung", showConfirmButton: false});
                },
                success: function (d) {
                    swal({ title:"Berhasil!", text:"Berhasil di simpan", type:"success"},
                            function(isConfirm){
                                if (isConfirm) {
                                      document.location.href = '/bahanbaku/pages/administrator/user'
                                } else {

                                }
                            });
                },
                error: function(d){
                    sweetAlert("Mohon Maaf...", "Terjadi kesalahan pada sistem!", "error");
                }
            });
        });
    });
</script>