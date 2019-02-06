<?php 
include ("./header.php"); 
$getprojects_action = $class->fnc_curl("get_projects","GET")->jsondecode(); 
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

                       
                        <input type="hidden" required="required" value="<?php echo $_SESSION['kullanici']['id']; ?>" name="kullanici_id" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Proje İsmi">
                        

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proje İsmi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="proje_ismi" class="form-control" required="required" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Proje Amacı</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="proje_amaci" class="form-control"  required="required"/>
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
                          <input type='text' name="olusum_tarihi" class="form-control" id='myDatepicker4' required="required" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Planlanan Başlangıç Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="planlanan_baslangic" class="form-control" id='myDatepicker5' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Başlangıç Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <input type='text' name="baslangic_tarih" class="form-control" id='myDatepicker6' />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bitiş Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <input type='text' name="bitis_tarihi" class="form-control" id='myDatepicker7' />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Güncelleme Tarihi</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type='text' name="guncelle_tarih" class="form-control" id='myDatepicker8' />
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
                    <h2>Tüm Proje Listesi</h2>
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


                    <table class="table">
                      <thead>
                        <tr>
                          
                          <th>Proje İsmi</th>
                          <th>Proje Amacı</th>
                          <th>Oluşturma Tarihi</th>                          
                          <th>İncele</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                        
                        foreach ($getprojects_action['getir'] as $tablerow) 
                        {?>
                          <tr>
                           
                            <td><?php echo $tablerow['proje_ismi'];  ?></td>
                            <td><?php echo $tablerow['proje_amaci'];  ?></td>
                            <td><?php echo $tablerow['olusum_tarihi'];  ?></td>
                            <td>
                              <?php echo '<a class="btn btn2 btn-success" href="projeincele.php?id='.$tablerow['id'].'">İncele</a>'; ?>
                            </td>                            
                        </tr>
                      <?php
                       } 
                       ?>
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