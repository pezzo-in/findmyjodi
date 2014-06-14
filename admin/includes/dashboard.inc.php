 <?php
 	$users="select count(id) from members where is_deleted = 'N'";
	$total_users=$obj->select($users);
										
	$users="select count(id) from members where is_deleted = 'N' group by status";
	$active_users=$obj->select($users);
	
	$users="select DISTINCT count(id) from member_plans where paypal_transec_id !='' and expiry_date > '".date('Y-m-d')."'";																			 	$paid_users=$obj->select($users);
	
	$ads = "select count(id) from advertise where status='Active'";
	$db_ads = $obj->select($ads);
?>
<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color" style="display:none"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<!--<div class="color-mode">
								<p>THEME COLOR</p>
								<ul class="inline">
									<li class="color-black current color-default" data-style="default"></li>
									<li class="color-blue" data-style="blue"></li>
									<li class="color-brown" data-style="brown"></li>
									<li class="color-purple" data-style="purple"></li>
									<li class="color-grey" data-style="grey"></li>
									<li class="color-white color-light" data-style="light"></li>
								</ul>
								<label>
									<span>Layout</span>
									<select class="layout-option m-wrap small">
										<option value="fluid" selected>Fluid</option>
										<option value="boxed">Boxed</option>
									</select>
								</label>
								<label>
									<span>Header</span>
									<select class="header-option m-wrap small">
										<option value="fixed" selected>Fixed</option>
										<option value="default">Default</option>
									</select>
								</label>
								<label>
									<span>Sidebar</span>
									<select class="sidebar-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
								<label>
									<span>Footer</span>
									<select class="footer-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
							</div>-->
						</div>
						<!-- END BEGIN STYLE CUSTOMIZER -->    
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard <small>statistics and more</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
                                Dashboard
								</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<div id="dashboard">
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row-fluid">
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat blue">
								<div class="visual">
									<i class="icon-comments"></i>
								</div>
								<div class="details">
                                	<div class="number">
										<?php echo $total_users[0][0]; ?>
									</div>
									<div class="desc">                           
										Total Users
									</div>
								</div>
								<a class="more" href="all_members.php">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat green">
								<div class="visual">
									<i class="icon-shopping-cart"></i>
								</div>
								<div class="details">
                               
									<div class="number"><?php echo $active_users[0][0]; ?></div>
									<div class="desc">Active Users</div>
								</div>
								<a class="more" href="active_members.php">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
							<div class="dashboard-stat purple">
								<div class="visual">
									<i class="icon-globe"></i>
								</div>
								<div class="details">
                                <div class="number"><?php echo $paid_users[0][0]; ?></div>
									<div class="desc">Paid Users</div>
								</div>
								<a class="more" href="paid_members.php">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
						<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
							<div class="dashboard-stat yellow">
								<div class="visual">
									<i class="icon-bar-chart"></i>
								</div>
								<div class="details">
                                	<div class="number"><?php echo $db_ads[0][0]; ?></div>
									<div class="desc">Total Advertise</div>
								</div>
								<a class="more" href="list_advertise.php">
								View more <i class="m-icon-swapright m-icon-white"></i>
								</a>                 
							</div>
						</div>
					</div>
					<!-- END DASHBOARD STARTS -->
					<div class="clearfix"></div>
					<div class="row-fluid">
						<div class="span6" style="width:340px">
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Site Statistics</div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>-->
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px;" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-info">                        
															<?php echo $total_users[0][0]; ?>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a href="list_members.php">Total Members</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													
												</div>
											</li>
											<li>
											
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-success">                        
															<?php if($active_users[1][0]!='') { echo $active_users[1][0]; } else {echo '0'; } ?>
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc2">
                                                                	<a href="inactive_members.php">Inactive Members</a>                                                                 </div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
												
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-important">                      
																<?php if($active_users[0][0]!='') { echo $active_users[0][0]; } else {echo '0'; } ?>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a href="active_members.php">Active Members</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-info">                        
																<?php echo $paid_users[0][0]; ?>
                                                            </div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a href="paid_members.php">Paid Members</a>             
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
                                            <?php
                                            	$total_male="select id from members	where is_deleted = 'N' and gender='M'";
												$male_members=$obj->select($total_male); 
											?>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-success">                      
																<?php echo count($male_members); ?>                            
                            								</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a href="list_members.php?gender=M">Male Profiles</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
                                            <?php
                                            	$total_female="select id from  members where is_deleted = 'N' and gender='F'";
												$female_members=$obj->select($total_female); 
											?>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label">                        
																<?php echo count($female_members); ?>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a title="" href="list_members.php?gender=F">Female Profiles</a>																
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<a href="#"></a>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-inverse">                        
													<?php $total_hindus="select count(id) from  members where religion like 'hindu%' and is_deleted = 'N'";
                                  							 $hindu_members=$obj->select($total_hindus); 
															 echo $hindu_members[0][0]; ?>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc2">
																	<a title="" href="list_members.php?religion=hindu">Hindus</a>  
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
												</a>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-info">                        
											 <?php $total_chistians="select count(id) from  members where religion like 'Christian%' and is_deleted = 'N'";																			  													$chistian_members=$obj->select($total_chistians); 
													echo $chistian_members[0][0]; ?>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a title="" href="list_members.php?religion=Christian">Christians</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													
												</div>
											</li>
											<li>
												<a href="#"></a>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-important">                        
										<?php $total_muslims="select count(id) from  members where religion like 'Muslim%' and is_deleted = 'N'";
                                  				$muslim_members=$obj->select($total_muslims); 
												echo $muslim_members[0][0]; ?>
                            
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc2">
																	<a title="" href="list_members.php?religion=Muslim">Muslims</a>
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
												</a>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-inverse">                      
																<?php $total_sikhs="select count(id) from  members where religion like 'Sikh%' and is_deleted = 'N'";
                                  									$sikh_members=$obj->select($total_sikhs); 
																	echo $sikh_members[0][0]; ?>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a title="" href="list_members.php?religion=sikh">Sikhs</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-info">                        
																<?php $total_jains="select count(id) from  members where religion like 'jain%' and is_deleted = 'N'";
                                  									  $jain_members=$obj->select($total_jains); 
																	  echo $jain_members[0][0]; ?>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
																<a title="" href="list_members.php?religion=jain">Jain</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-success">                      
																<?php $total_parsis="select count(id) from  members 
																					 where religion like 'parsi%' and is_deleted = 'N'";
                                  									  $parsis_members=$obj->select($total_parsis); 
																	  echo $parsis_members[0][0]; ?>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc2">
															<a title="" href="list_members.php?religion=parsi">Parsis</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
																					</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right">
											<a href="all_members.php">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>
                        
                        
                        <div class="span6" style="width:340px">
							<div class="portlet box yellow tasks-widget">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Site Configuration</div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>-->
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px;" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
											
											<li>
												
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
														<img src="images/Website Parameter Settings.png"/>
                                                      
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc">
                                                                	<a href="website_parameter_setting.php">Website Parameter Settings</a>                                                                    
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
											
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
															<img src="images/SMS Settings.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="sms_setting.php">SMS Settings</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                        
																
                                                                <img src="images/Set Password.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="password_setting.php?id=<?php echo $_SESSION['id'];?>">Set Password</a>             
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/Edit Membership Plans.png"/>
																               
                            
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="list_plans2.php">Edit Membership Plans</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											
											
									</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right">
											<a href="#">&nbsp <!--<i class="m-icon-swapright m-icon-gray"></i>--></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>
                        
            
                        
                       <div class="span6" style="width:340px">
							<div class="portlet box green tasks-widget">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Members Approval</div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>-->
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
											
											<li>
												
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
														<img src="images/Approve Inactive to Active.png"/>
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc">
                                                                	<a href="inactive_members.php">Approve Inactive to Active</a>                                                                    
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
											
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/Approve Active to Paid.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="active_members.php">Approve Active to Paid</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                        
																
                                                                	<img src="images/Approve Paid to Featured.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="paid_members.php">Approve Paid to Featured</a>             
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											
                                            <li style="display:none">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/icon22.gif"/>
																               
                            
															</div>
														</div>
														<div class="cont-col2" style="display:none">
															<div class="desc">
																<a href="member_photo_approval.php">Photo Approval</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											
											
									</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right">
											<a href="all_members.php">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div> 
                        
                        
                       
                        
                        
                   </div>
                                
                                
                                
              		<div class="clearfix"></div>
					<div class="row-fluid">                  
                                
        <div class="span6" style="width:340px;">
							<div class="portlet box green tasks-widget">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Member Status</div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>-->
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
									
											<li>
												
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
											
                                                             <img src="images/Inactive Members.png"/>
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc">
                                                                	<a href="inactive_members.php">Inactive Members</a>                                                                    
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
												
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/Active Members.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="active_members.php">Active Members</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                        
															<img src="images/Paid Members.png">
                                                                
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="paid_members.php">Paid Members</a>             
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
										
										
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                        
																<img src="images/Featured Member.png">
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a title="" href="featured_members.php">Featured Member</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													
												</div>
											</li>
											<li>
												<a href="#"></a>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
																
                            											<img src="images/View All Member.png"/>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	<a title="" href="all_members.php">View All Member</a>
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
												</a>
											</li>
										
											
									</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right">
											<a href="all_members.php">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>
                        
<div class="span6" style="width:340px">
							<div class="portlet box purple tasks-widget">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Member Report</div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>-->
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
											
											<li>
												
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
														<img src="images/Member Report In Excel File.png"/>
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc">
                                                                	<a href="all_member_excel.php" target="_blank">Member Report In Excel File</a>                                                                    
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
											
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
															<img src="images/Import Members By Excel File.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="#">Import Members By Excel File</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                        
																
                                                                <img src="images/Sales Reports.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="sales_report.php">Sales Reports</a>             
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/Send Emails to Members.png"/>
																               
                            
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="send_email_member.php">Send Emails to Members</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                        
																<img src="images/Send Group Mails.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a title="" href="send_group_emails.php">Send Group Mails</a>																
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											
									</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right">
											<a href="#">&nbsp <!--See All Records <i class="m-icon-swapright m-icon-gray"></i>--></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>                        
         
                        
                        <div class="span6" style="width:340px">
							<div class="portlet box blue tasks-widget">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Add New Detail</div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>-->
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
											
											<li>
												
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
														<img src="images/Advertisement.png"/>
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc">
                                                                	<a href="list_advertisements.php">Advertisement</a>                                                                    
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
											
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/Success Story.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="list_members_story.php">Success Story</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                        
																
                                                                	<img src="images/Wedding Planners.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="#">Wedding Planners</a>             
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/Franchiese-Staff Users.png"/>
																               
                            
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="#">Franchiese / Staff Users</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											
									</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right">
											<a href="#">&nbsp <!--See All Records <i class="m-icon-swapright m-icon-gray"></i>--></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>
                        
                        
  </div>
                        
			
                    
  
					<div class="clearfix"></div>
					<div class="row-fluid">
						<div class="span6">
							<!-- BEGIN PORTLET-->
							<div class="portlet solid bordered light-grey" style="display:none">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bar-chart"></i>Site Visits</div>
									<div class="tools">
										<div class="btn-group pull-right" data-toggle="buttons-radio">
											<a href="" class="btn mini">Users</a>
											<a href="" class="btn mini active">Feedbacks</a>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div id="site_statistics_loading">
										<img src="assets/img/loading.gif" alt="loading" />
									</div>
									<div id="site_statistics_content" class="hide">
										<div id="site_statistics" class="chart"></div>
									</div>
								</div>
							</div>
							<!-- END PORTLET-->
						</div>
					
					</div>
                    
                    <div class="clearfix"></div>
					<div class="row-fluid">                  
                                
        <!--<div class="span6" style="width:340px;">
							<div class="portlet box green tasks-widget">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Renewal Of Membership </div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
									
											<li>
												
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
											
                                                             <img src="images/Inactive Members.png"/>
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc">
                                                                	<a href="inactive_members.php">Renew Membership Expired</a>                                                                    
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
												
											</li>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/Active Members.png"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="coming_renewal.php">Coming Renewal </a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											
									</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right" style="display:none">
											<a href="#">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>-->
                        <div class="span6" style="width:340px;">
							<div class="portlet box purple tasks-widget">
								<div class="portlet-title">
									<div class="caption"><i class="icon-bell"></i>Member Photo Approval</div>
									<div class="actions">
										<!--<div class="btn-group" style="display:none">
											<a class="btn" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											Filter By
											<i class="icon-angle-down"></i>
											</a>
											<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
												<label><input type="checkbox"> Finance</label>
												<label><input type="checkbox" checked=""> Membership</label>
												<label><input type="checkbox"> Customer Support</label>
												<label><input type="checkbox" checked=""> HR</label>
												<label><input type="checkbox"> System</label>
											</div>
										</div>-->
									</div>
								</div>
								<div class="portlet-body">
									<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="0">
										<ul class="feeds">
									<?php
				$sql = "select count(id) from member_photos where Approve=0";
				$res=$obj->select($sql);
				?>
											<li>
												
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="">                        
											
                                                             <img src="images/icon22.gif"/>
																</div>
															</div>
															<div class="cont-col2">
                                                            	<div class="desc">
                                                                	<a href="member_photo_approval.php?status=profile">Profile Photo&nbsp;&nbsp;<span class="badge badge-important"><?php echo $res[0][0] ?></span></a>                                                                    
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															
														</div>
													</div>
												
											</li>
<?php
				$sql = "SELECT distinct(members.id) FROM members JOIN member_photo_gallery ON members.id=member_photo_gallery.member_id order by Approve";
				$res=$obj->select($sql);
				
				$photo1_unapprove=0;
				$photo2_unapprove=0;
				$photo3_unapprove=0;
				$photo4_unapprove=0;
				$photo5_unapprove=0;
				
				for($i=0;$i<count($res);$i++)
				{
					$select_photo_gallery="select Approve from member_photo_gallery where member_id='".$res[$i]['id']."' order by id";
					$db_photo_gallery=$obj->select($select_photo_gallery);
					
					if($db_photo_gallery[0]['Approve']==0 && count($db_photo_gallery)>=1)
					{
						$photo1_unapprove++;
					}
					if($db_photo_gallery[1]['Approve']==0 && count($db_photo_gallery)>=2)
					{
						$photo2_unapprove++;
					}
					if($db_photo_gallery[2]['Approve']==0 && count($db_photo_gallery)>=3)
					{
						$photo3_unapprove++;
					}
					if($db_photo_gallery[3]['Approve']==0 && count($db_photo_gallery)>=4)
					{
						$photo4_unapprove++;
					}
					if($db_photo_gallery[4]['Approve']==0 && count($db_photo_gallery)>=5)
					{
						$photo5_unapprove++;
					}
				}
				?>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/icon22.gif"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="member_photo_approval.php?status=photo1">Album Photo 1 &nbsp;&nbsp;<span class="badge badge-important"><?php echo $photo1_unapprove; ?></span></a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
                                            <li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/icon22.gif"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="member_photo_approval.php?status=photo2">Album Photo 2&nbsp;&nbsp;<span class="badge badge-important"><?php echo $photo2_unapprove; ?></span></a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
                                            <li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/icon22.gif"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="member_photo_approval.php?status=photo3">Album Photo 3&nbsp;&nbsp;<span class="badge badge-important"><?php echo $photo3_unapprove; ?></span></a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
                                            <li>

												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/icon22.gif"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="member_photo_approval.php?status=photo4">Album Photo 4&nbsp;&nbsp;<span class="badge badge-important"><?php echo $photo4_unapprove; ?></span></a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
                                            <li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="">                      
																<img src="images/icon22.gif"/>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href="member_photo_approval.php?status=photo5">Album Photo 5&nbsp;&nbsp;<span class="badge badge-important"><?php echo $photo5_unapprove; ?></span></a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														
													</div>
												</div>
											</li>
											
									</ul>
									</div>
									<div class="scroller-footer">
										<div class="pull-right" style="display:none">
											<a href="#">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>
                        
		  </div>
  	</div>
</div>