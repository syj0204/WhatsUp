
<!--  현재 Divce 목록 호출 부분 제작중 -->

<?php
	include "DBController.php";
?>
    	<div class="row">
        	<div class="col-xs-4">
				<select name="device_list" id="device_list" class="form-control" size="10" multiple="multiple">
					<?php
						$DBControlObject = new DBController();
						$rows = $DBControlObject->DeviceGroupsView();
						if(count($rows)>0) {
							for($i=0; $i<count($rows)-1; $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
						?>
								<option value=<?php echo $rows[$i][0]?>>
						<?php
								echo $device_name." <br> \n";
							}
						?>
								</option>
						<?php
						}
						?>
				</select>
			</div>
			<!-- /.col-xs-4 -->
		</div>
		<!-- /.row -->