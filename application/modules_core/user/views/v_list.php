<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<?php
			if($this->session->flashdata('message') != "") {
				$data['status'] = $this->session->flashdata('status');	
				$data['notify'] = $this->session->flashdata('message');
				$this->load->view('../v_alert', $data);
			}
		?>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-xs-12">
				<!-- Default box -->
				<div class="box box-default box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">List User</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_add('user');" class="btn btn-sm btn-social">
								<i class="fa fa-plus-square"></i> Add Data
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th width="1%" style="display: none;">Order</th>
									<th width="13%">Area</th>
									<th width="20%">Username</th>
									<th>Name</th>
									<th width="15%">Authority</th>
									<th width="18%">Last Login</th>
									<th width="10%">Status</th>
									<th width="5%">Image</th>
									<th width="8%">Action</th>								
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $row) : ?>
								<tr>
									<td align="center" style="display: none;"><?php echo $row->area_id; ?></td>
									<td><?php echo strip_tags($this->m_area->get_name_by_id($row->area_id)); ?></td>
									<td><?php echo $row->user_name; ?></td>
									<td><?php echo strip_tags($row->user_fullname); ?></td>
									<td align="center"><?php echo strip_tags($this->m_authority->get_name_by_id($row->authority_id)); ?></td>
									<td align="center"><?php echo (($row->last_login != "")?convert_to_dmyhis($row->last_login):""); ?></td>
									<td align="center"><?php echo get_status($row->user_status); ?></td>
									<td align="center">
										<div class="product-img">
											<a class="thumb" href="<?php echo base_url() ."assets/uploads/".(($row->user_image != "")?"user/". $row->user_image:"no_image.png"); ?>" alt="<?php echo strip_tags($row->user_name); ?>" data-popup="lightbox">
												<img src="<?php echo base_url() ."assets/uploads/".(($row->user_image != "")?"user/thumb/". $row->user_image:"no_image.png"); ?>" alt="<?php echo strip_tags($row->user_fullname); ?>" width="50" /> 
											</a>
										</div>
									</td>
									<td align="center">
										<div class="btn-group">
											<a href="javascript:void(0);" onClick="edit_data('user', '<?php echo simple_encrypt($row->user_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>	
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->