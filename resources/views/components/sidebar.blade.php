<div class="left side-menu">
				<div class="slimscroll-menu" id="remove-scroll">
					<!--- Sidemenu -->
					<div id="sidebar-menu">
						<!-- Left Menu Start -->
						<ul class="metismenu" id="side-menu">
							<li class="menu-title">Main</li>
							<li><a href="{{ url('dashboard') }}" class="waves-effect"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
							<li><a href="{{ url('admin_users') }}" class="waves-effect"><i class="fa fa-user"></i> <span>Manage Admin Users</span></a></li>
							<li><a href="{{ url('pg_owners') }}" class="waves-effect"><i class="fa fa-user"></i> <span>Manage PG Owners</span></a></li>
							<li><a href="{{ url('tenants') }}" class="waves-effect"><i class="fa fa-user"></i> <span>Manage Tenants</span></a></li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-building"></i><span> Property Management <span class="float-right menu-arrow"><i class="fa  fa-chevron-down"></i></span></span></a>
								<ul class="submenu">
									<li><a href="{{ url('/pges') }}"><i class="fa fa-angle-right"></i> Manage PGs</a></li>
									<li><a href="{{ url('/amenities') }}"><i class="fa fa-angle-right"></i> Manage Amenities</a></li>
									<li><a href=" {{ url('/property_types') }}"><i class="fa fa-angle-right"></i> Property Types</a></li>
									<li><a href=" {{ url('/room_types') }}"><i class="fa fa-angle-right"></i> Room Types</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-tag"></i><span> Manage Categories <span class="float-right menu-arrow"><i class="fa  fa-chevron-down"></i></span></span></a>
								<ul class="submenu">
									<li><a href="{{ url('/categories') }}"><i class="fa fa-angle-right"></i> Categories</a></li>
									<li><a href="{{ url('/categories/add_category') }}"><i class="fa fa-angle-right"></i> Add New </a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-tag"></i><span> Manage Coupons <span class="float-right menu-arrow"><i class="fa  fa-chevron-down"></i></span></span></a>
								<ul class="submenu">
									<li><a href="{{ url('/coupans') }}"><i class="fa fa-angle-right"></i> Coupons</a></li>
									<li><a href="{{ url('/coupans/add_coupan') }}"><i class="fa fa-angle-right"></i> Add New </a></li>
								</ul>
							</li>
							<!--<li>-->
							<!--	<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-envelope"></i><span> Manage Cities <span class="float-right menu-arrow"><i class="fa  fa-chevron-down"></i></span></span></a>-->
							<!--	<ul class="submenu">-->
							<!--		<li><a href="{{ url('/citymaster') }}"><i class="fa fa-angle-right"></i> Cities</a></li>-->
							<!--		<li><a href="{{ url('/citymaster/add_city') }}"><i class="fa fa-angle-right"></i> Add New </a></li>-->
							<!--	</ul>-->
							<!--</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-envelope"></i><span>  Email Templates <span class="float-right menu-arrow"><i class="fa  fa-chevron-down"></i></span></span></a>
								<ul class="submenu">
									<li><a href="{{ url('/emailtemplates') }}"><i class="fa fa-angle-right"></i> Templates </a></li>
									<li><a href="{{ url('/emailtemplates/sendemail') }}"><i class="fa fa-angle-right"></i> Send Email </a></li>
								</ul>
							</li>
							<li><a href="{{ url('cancellation_policy') }}" class="waves-effect"><i class="fa fa-credit-card-alt"></i> <span> Cancellation Policy</span></a></li>
							-->
							<li><a href="{{ url('pg_bookings') }}" class="waves-effect"><i class="fa fa-credit-card-alt"></i> <span>Manage Bookings</span></a></li>
							<li><a href="{{ url('discounts') }}" class="waves-effect"><i class="fa fa-percent"></i> <span>Manage PG Discounts</span></a></li>
							<li><a href="{{ url('security_diposits') }}" class="waves-effect"><i class="fa fa-money"></i> <span>Manage Security Deposits</span></a></li>
							<li><a href="{{ url('refer_and_earn') }}" class="waves-effect"><i class="fa fa-money"></i> <span>Refer & Earn</span></a></li>
              <!-- <li>
								<a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user"></i><span> User <span class="float-right menu-arrow"><i class="fa  fa-chevron-down"></i></span></span></a>
								<ul class="submenu">
                  <li><a href="{{ url('/users') }}"><i class="fa fa-angle-right"></i> Users</a></li>
                  <li><a href=" {{ url('/users/add_user') }}"><i class="fa fa-angle-right"></i> Add User</a></li>
								</ul>
							</li> -->
              <!-- <li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-message"></i><span> Email <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="email-inbox.html">Inbox</a></li>
									<li><a href="email-read.html">Email Read</a></li>
									<li><a href="email-compose.html">Email Compose</a></li>
								</ul>
							</li>
							<li><a href="calendar.html" class="waves-effect"><i class="dripicons-calendar"></i><span> Calendar</span></a></li>
							<li class="menu-title">Components</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span>UI Elements <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="ui-alerts.html">Alerts</a></li>
									<li><a href="ui-badge.html">Badge</a></li>
									<li><a href="ui-buttons.html">Buttons</a></li>
									<li><a href="ui-cards.html">Cards</a></li>
									<li><a href="ui-dropdowns.html">Dropdowns</a></li>
									<li><a href="ui-navs.html">Navs</a></li>
									<li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
									<li><a href="ui-modals.html">Modals</a></li>
									<li><a href="ui-images.html">Images</a></li>
									<li><a href="ui-progressbars.html">Progress Bars</a></li>
									<li><a href="ui-lightbox.html">Lightbox</a></li>
									<li><a href="ui-pagination.html">Pagination</a></li>
									<li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>
									<li><a href="ui-carousel.html">Carousel</a></li>
									<li><a href="ui-video.html">Video</a></li>
									<li><a href="ui-typography.html">Typography</a></li>
									<li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
									<li><a href="ui-grid.html">Grid</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-broadcast"></i> <span>Icons <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="icons-material.html">Material Design</a></li>
									<li><a href="icons-ion.html">Ion Icons</a></li>
									<li><a href="icons-fontawesome.html">Font Awesome</a></li>
									<li><a href="icons-themify.html">Themify Icons</a></li>
									<li><a href="icons-dripicons.html">Dripicons</a></li>
									<li><a href="icons-typicons.html">Typicons Icons</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-to-do"></i><span> Forms <span class="badge badge-pill badge-success float-right">8</span></span></a>
								<ul class="submenu">
									<li><a href="form-elements.html">Form Elements</a></li>
									<li><a href="form-validation.html">Form Validation</a></li>
									<li><a href="form-advanced.html">Form Advanced</a></li>
									<li><a href="form-editors.html">Form Editors</a></li>
									<li><a href="form-uploads.html">Form File Upload</a></li>
									<li><a href="form-mask.html">Form Mask</a></li>
									<li><a href="form-summernote.html">Summernote</a></li>
									<li><a href="form-xeditable.html">Form Xeditable</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-graph-bar"></i><span> Charts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="charts-morris.html">Morris Chart</a></li>
									<li><a href="charts-chartist.html">Chartist Chart</a></li>
									<li><a href="charts-chartjs.html">Chartjs Chart</a></li>
									<li><a href="charts-flot.html">Flot Chart</a></li>
									<li><a href="charts-c3.html">C3 Chart</a></li>
									<li><a href="charts-other.html">Jquery Knob Chart</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-view-thumb"></i><span> Tables <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="tables-basic.html">Basic Tables</a></li>
									<li><a href="tables-datatable.html">Data Table</a></li>
									<li><a href="tables-responsive.html">Responsive Table</a></li>
									<li><a href="tables-editable.html">Editable Table</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-map"></i><span> Maps <span class="badge badge-pill badge-danger float-right">2</span></span></a>
								<ul class="submenu">
									<li><a href="maps-google.html">Google Map</a></li>
									<li><a href="maps-vector.html">Vector Map</a></li>
								</ul>
							</li>
							<li class="menu-title">Extras</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-archive"></i><span> Advanced UI <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="advanced-animation.html">Animation</a></li>
									<li><a href="advanced-highlight.html">Highlight</a></li>
									<li><a href="advanced-rating.html">Rating</a></li>
									<li><a href="advanced-nestable.html">Nestable</a></li>
									<li><a href="advanced-alertify.html">Alertify</a></li>
									<li><a href="advanced-rangeslider.html">Range Slider</a></li>
									<li><a href="advanced-sessiontimeout.html">Session Timeout</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-box"></i><span> Authentication <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="pages-login.html">Login</a></li>
									<li><a href="pages-register.html">Register</a></li>
									<li><a href="pages-recoverpw.html">Recover Password</a></li>
									<li><a href="pages-lock-screen.html">Lock Screen</a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:void(0);" class="waves-effect"><i class="dripicons-duplicate"></i><span> Extra Pages <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
								<ul class="submenu">
									<li><a href="pages-timeline.html">Timeline</a></li>
									<li><a href="pages-invoice.html">Invoice</a></li>
									<li><a href="pages-directory.html">Directory</a></li>
									<li><a href="pages-blank.html">Blank Page</a></li>
									<li><a href="pages-404.html">Error 404</a></li>
									<li><a href="pages-500.html">Error 500</a></li>
								</ul>
							</li> -->
						</ul>
					</div>
					<!-- Sidebar -->
					<div class="clearfix"></div>
				</div>
				<!-- Sidebar -left -->
      </div>
