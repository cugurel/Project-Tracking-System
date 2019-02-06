<?php 
include ("./header.php"); 
$getusers_action = $class->fnc_curl("get_users","GET")->jsondecode(); // tüm kullanıcıları alır
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $postfields="id=".$id;
  $yetkiliinfo_action = $class->fnc_curl("yetkiligetir","POST",$postfields)->jsondecode();
  $getprojectinfo = $class->fnc_curl("get_project","POST",$postfields)->jsondecode();//düzenleme kısmı için özel id ye göre gelen projeyi alır
  
}else
{
    header('Location:kullaniciekle.php');
}
?>
 <div class="right_col" role="main">
    <div class="page-title">
      <div class="title_left">
        <h3>Projeler</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
       <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> <small>Proje Ekle </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="cevap"></div>
                    <br />
                    <form method="post" id="projeekle" onsubmit="return false;" class="form-horizontal form-label-left input_mask" >

                       
                        <input type="hidden" required="required" value="<?php echo $getprojectinfo['id']; ?>" name="proje_id" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Proje İsmi">
                        

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proje İsmi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="proje_ismi" value="<?php echo $getprojectinfo['proje_ismi']; ?>" class="form-control"  />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proje Amacı</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="proje_amaci"  class="form-control" value="<?php echo $getprojectinfo['proje_amaci']; ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Onay</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <select class="form-control" name="onay">
                             <option value="0">0</option>
                             <option value="1">1</option>
                           </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Yayın Durumu</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <select class="form-control" name="yayinla">
                             <option value="0">0</option>
                             <option value="1">1</option>
                           </select>
                        </div>
                      </div>


                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Oluşturma Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="olusum_tarihi" value="<?php echo $getprojectinfo['olusum_tarihi']; ?>" class="form-control" id='myDatepicker4' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Planlanan Başlangıç Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="planlanan_baslangic" value="<?php echo $getprojectinfo['planlanan_baslangic']; ?>" class="form-control" id='myDatepicker5' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Başlangıç Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <input type='text' name="baslangic_tarih" value="<?php echo $getprojectinfo['baslangic_tarih']; ?>" class="form-control" id='myDatepicker6' />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bitiş Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <input type='text' name="bitis_tarihi" value="<?php echo $getprojectinfo['bitis_tarihi']; ?>" class="form-control" id='myDatepicker7' />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Güncelleme Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="guncelle_tarih" value="<?php echo $getprojectinfo['guncelle_tarih']; ?>" class="form-control" id='myDatepicker8' />
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-0">
                          <button type="submit" class="btn btn-success">Proje Ekle</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
            </div>


             <div class="col-md-6 col-sm-6 col-xs-12">

               <div class="x_panel">
                  <div class="x_title">
                    <h2>Bu Projede Yetkili Kullanıcılar</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        
                        <tr>
                        
                          <th>Adı - Soyadı</th>
                          <th>Yetkisi</th>
                          <th>Eklenme Tarihi</th>
                          <th>Düzenleme</th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php 

                        foreach ($yetkiliinfo_action['yetkili_getir'] as $row) 
                        {?>
                        <tr>
                          <td><?php echo $row['ad'].' '.$row['soyad'];  ?></td>
                          <td><?php echo $row['yetkisi'];  ?></td>
                          <td><?php echo $row['eklenme_tarihi'];  ?></td>
                          <td><?php  echo '<a class="btn btn2 btn-success" href="action.php?action=projeyeekle&id=">Yetki Ver</a>'; ?></td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bu Projeye Yetkili Ekle</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                      <thead>
                        
                        <tr>
                        
                          <th>ID</th>
                          <th>Ad</th>
                          <th>Soyad</th>
                          <th>Eposta</th>
                          <th>Projeye Ekle</th>
                          
                        </tr>
                      </thead>


                      <tbody>
                        <?php 

                        foreach ($getusers_action['gelir'] as $tablerow) 
                        {?>
                        <tr>
                          
                          <td><?php echo $tablerow['id'];  ?></td>
                          <td><?php echo $tablerow['ad'];  ?></td>
                          <td><?php echo $tablerow['soyad'];  ?></td>
                          <td><?php echo $tablerow['eposta'];  ?></td>
                          <td><?php  echo '<a class="btn btn2 btn-success" href="action.php?action=projeyeekle&id='.$tablerow['id'].'&projeid='.$getprojectinfo['id'].'">Projeye Ekle</a>'; ?></td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>

               
              </div>


          </div>
</div>

<script type="text/javascript" src="./vendors/jquery/dist/jquery.js"></script>
    <script type="text/javascript">
      $('#projeekle').on('submit', function() {
        var frmValue = $(this).serialize();
        $.post('./action.php?action=projeekle', frmValue,
        function(data3) {
          var data4 = jQuery.trim(data3);
             if(data4=="Tamam"){
                window.location.href = './projeekle.php';

            }else{
              alert(data4);
            }

        });
      });
  
    </script>
<?php include ("./footer.php") ?>