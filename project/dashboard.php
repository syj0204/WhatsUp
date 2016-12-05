<?php 
	include "DBController.php";
?>
  <script src="js/jquery.js"></script>
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript">

		$(function(){

			$('#go_user_setting').click(function(){
				$('#page-wrapper').load("user_setting_view.php");
				return false;
			});
			$('#go_device_list').click(function(){
				$('#page-wrapper').load("Search_device_view.php");
				return false;
			});
			$('#go_personal_setting').click(function(){
				$('#page-wrapper').load("permission_personal_setting_view.php");
				return false;
			});
			$('#go_templates_setting').click(function(){
				$('#page-wrapper').load("test.php");
				return false;
			});
			$('#go_templates_match').click(function(){
				$('#page-wrapper').load("newtest2.php");
				return false;
			});
		});
		

		$(window).load(function(e){
	
		});


	</script>


<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WhatsUp <small></small>
                            <a href="zxcvasdf.txt" download="test.txt">User manual</a>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> WhatsUp SMS Setting
                            </li>

                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div id="go_user_setting" class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
	                                        <?php
	                                        	$DBControlObject = new DBController();
												$result = $DBControlObject->getUserList();
												echo count($result);
											?>
										</div>
                                        <div>
	                                        <?php 
	                                        	$text = "사용자";
	                                        	$text = ICONV("EUC-KR","UTF-8",$text);
	                                        	echo $text;
	                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">
                                    	<?php 
	                                        $text = "사용자 추가/수정/삭제";
	                                        $text = ICONV("EUC-KR","UTF-8",$text);
	                                        echo $text;
	                                   	?>
	                                </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div id="go_device_list" class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        	<?php
	                                        	$DBControlObject = new DBController();
												$result = $DBControlObject->getDeviceList();
												echo count($result);
											?>
                                        </div>
                                        <div>
                                        	<?php 
	                                        	$text = "장비";
	                                        	$text = ICONV("EUC-KR","UTF-8",$text);
	                                        	echo $text;
	                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">
                                    <?php 
	                                	$text = "장비확인";
	                                    $text = ICONV("EUC-KR","UTF-8",$text);
	                                    echo $text;
	                               	?>
                                    </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div id="go_personal_setting" class="col-lg-5 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-middle">
                                        <div class="huge">
                                        <?php 
                                        	$text1 = "개별 사용자 권한 설정";
                                        	$text1 = ICONV("EUC-KR","UTF-8",$text1);
                                        	echo $text1
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<a href="#" id="sin1"> 
                                <div class="panel-footer">
                                    <span class="pull-left">Go~! 'Personal Setting'</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div id="go_templates_setting" class="col-lg-5 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <!-- <i class="fa fa-comments fa-5x"></i> -->
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-middle">
                                        <div class="huge">
                                        <?php 
                                        	$text = "템플릿 추가/수정/삭제";
                                        	$text = ICONV("EUC-KR","UTF-8",$text);
                                        	echo $text;
                                        ?>
                                        </div>
                            		</div>
                                </div>
                            </div>
                            <a href="#"> 
                                <div class="panel-footer">
                                    <span class="pull-left">Go~! 'Templates Setting'</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div id="go_templates_match" class="col-lg-5 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-middle">
                                        <div class="huge">
                                        <?php 
                                        	$text1 = "사용자별 템플릿 적용 ";
                                        	$text1 = ICONV("EUC-KR","UTF-8",$text1);
                                        	echo $text1
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<a href="#"> 
                                <div class="panel-footer">
                                    <span class="pull-left">Go~! 'Templates Match'</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                </div>
                   
                </div>
               
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->