<?php include '../welcome/header.php';?>
<center>
<div class="schedule">
	<table class="table">
		<tr class="text-center">
				<td></td>
				<td bgcolor="#CDCFD6"><strong>MONDAY</strong></td>
				<td ><strong>TUESDAY</strong></td>
				<td bgcolor="#CDCFD6"><strong>WEDNESDAY</strong></td>
				<td><strong>THURSDAY</strong></td>
				<td bgcolor="#CDCFD6"><strong>FRIDAY</strong></td>
				<td><strong>SATURDAY</strong></td>
		</tr>
		<?php for($iRow = 0; $iRow<14; $iRow++){?>
			<tr>
				<td>
				<?php switch($iRow){
						case 0: echo "7:00am<br>8:00am";
							break;
						case 1: echo "8:00am<br>9:00am";
							break;
						case 2: echo "9:00am<br>10:00am";
							break;
						case 3: echo "10:00am<br>11:00am";
							break;
						case 4: echo "11:00am<br>12:00nn";
							break;
						case 5: echo "12:00nn<br>1:00pm";
							break;
						case 6: echo "1:00pm<br>2:00pm";
							break;
						case 7: echo "2:00pm<br>3:00pm";
							break;
						case 8: echo "3:00pm<br>4:00pm";
							break;
						case 9: echo "4:00pm<br>5:00pm";
							break;
						case 10: echo "5:00pm<br>6:00pm";
							break;
						case 11: echo "6:00pm<br>7:00pm";
							break;
						case 12: echo "7:00pm<br>8:00pm";
							break;
						case 13: echo "8:00pm<br>9:00pm";
							break;
					}
				?>
				</td>

				<?php for($iCol = 0; $iCol<6; $iCol++){
					if($iCol%2!=1){?>
						<td bgcolor="#EDF0F7">
					<?php }else{?>
						<td>
					<?php }?>
						<div>
							<div class="form-inline">
								<select class="form-control input-sm cell" style="height: 25px; width: 100px;" name="course">

								</select>
								<select class="form-control input-sm cell" style="height: 25px; width: 80px;" name="room">
									
								</select><br>
								<select class="form-control input-sm cell" style="height: 25px; width: 184px;" name="professor">

								</select>
							</div>
								
						</div>
					</td>
				<?php }?>
			</tr>
		<?php }?>
	</table>
</div>
</center>
<?php include '../welcome/footer.php';?>