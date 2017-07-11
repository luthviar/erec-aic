		<!-- Modal -->
		<div class="modal fade" id="modal-edit" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-warning"></i> Edit Confirmation</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to change this data ?</p>
					</div>
					<div class="modal-footer">
						<a id="edit-no" class="btn btn-danger" data-dismiss="modal">No</a>
						<a id="edit-yes" class="btn btn-success">Yes</a>
					</div>
				</div>  
			</div>
		</div>
		
		<div class="modal fade" id="modal-delete" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-warning"></i> Delete Confirmation</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this data ?</p>
					</div>
					<div class="modal-footer">
						<a id="delete-no" class="btn btn-danger" data-dismiss="modal">No</a>
						<a id="delete-yes" class="btn btn-success">Yes</a>
					</div>
				</div>  
			</div>
		</div>
		
		<div class="modal fade" id="modal-message" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-warning"></i> Notification</h4>
					</div>
					<div class="modal-body">
						<p id="message"></p>
					</div>
					<div class="modal-footer">
						<a id="message-no" class="btn btn-default" data-dismiss="modal">Close</a>
					</div>
				</div>  
			</div>
		</div>
		
		<div class="modal fade" id="modal-add-position" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>man-power/insert-detail-data">
					<input type="hidden" id="manpower" name="manpower" value="" />
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Position</h4>
						</div>
						<div class="modal-body">
							<div class="box-body table-responsive">
								<div class="box-body">
									<div class="form-group">
										<label class="col-sm-3 control-label">Position <span class="merah">*</span></label>
										<div class="col-sm-8">
											<select class="form-control select2" name="position" required style="width: 98%;">
												<option value="" disabled selected>Select Position</option>
												<?php $position = $this->m_global->get_by_id('tm_position', 'position_status', 1); ?>
												<?php foreach($position as $rw) : ?>
												<option value="<?php echo $rw->position_id; ?>"><?php echo strip_tags($rw->position_name); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">MPP</label>
										<div class="col-sm-3">
											<input type="number" class="form-control" value="" name="mpp" autocomplete="off" min="0" max="100" style="text-align: right;padding-right: 2px;" />
											<p class="help-block">max = 100</p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Actual</label>
										<div class="col-sm-3">
											<input type="number" class="form-control" value="" name="actual" autocomplete="off" min="0" max="100" style="text-align: right;padding-right: 2px;" />
											<p class="help-block">max = 100</p>
										</div>
									</div>
								</div><!-- /.box-body -->	
							</div><!-- /.box-body -->
						</div>
						<div class="modal-footer">
							<input type="reset" name="reset" value="Clear" class="btn" />
							<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
						</div>
					</div> 
				</form>	
			</div>
		</div>
		
		<div class="modal fade" id="modal-add-mpp" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>man-power/insert-detail-data">
					<input type="hidden" id="manpower_mpp" name="manpower" value="" />
					<input type="hidden" name="actual" value="0" />
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Position MPP</h4>
						</div>
						<div class="modal-body">
							<div class="box-body table-responsive">
								<div class="box-body">
									<div class="form-group">
										<label class="col-sm-3 control-label">Position <span class="merah">*</span></label>
										<div class="col-sm-8">
											<select class="form-control select2" name="position" required style="width: 98%;">
												<option value="" disabled selected>Select Position</option>
												<?php $position = $this->m_global->get_by_id('tm_position', 'position_status', 1); ?>
												<?php foreach($position as $rw) : ?>
												<option value="<?php echo $rw->position_id; ?>"><?php echo strip_tags($rw->position_name); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">MPP</label>
										<div class="col-sm-3">
											<input type="number" class="form-control" value="" name="mpp" autocomplete="off" min="0" max="100" style="text-align: right;padding-right: 2px;" />
											<p class="help-block">max = 100</p>
										</div>
									</div>
								</div><!-- /.box-body -->	
							</div><!-- /.box-body -->
						</div>
						<div class="modal-footer">
							<input type="reset" name="reset" value="Clear" class="btn" />
							<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
						</div>
					</div> 
				</form>	
			</div>
		</div>
		
		<div class="modal fade" id="modal-edit-mpp" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>man-power/update-actual-data">
					<input type="hidden" id="manpower_detail" name="manpower" value="" />
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-plus-circle"></i> Edit Actual MPP</h4>
						</div>
						<div class="modal-body">
							<div class="box-body table-responsive" id="manpower_actual">
								<!-- Loading (remove the following to stop the loading)-->
								<center>
									<div class="overlay">
										<i class="fa fa-refresh fa-spin"></i>
									</div>
								</center>
								<!-- end loading -->
							</div><!-- /.box-body -->
						</div>
						<div class="modal-footer">
							<input type="reset" name="reset" value="Clear" class="btn" />
							<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
						</div>
					</div> 
				</form>	
			</div>
		</div>
		
		<div class="modal fade" id="modal-process" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-warning"></i> Process Confirmation</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to process this data ?</p>
					</div>
					<div class="modal-footer">
						<a id="process-no" class="btn btn-danger" data-dismiss="modal">No</a>
						<a id="process-yes" class="btn btn-success">Yes</a>
					</div>
				</div>  
			</div>
		</div>
		
		<div class="modal fade" id="modal-edit-position" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>man-power/update-detail-data">
					<input type="hidden" id="manpower_detail" name="detail" value="" />
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-plus-circle"></i> Edit Position</h4>
						</div>
						<div class="modal-body">
							<div id="detail_manpower"></div>
						</div>
						<div class="modal-footer">
							<input type="reset" name="reset" value="Clear" class="btn" />
							<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
						</div>
					</div> 
				</form>	
			</div>
		</div>
		
		<div class="modal fade" id="modal-edit-leave" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>leave/update-detail-data">
					<input type="hidden" id="leave_detail" name="detail" value="" />
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-user-md"></i> Edit Employee</h4>
						</div>
						<div class="modal-body">
							<div id="detail_leave"></div>
						</div>
						<div class="modal-footer">
							<input type="reset" name="reset" value="Clear" class="btn" />
							<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
						</div>
					</div> 
				</form>	
			</div>
		</div>
		
		<div class="modal fade" id="modal-edit-recruit" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>recruit/update-detail-data">
					<input type="hidden" id="recruit_detail" name="detail" value="" />
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-user-md"></i> Edit Employee</h4>
						</div>
						<div class="modal-body">
							<div id="detail_recruit"></div>
						</div>
						<div class="modal-footer">
							<input type="reset" name="reset" value="Clear" class="btn" />
							<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
						</div>
					</div> 
				</form>	
			</div>
		</div>
		
		<div class="modal fade" id="modal-edit-apply" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>apply/update-detail-data">
					<input type="hidden" id="apply_detail" name="detail" value="" />
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-user-md"></i> Edit Employee</h4>
						</div>
						<div class="modal-body">
							<div id="detail_apply"></div>
						</div>
						<div class="modal-footer">
							<input type="reset" name="reset" value="Clear" class="btn" />
							<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
						</div>
					</div> 
				</form>	
			</div>
		</div>
		
		<!-- jQuery 2.1.4 -->
		<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<!-- DataTables -->
		<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
		 <!-- Bootstrap WYSIHTML5 -->
		<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Select2 -->
		<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
		<!-- InputMask -->
		<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<!-- date-range-picker -->
		<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
		<!-- bootstrap time picker -->
		<script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<!-- SlimScroll -->
		<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
		
		<!-- Fancybox -->
		<script src="<?php echo base_url(); ?>assets/plugins/fancybox/fancybox.js"></script>
		
		<!-- ImLTE App -->
		<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
		<!-- ImLTE for demo purposes -->
		<script src="<?php echo base_url(); ?>assets/js/demo.js"></script>

		<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />
  
		<script>
			$(document).ready(function() {
				// notification badge
				setInterval(function(){ 
					// ajax
					<?php if(($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 5)) { ?>
					badge_leave();
					count_leave();
					
					<?php if($this->session->userdata('authority_id') == 3) { ?>
					badge_request();
					count_request();
					<?php } ?>
					<?php } ?>
					
					<?php if($this->session->userdata('authority_id') == 5) { ?>
					badge_checking();
					count_checking();
					<?php } ?> 
					
					<?php if($this->session->userdata('authority_id') == 6) { ?>
					badge_recruit();
					count_recruit();
					<?php } ?> 
					
					<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { ?>
					badge_manpower();
					count_manpower();
					
					badge_apply();
					count_apply();
					<?php } ?>
				}, 5000);
				
				$('[data-popup="lightbox"]').fancybox({
					padding: 3,
					openEffect : 'elastic',
					openSpeed  : 150,
					closeEffect : 'elastic',
					closeSpeed  : 150,
					closeClick : true
					
				});

				$('#datetimepicker1').datetimepicker({
					format: 'DD-MM-YYYY HH:mm'
				});
				$('#datetimepicker2').datetimepicker({
					format: 'DD-MM-YYYY HH:mm'
				});
				$('#datetimepicker3').datetimepicker({
					format: 'DD-MM-YYYY HH:mm'
				});
			});

			$(function () {
				$('#example0').DataTable( {
					"order": [[ 0, "desc" ]]
				} );
				$('#example01').DataTable( {
					"order": [[ 0, "desc" ], [ 1, "desc" ]]
				} );
				
				$("#example1").DataTable();
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"order": [[ 0, "desc" ], [ 2, "asc" ]],
					"info": true,
					"autoWidth": false
				});
				
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
				
				$(".textarea").wysihtml5({
				  toolbar: {
					"font-styles": true, // Font styling, e.g. h1, h2, etc.
					"emphasis": true, // Italics, bold, etc.
					"lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
					"html": true, // Button which allows you to edit the generated HTML.
					"link": true, // Button to insert a link.
					"image": false, // Button to insert an image.
					"color": false, // Button to change color of font
					"blockquote": false
				  }
				});
				
				$(".textarea-disabled").wysihtml5({
				  toolbar: {
					"font-styles": false, // Font styling, e.g. h1, h2, etc.
					"emphasis": false, // Italics, bold, etc.
					"lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
					"html": false, // Button which allows you to edit the generated HTML.
					"link": false, // Button to insert a link.
					"image": false, // Button to insert an image.
					"color": false, // Button to change color of font
					"blockquote": false
				  }
				});
				
				//Timepicker
				$(".timepicker").timepicker({
					showInputs: false
				});
				
				//Initialize Select2 Elements
				$(".select2").select2();

				//Datemask dd/mm/yyyy
				$("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
				$(".datemask-2").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
				
				
				//Datemask2 mm/dd/yyyy
				$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
				//Money Euro
				$("[data-mask]").inputmask();

				//Date range picker
				$('#reservation').daterangepicker({format: 'DD-MM-YYYY'});
				//Date range picker with time picker
				$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
				//Date range as a button
				$('#daterange-btn').daterangepicker(
					{
					  ranges: {
						'Today': [moment(), moment()],
						'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days': [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month': [moment().startOf('month'), moment().endOf('month')],
						'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					  },
						startDate: moment().subtract(29, 'days'),
						endDate: moment()
					},
					function (start, end) {
						$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
					}
				);
				$(".timepicker-4").timepicker({
					showInputs: false
				});
			});
		</script>
		
		<!-- Custom -->
		<script src="<?php echo base_url(); ?>assets/js/global.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ajax.js"></script>
	</body>
</html>