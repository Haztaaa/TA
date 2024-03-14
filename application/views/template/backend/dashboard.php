<?php $this->load->view('template/backend/partials/header'); ?>

<body class="page-body page-fade-only skin-blue" data-url="http://neon.dev">

	<div class="page-container">
		<!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		<?php $this->load->view('template/backend/partials/menu'); ?>
		<div class="main-content">
			<div class="row">
				<!-- Profile Info and Notifications -->
				<div class="col-md-6 col-sm-8 clearfix">

					<ul class="user-info pull-left pull-none-xsm">

						<!-- Profile Info -->
						<li class="profile-info dropdown">
							<!-- add class "pull-right" if you want to place this from right -->

							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?= base_url() ?>assets/images/profil.jpg" alt="" class="img-circle" width="44" />
								<?php echo $this->session->userdata('nama'); ?>
							</a>

							<ul class="dropdown-menu">

								<!-- Reverse Caret -->
								<li class="caret"></li>
								<!-- Profile sub-links -->


								<li>
									<a href="<?php echo base_url('login/logout') ?>">
										<i class="entypo-logout"></i>
										Keluar
									</a>
								</li>
							</ul>
						</li>

					</ul>

					<ul class="user-info pull-left pull-right-xs pull-none-xsm">



						</li>


					</ul>

					</li>

				</div>

			</div>

			<hr />

			<!-- konten disini -->
			<?= $contents; ?>

			<!--   </div>
      </div> -->
			<br />

			<?php $this->load->view('template/backend/partials/footer'); ?>