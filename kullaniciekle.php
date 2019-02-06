<?php 
include ("./header.php"); 
$getusers_action = $class->fnc_curl("get_users","GET")->jsondecode(); 

?>
 <div class="right_col" role="main">
    <div class="page-title">
      <div class="title_left">
        <h3>Kullanıcılar</h3>
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
                    <h2> <small>Kullanıcı Kaydı</small></h2>
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
                    <form method="post" id="kayit" onsubmit="return false;" class="form-horizontal form-label-left input_mask" >

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" required="required" name="isim" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Adınız:">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" required="required" name="soyisim" class="form-control" id="inputSuccess3" placeholder="Soyadınız:">
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" required="required" name="eposta" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="password" required="required" name="sifre" class="form-control" id="inputSuccess5" placeholder="Şifre">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <select required="required" class="form-control" name="yetki">
                          <option value="User">User</option>
                          <option value="Admin">Admin</option>
                          <option value="AuthorizedUser">Authorized User</option>
                        </select>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-0">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
            </div>


             <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Basic Tables <small>basic table subtitle</small></h2>
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
                          <th>ID</th>
                          <th>Ad</th>
                          <th>Soyad</th>
                          <th>Eposta</th>
                          <th>Yetki</th>
                          <th>Statü</th>
                          <th>Güncelle</th>
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
                            <td><?php echo $tablerow['yetki'];  ?></td>
                            <td><?php if ($tablerow['onay']==1){
                              echo '<a class="btn btn2 btn-success" href="action.php?action=statudegis&id='.$tablerow['id'].'">Aktif</a>';
                            }else{
                              echo '<a class="btn btn2 btn-danger" href="action.php?action=statudegis&id='.$tablerow['id'].'">Pasif</a>';
                            }  ?>
                            </td>
                            <td>
                             <?php    
                             echo '<a class="btn btn2 btn-primary" href="kullaniciduzenle.php?id='.$tablerow['id'].'">Update</a>';
                             ?>
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
      $('#kayit').on('submit', function() {
        var frmValue = $(this).serialize();
        $.post('./action.php?action=kayit', frmValue,
        function(data3) {
          var data3 = jQuery.trim(data3);
          alert(data3);
            if(data3=="Error_eposta"){
           
             $('#cevap').html(data3);
            }else if(data3=="Tamam"){
                window.location.href = './kullaniciekle.php';

            }

        });
      });
  
    </script>
<?php include ("./footer.php") ?>