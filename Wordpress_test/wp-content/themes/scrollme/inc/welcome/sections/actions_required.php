<?php
	wp_enqueue_style( 'plugin-install' );
	wp_enqueue_script( 'plugin-install' );
	wp_enqueue_script( 'updates' );
	

if( !empty($this->actions_req) ) { ?>

		<?php if( $this->actions_req['pro_plug'] ){ ?>
			<h4 class="recomplug-title"><?php echo esc_html($this->strings['pro_plugin_title']); ?></h4>
		<?php } ?>

		<div class="recomended-plugin-wrap ap-required-plugins ap-recom-pl-wrapper">

			<?php 

		foreach($this->actions_req['pro_plug'] as $plugin) {
			$th_status = $this->get_plugin_active($plugin);
			


			switch($th_status) {
				case 'install' :
					$btn_class = 'install button';
					$label = $this->strings['install_n_activate'];
					$th_link = $plugin['location'];
					break;

				case 'inactive' :
					$btn_class = 'deactivate button';
					$label = $this->strings['deactivate'];
					$th_link = admin_url('plugins.php');
					break;

				case 'active' :
					$btn_class = 'activate button button-primary';
					$label = $this->strings['activate'];
					$th_link = $plugin['location'];
					break;
			}

			?>
			<div class="recom-plugin-wrap">
					<div class="recom-plugin-inner-wrapper">
						
						<div class="plugin-title-install clearfix">
							<span class="title" title="<?php echo esc_attr($plugin['name']); ?>">
								<?php echo esc_html($plugin['name']); ?>
							</span>

							<span class="plugin-action-btn plugin-btn-wrapper plugin-card-<?php echo esc_attr($plugin['slug']); ?>">
								<a class="<?php echo esc_attr($btn_class); ?>" data-host-type="<?php echo esc_attr($plugin['host_type']); ?>" data-file="<?php echo esc_attr($plugin['filename']); ?>" data-class="<?php echo esc_attr($plugin['class']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>" href="<?php echo esc_url($th_link); ?>"><?php echo esc_html($label); ?></a>
							</span>
							<div class="version-author-info free">
								<span class="version"><?php echo esc_html__('Version ', 'scrollme') . esc_html($plugin['version']); ?></span>
								<span class="seperator">|</span>
								<span class="author"><?php echo esc_html($plugin['author']); ?></span>
							</div>
						</div>
					</div>
				</div>
			<?php
		} ?>
	</div>


		<h4 class="recomplug-title"><?php echo esc_html($this->strings['free_plugin_title']); ?></h4>
		<div class="recomended-plugin-wrap ap-required-plugins ap-recom-pl-wrapper">

		<?php
		foreach($this->actions_req['free_plug'] as $plugin) {
			$info = $this->call_plugin_api($plugin['slug']);

			
			$th_status = $this->get_plugin_active($plugin);
			$btn_url = $this->generate_plugin_url($th_status, $plugin);

			switch($th_status) {
				case 'install' :
					$btn_class = 'install button';
					$label = $this->strings['install_n_activate'];
					break;

				case 'inactive' :
					$btn_class = 'deactivate button';
					$label = $this->strings['deactivate'];
					break;

				case 'active' :
					$btn_class = 'activate button button-primary';
					$label = $this->strings['activate'];
					break;
			}

			?>
				<div class="recom-plugin-wrap ">
					<div class="recom-plugin-inner-wrap">
						
						<div class="plugin-title-install clearfix">
							<?php if( $info->name ){ ?>
								<span class="title" title="<?php echo esc_attr($info->name); ?>">
									<?php echo esc_html($info->name); ?>
								</span>
							<?php } ?>

							<?php if( isset($plugin['info']) ){ ?>
								<p class="plugin-info">
									<?php echo esc_html($plugin['info']); ?>
								</p>
							<?php } ?>
								
							<span class="plugin-action-btn plugin-btn-wrapper plugin-card-<?php echo esc_attr($plugin['slug']); ?>" action_button>
								<a class="<?php echo esc_attr($btn_class); ?>" data-file="<?php echo esc_attr($plugin['filename']); ?>" data-slug="<?php echo esc_attr($plugin['slug']); ?>" href="<?php echo esc_url($btn_url); ?>"><?php echo esc_html($label); ?></a>
							</span>
							<div class="version-author-info free">
								<span class="version"><?php echo esc_html__('Version ', 'scrollme') . esc_html($info->version); ?></span>
								<span class="seperator">|</span>
								<span class="author"><?php echo wp_kses_post($info->author); ?></span>
							</div>
						</div>
					</div>
				</div>
			<?php
		} ?>
		</div>

		
	<?php
	}