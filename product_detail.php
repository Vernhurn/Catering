<?php 
include "header.php";
if ($_SESSION['akses'] == 2 || empty($_SESSION['akses'])) {

    if(isset($_POST['add_to_cart'])){
        $id_menu = $_POST['id_menu'];
        $nama_menu = $_POST['nama_menu'];
        $total_harga = $_POST['total_harga'];
        $gambar = $_POST['gambar'];
        $qty = $_POST['qty'];

        $data = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE nama_menu = '$nama_menu' AND id_user = '$idUser'");
        $cek = mysqli_num_rows($data);

        if($cek > 0){
         $message[] = 'Sudah ditambakan ke keranjang!';
         echo "<script>alert('Sudah ditambakan ke keranjang!')</script>";
     }else{
         $insert_keranjang = mysqli_query($koneksi,"INSERT INTO keranjang VALUES (NULL, '$idUser', '$id_menu', '$nama_menu', '$qty', '$total_harga', '$gambar')");
         $message[] = 'Ditambakan ke keranjang!';
         echo "<script>alert('Ditambakan ke keranjang!')</script>"; 
     }
 }

 $id_menu = $_GET['id_menu'];
 $query = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
 $result = mysqli_query($koneksi, $query);
 $detail = mysqli_fetch_array($result);
 ?>

 <br>
 <br>

 <body>
    <form action="" method="POST">
        <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>">
        <input type="hidden" name="nama_menu" value="<?php echo $detail['nama_menu']; ?>">
        <input type="hidden" name="total_harga" value="<?php echo $detail['harga']; ?>">
        <input type="hidden" name="gambar" value="<?php echo $detail['gambar']; ?>">
        <section class="container sproduct my-5 pt-1">
            <div class="section-title">
              <h2>Detail Menu</h2>
          </div>

          <div class="row mt-1" style="margin-top: 30px;">
            <div class="col-lg-4 col-md-12 col-12 text-center pb-3">
                <img class="img-responsive pt-2" width="250px" src="assets/img/menu/<?php echo $detail['gambar']; ?>" id="maining" alt="">
            </div>
            

            <div class="col-lg-8 col-md-12 col-12">
                <h3><b><?php echo $detail['nama_menu']; ?></b></h3>
                <p style="font-size: 20px;"><?php echo rupiah($detail['harga']); ?></p>
                <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                <?php if(isset($_SESSION['id'])){ ?>
                    <button type="submit" name="add_to_cart" class="btn text-light p-1 m-2" style="background-color: #E8853D;"><span class="bi bi-cart2" style="margin-right: 5px;"></span>Tambahkan</button>
                <?php }else{ ?>
                    <button type="submit" class="btn text-light p-1 m-2" style="background-color: #E8853D;"><a onclick="return confirm('Silahkan Login Terlebih Dahulu!')" href="login.php" style="color: #fff; font-size: 20px"><span class="bi bi-cart2" style="margin-right: 5px;"></span>Tambahkan</a></button>
                <?php } ?>
                <h4 class="mt-5 mb-3" style="text-align: justify; font-size: 20px;">Detail Menu:</h4>
                <p style="text-align: justify; font-size:15px;">
                    <?php 
                    $desk = $detail['detail'];
                    $pecah = explode("\r", $desk); 
                    $text = "";
                    for ($i=0; $i<=count($pecah)-1; $i++){
                       $part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
                       $text .= $part;
                   }
                   echo $text;
                   ?>
               </p>

           </div>    
       </form>    
   </div>
</section>

</body>

<?php
}else{

  echo "<script>alert('Anda adalah Admin!')</script>";
  echo "<script>location='dashboard/'</script>"; 
}
include 'footer.php';
?>