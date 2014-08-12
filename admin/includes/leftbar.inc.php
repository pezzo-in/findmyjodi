<?php

$url=explode('/',$_SERVER['REQUEST_URI']);

$url_new=explode('?',$url[2]);



//query to check access permission

$sql="select * from  admin where id='".$_SESSION['id']."'";

$ans=$obj->select($sql);	

$sql2="select * from  role where id='".$ans[0]['role_id']."'";

$ans2=$obj->select($sql2);	

$mem_permission = explode(",",$ans2[0]['member_access']); 

$story_permission = explode(",",$ans2[0]['member_story_access']); 

$plan_permission = explode(",",$ans2[0]['member_plan_access']); 

//end

?>

<div class="page-sidebar nav-collapse collapse">

    <!-- BEGIN SIDEBAR MENU -->        

    <ul class="page-sidebar-menu">

        <li>

            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

            <div class="sidebar-toggler hidden-phone"></div>

            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

        </li>

        <li>

            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

            <!--<form class="sidebar-search">

                <div class="input-box">

                    <a href="javascript:;" class="remove"></a>

                    <input type="text" placeholder="Search..." />

                    <input type="button" class="submit" value=" " />

                </div>

            </form>-->

            <!-- END RESPONSIVE QUICK SEARCH FORM -->

        </li>

        <li class="start <?php if($url[3]=='dashboard.php' || $url[2]=='dashboard.php'){?> active<?php }?>">

            <a href="dashboard.php">

            <i class="icon-home"></i> 

            <span class="title">Dashboard</span>

            <span class="selected"></span>

            </a>

        </li>

        <li class="<?php if($url[3]=='list_role.php' || $url[2]=='list_role.php' || $url_new[0]=='list_role.php' || $url[3]=='add_new_role.php' || $url_new[0]=='add_new_role.php' || $url[3]=='list_user.php' || $url[2]=='list_user.php' || $url_new[0]=='list_user.php' || $url[3]=='add_new_user.php' || $url_new[0]=='add_new_user.php' || $url[3]=='edit_prefix.php' || $url[2]=='edit_prefix.php') { ?>active<?php } ?>" >

            <a href="javascript:;">

            <i class="icon-user"></i> 

            <span class="title">Users</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

                <li class="<?php if($url_new[0]=='list_role.php' || $url[2]=='list_role.php'){?>active<?php }?>"><a href="list_role.php">Manage Roles</a></li>

                <li class="<?php if($url_new[0]=='list_user.php' || $url[2]=='list_user.php'){?>active<?php }?>"><a href="list_user.php">Manage Users</a></li>

                <li class="<?php if($url_new[0]=='edit_prefix.php' || $url[2]=='edit_prefix.php'){?>active<?php }?>"><a href="edit_prefix.php">Matrimony-Id Prefix</a></li>

                <li class="<?php if($url_new[0]=='logout.php' || $url[2]=='logout.php'){?>active<?php }?>"><a href="logout.php">Logout</a></li>	              

            </ul>

        </li>

        <li class="<?php 

					if($url[3]=='list_religions.php' || $url_new[0]=='add_new_religion.php' || $url[2]=='list_religions.php' 

					   || $url_new[0]=='list_religions.php' || $url[2]=='add_new_religions.php' || $url[3]=='list_religions.php'

					   || $url_new[0]=='add_new_caste.php' || $url[2]=='add_new_caste.php' || $url[3]=='list_caste.php'

					   || $url_new[0]=='add_new_sub_caste.php' || $url[2]=='add_new_sub_caste.php' || $url[3]=='list_sub_caste.php'

					   || $url_new[0]=='add_new_country.php' || $url[2]=='add_new_country.php' || $url[2]=='list_country.php'

					   || $url_new[0]=='list_mothertongues.php' || $url_new[0]=='add_new_mothertongue.php' || $url[2]=='add_new_mothertongue.php' || $url[3]=='list_mothertongues.php'

					   || $url_new[0]=='list_jobroles.php' ||  $url_new[0]=='add_new_jobrole.php' || $url[2]=='add_new_jobrole.php' || $url[3]=='list_jobroles.php'

					   || $url_new[0]=='list_personalities.php' || $url_new[0]=='add_new_personality.php' || $url[2]=='add_new_personality.php' || $url[3]=='list_personalities.php'

					   || $url_new[0]=='list_relationship_status.php' || $url_new[0]=='add_new_relationship_status.php' || $url[2]=='add_new_relationship_status.php' || $url[3]=='list_relationship_status.php'

					   || $url_new[0]=='list_degrees.php' || $url_new[0]=='add_new_degree.php' || $url[2]=='add_new_degree.php' || $url[3]=='list_degrees.php'

					   

					   || $url_new[0]=='list_hobbies.php' || $url_new[0]=='add_new_hobbies.php' || $url[2]=='add_new_hobbies.php' || $url[3]=='list_hobbies.php'

						 

					   || $url_new[0]=='list_interest.php' || $url_new[0]=='add_new_interest.php' || $url[2]=='add_new_interest.php' || $url[3]=='list_interest.php'

						  

		  			   || $url_new[0]=='list_music.php' || $url_new[0]=='add_new_music.php' || $url[2]=='add_new_music.php' || $url[3]=='list_music.php'

		  

						|| $url_new[0]=='list_read.php' || $url_new[0]=='add_new_read.php' || $url[2]=='add_new_read.php' || $url[3]=='list_read.php'

						

					  || $url_new[0]=='list_movies.php' || $url_new[0]=='add_new_movies.php' || $url[2]=='add_new_movies.php' || $url[3]=='list_movies.php'

			  

						|| $url_new[0]=='list_activities.php' || $url_new[0]=='add_new_activities.php' || $url[2]=='add_new_activities.php' || $url[3]=='list_activities.php'

				

						  || $url_new[0]=='list_couisine.php' || $url_new[0]=='add_new_couisine.php' || $url[2]=='add_new_couisine.php' || $url[3]=='list_couisine.php'

				  

  						 || $url_new[0]=='list_dressstyle.php' || $url_new[0]=='add_new_dressstyle.php' || $url[2]=='add_new_dressstyle.php' || $url[3]=='list_dressstyle.php'

 						 || $url_new[0]=='list_languages.php' || $url_new[0]=='add_new_languages.php' || $url[2]=='add_new_languages.php' || $url[3]=='list_languages.php'		

						 

					   || $url_new[0]=='list_education_levels.php' || $url_new[0]=='add_new_education_level.php' || $url[2]=='add_new_education_level.php' || $url[3]=='list_education_levels.php'

					   || $url_new[0]=='add_new_bodytype.php' || $url[2]=='add_new_bodytype.php' || $url[2]=='list_body_types.php' || $url_new[0]=='list_height.php' || $url_new[0]=='add_height.php' || $url[2]=='add_height.php' || $url[3]=='list_height.php'){?> active<?php }?>" >

            <a href="javascript:;">

            <i class="icon-sitemap"></i> 

            <span class="title">Add New</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">            

            	<li class="<?php if($url[3]=='list_body_types.php' || $url[2]=='list_body_types.php'){?>active<?php }?>"><a href="list_body_types.php">Body Type</a></li>

                <li class="<?php if($url[3]=='list_height.php' || $url[2]=='list_height.php'){?>active<?php }?>"><a href="list_height.php">Height</a></li>

                <li class="<?php if($url[3]=='list_caste.php' || $url[2]=='list_caste.php'){?>active<?php }?>"><a href="list_caste.php">Caste</a></li>	         

			 <li class="<?php if($url[3]=='list_sub_caste.php' || $url[2]=='list_sub_caste.php'){?>active<?php }?>"><a href="list_sub_caste.php">Subcaste</a></li>	

                <li class="<?php if($url[3]=='list_country.php' || $url[2]=='list_country.php'){?>active<?php }?>"><a href="list_country.php">Country</a></li>

                <li class="<?php if($url[3]=='list_degrees.php' || $url[2]=='list_degrees.php'){?>active<?php }?>"><a href="list_degrees.php">Degree</a></li>

                <li class="<?php if($url[3]=='list_education_levels.php' || $url[2]=='list_education_levels.php'){?>active<?php }?>"><a href="list_education_levels.php">Educational Level</a></li>   

               

                               <li class="<?php if($url[3]=='list_jobroles.php' || $url[2]=='list_jobroles.php'){?>active<?php }?>"><a href="list_jobroles.php">Job Role</a></li> 

                <li class="<?php if($url[3]=='list_mothertongues.php' || $url[2]=='list_mothertongues.php'){?>active<?php }?>"><a href="list_mothertongues.php">Mother Tongue</a></li> 

                 <li class="<?php if($url[3]=='list_personalities.php' || $url[2]=='list_personalities.php'){?>active<?php }?>"><a href="list_personalities.php">Personality</a></li>

                 <li class="<?php if($url[3]=='list_relationship_status.php' || $url[2]=='list_relationship_status.php'){?>active<?php }?>"><a href="list_relationship_status.php">Relationship Status</a></li>

                <li class="<?php if($url[3]=='list_religions.php' || $url[2]=='list_religions.php'){?>active<?php }?>"><a href="list_religions.php">Religion</a></li> 

                

                  <li class="<?php if($url[3]=='list_hobbies.php' || $url[2]=='list_hobbies.php'){?>active<?php }?>"><a href="list_hobbies.php">Hobbies</a></li> 

                  

                   <li class="<?php if($url[3]=='list_interest.php' || $url[2]=='list_interest.php'){?>active<?php }?>"><a href="list_interest.php">Interest</a></li> 

                   

                    <li class="<?php if($url[3]=='list_music.php' || $url[2]=='list_music.php'){?>active<?php }?>"><a href="list_music.php">Music</a></li>

                     

                 <li class="<?php if($url[3]=='list_read.php' || $url[2]=='list_read.php'){?>active<?php }?>"><a href="list_read.php">Read</a></li> 

                 

                  <li class="<?php if($url[3]=='list_movies.php' || $url[2]=='list_movies.php'){?>active<?php }?>"><a href="list_movies.php">Movies</a></li> 

                

 <li class="<?php if($url[3]=='list_activities.php' || $url[2]=='list_activities.php'){?>active<?php }?>"><a href="list_activities.php">Activities</a></li> 

                 

                  <li class="<?php if($url[3]=='list_couisine.php' || $url[2]=='list_couisine.php'){?>active<?php }?>"><a href="list_couisine.php">Couisine</a></li> 

                  

                   <li class="<?php if($url[3]=='list_dressstyle.php' || $url[2]=='list_dressstyle.php'){?>active<?php }?>"><a href="list_dressstyle.php">Dress Style</a></li> 

                   

                    <li class="<?php if($url[3]=='list_languages.php' || $url[2]=='list_languages.php'){?>active<?php }?>"><a href="list_languages.php">Languages</a></li> 

                </ul>

                

        </li>

        <li class="has-sub<?php 

		 					if($url[3]=='inactive_members.php' || $url_new[0]=='active_members.php' || 

							   $url[3]=='paid_members.php' || $url_new[0]=='all_members.php' || 

							   $url[3]=='sales_report.php' || $url[0]=='excel_members.php' || 

							   $url[3]=='add_new_member.php' || $url[0]=='add_new_member.php' ||

							   $url[3]=='list_members.php' || $url[0]=='list_members.php' ||

							   $url[3]=='members_plan.php' || $url[0]=='members_plan.php' ||

							    $url[3]=='member_photo_approval.php' || $url[0]=='member_photo_approval.php' 

								 

								 

							   

							   )

							   {?> active<?php }?> ">

                    <a href="javascript:;">

                        <i class="icon-bar-chart"></i> 

            <span class="title">Members</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

               <li class="<?php if($url[3]=='inactive_members.php' || $url[2]=='inactive_members.php'){?>active<?php }?>">

                            <a href="inactive_members.php">Inactive Members</a>

                        </li>

                        <li class="<?php if($url[3]=='active_members.php' || $url[2]=='active_members.php'){?>active<?php }?>">

                    		<a href="active_members.php">Active Members</a>

						</li> 

                        <li class="<?php if($url[3]=='paid_members.php' || $url[2]=='paid_members.php'){?>active<?php }?>">

                    		<a href="paid_members.php">Paid Members</a>

						</li>

                        <li class="<?php if($url[3]=='all_members.php' || $url[2]=='all_members.php'){?>active<?php }?>">

                    		<a href="all_members.php">All Members</a>

						</li> 

                        <li class="<?php if($url[3]=='sales_report.php' || $url[2]=='sales_report.php'){?>active<?php }?>">

                    		<a href="sales_report.php">Sales Reports</a>

						</li>

                        <li class="<?php if($url[3]=='excel_members.php' || $url[2]=='excel_members.php'){?>active<?php }?>">

                    		<a href="#">Members in Excle</a>

						</li>

                        <li class="<?php if($url[3]=='list_members.php' || $url[2]=='list_members.php'){?>active<?php }?>">

                    		<a href="list_members.php">Manage Members</a>

						</li>

                        <li class="<?php if($url[3]=='add_new_member.php' || $url[2]=='add_new_member.php'){?>active<?php }?>">

                    		<a href="add_new_member.php">Add New</a>

						</li>

                       <!-- <li class="<?php if($url[3]=='members_plan.php' || $url[2]=='members_plan.php'){?>active<?php }?>">

                    		<a href="members_plan.php">Edit Plan</a>

						</li>-->

                        <?php /*?><li class="<?php if($url[3]=='member_photo_approval.php' || $url[2]=='member_photo_approval.php'){?>active<?php }?>">

                    		<a href="member_photo_approval.php">Member Photo Approval</a>

						</li><?php */?>

            </ul>

        </li>

        <li class="<?php if($url[3]=='list_members_story.php' || $url[2]=='list_members_story.php' || $url_new[0]=='list_members_story.php' || $url[3]=='member_photo_approval.php' || $url_new[0]=='member_photo_approval.php') { ?> active<?php } ?> " >

            <a href="javascript:;">

            <i class="icon-file-text"></i> 

            <span class="title">Approvals</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

            <?php 

			$m="select * from messages where Status=0";

			$msg=$obj->select($m);

			?>

<!--<li class=""><a href="approve_msg.php"><?php if(count($msg)!=0){ ?><span class="badge badge-important"><?php echo count($msg); ?></span><?php } ?>Message</a></li> -->

                <li class=""><a href="list_members_story.php">Success Story</a></li>             

                <?php

				$sql = "SELECT members.member_id as mem_id,members.id as mid,members.email_id,members.name,member_photos.id as pid, member_photos.member_id as pmid,member_photos.photo,member_photos.Approve FROM members JOIN member_photos ON members.id=member_photos.member_id order by Approve";

				$res=$obj->select($sql);

				$profile_unapprove=0;

				for($i=0;$i<count($res);$i++)

				{

					 if($res[$i]['Approve'] == "0")

					 {

						 $profile_unapprove++;

					 }

				}

				?>

                <li class=""><a href="member_photo_approval.php?status=profile"><?php if($profile_unapprove!=0){ ?><span class="badge badge-important"><?php echo $profile_unapprove; ?></span><?php } ?>Profile Photo</a></li>

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

					$select_photo_gallery="select * from member_photo_gallery where member_id='".$res[$i]['id']."' order by id";

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

                <li class=""><a href="member_photo_approval.php?status=photo1"><?php if($photo1_unapprove!=0){ ?><span class="badge badge-important"><?php echo $photo1_unapprove; ?></span><?php } ?>Album Photo 1</a></li>

                <li class=""><a href="member_photo_approval.php?status=photo2"><?php if($photo2_unapprove!=0){ ?><span class="badge badge-important"><?php echo $photo2_unapprove; ?></span><?php } ?>Album Photo 2</a></li>

                <li class=""><a href="member_photo_approval.php?status=photo3"><?php if($photo3_unapprove!=0){ ?><span class="badge badge-important"><?php echo $photo3_unapprove; ?></span><?php } ?>Album Photo 3</a></li>

                <li class=""><a href="member_photo_approval.php?status=photo4"><?php if($photo4_unapprove!=0){ ?><span class="badge badge-important"><?php echo $photo4_unapprove; ?></span><?php } ?>Album Photo 4</a></li>

                <li class=""><a href="member_photo_approval.php?status=photo5"><?php if($photo5_unapprove!=0){ ?><span class="badge badge-important"><?php echo $photo5_unapprove; ?></span><?php } ?>Album Photo 5</a></li>	              

            </ul>

        </li>

        <!--<li class="<?php /*?><?php if($url[3]=='list_plans.php' || $url_new[0]=='add_new_plan.php' || $url[2]=='list_plans.php' || $url_new[0]=='list_plans.php' || $url[2]=='add_new_plan.php' || $url[3]=='add_new_plan.php'){?> active<?php }?><?php */?>" >

            <a href="javascript:;">

            <i class="icon-briefcase"></i> 

            <span class="title">Membership Plans</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

                <li class=""><a href="list_plans.php">Plan List</a></li>	              

            </ul>

        </li>-->

        <li class="<?php if($url[3]=='list_plans2.php' || $url_new[0]=='add_new_plan2.php' || $url[2]=='list_plans2.php' || $url_new[0]=='list_plans2.php' || 

		$url[2]=='add_new_plan2.php' || $url[3]=='add_new_plan2.php'){?> active<?php }?>" >

            <a href="javascript:;">

            <i class="icon-table"></i> 

            <span class="title">Membership Plans</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

                <li class=""><a href="list_plans2.php">Plan List</a></li>	              

            </ul>

        </li>

        

        <li class="has-sub<?php if($url[3]=='list_contents.php' || $url[2]=='add_new_content.php' || $url_new[0]=='add_new_content.php' || $url[3]=='home_steps.php' || $url[2]=='home_steps.php' || $url[3]=='home_content.php' || $url[2]=='home_content.php'){?> active<?php }?> ">

                    <a href="javascript:;">

            <i class="icon-bookmark-empty"></i> 

            <span class="title">CMS</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

               <li class="<?php if($url[3]=='list_contents.php' || $url[2]=='add_new_content.php'){?>active<?php }?>">

                            <a href="list_contents.php">Show All</a>

                </li>

                 <li class="<?php if($url[3]=='home_steps.php' || $url[2]=='home_steps.php'){?>active<?php }?>">

                            <a href="home_steps.php">Home Steps</a>

                </li>

                <li class="<?php if($url[3]=='home_content.php' || $url[2]=='home_content.php'){?>active<?php }?>">

                            <a href="home_content.php">Home Content</a>

                </li>

               <?php /*?><li class="<?php if($url[3]=='add_new_content.php' || $url[2]=='add_new_content.php'){?>active<?php }?>">

                            <a href="add_new_content.php">Add New</a>

               </li><?php */?>

                                                  

            </ul>

        </li>

        <li class="has-sub<?php if($url[3]=='list_quick_tour.php' || $url_new[0]=='add_quick_tour.php'){?> active<?php }?> ">

                    <a href="javascript:;">

                        <i class="icon-cog"></i> 

            <span class="title">Quick Tour</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

               <li class="<?php if($url[3]=='list_quick_tour.php' || $url[2]=='list_quick_tour.php'){?>active<?php }?>">

                            <a href="list_quick_tour.php">List Quick Tour</a>

                </li>

                 <li class="<?php if($url[3]=='add_quick_tour.php' || $url[2]=='add_quick_tour.php'){?>active<?php }?>">

                            <a href="add_quick_tour.php">Add Quick Tour</a>

                </li>

               <?php /*?><li class="<?php if($url[3]=='add_new_content.php' || $url[2]=='add_new_content.php'){?>active<?php }?>">

                            <a href="add_new_content.php">Add New</a>

               </li><?php */?>

                                                  

            </ul>

        </li>

        <?php /*?><li class="<?php if($url[3]=='list_advertisements.php'  || $url[2]=='list_advertisements.php' || $url_new[0]=='list_advertisements.php' || $url[2]=='add_new_advertisement.php' || $url_new[0]=='add_new_advertisement.php' || $url[3]=='add_new_advertisement.php'){?> active<?php }?>" >

            <a href="javascript:;">

            <i class="icon-gift"></i> 

            <span class="title">Advertisements</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

                <li class=""><a href="list_advertisements.php">Advertisements List</a></li>	              

            </ul>

        </li>

		<li class="<?php if($url[3]=='list_newsletter.php' || $url[2]=='list_newsletter.php' || $url_new[0]=='list_newsletter.php' || $url[2]=='send_newsletter.php' || $url[3]=='send_newsletter.php'){?> active<?php }?>" >

            <a href="javascript:;">

            <i class="icon-table"></i> 

            <span class="title">Newsletter</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

			   <li class="<?php if($url[3]=='list_newsletter.php' || $url[2]=='list_newsletter.php'){?>active<?php }?>"><a href="list_newsletter.php">Newsletter List</a></li>

            </ul>

        </li>

		<li class="<?php 

						if($url[3]=='member_reports.php' || $url[2]=='member_reports.php' || 

						   $url_new[0]=='member_reports.php' || $url[2]=='member_reports.php' || 

						   $url[3]=='member_reports.php'){?> active<?php }?>" >

            <a href="javascript:;">

                <i class="icon-bookmark-empty"></i>

                <span class="title">Reports</span>

                <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

				<li class="<?php if($url[3]=='member_reports.php' || $url[2]=='member_reports.php'){?>active<?php }?>"><a href="member_reports.php">Show All</a></li>

            </ul>

        </li>

		<?php */?>

        

        <li class="<?php if($url[3]=='list_advertise.php'  || $url[2]=='list_advertise.php' || $url_new[0]=='list_advertise.php' || $url[2]=='add_new_advertise.php' || $url_new[0]=='add_new_advertise.php' || $url[3]=='add_new_advertise.php'){?> active<?php }?>" >

            <a href="javascript:;">

            <i class="icon-gift"></i> 

            <span class="title">Advertise</span>

            <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

                <li class=""><a href="list_advertise.php">Advertise List</a></li>	              

            </ul>

        </li>

        

        <li class="<?php 

						if($url[3]=='list_seo.php' || $url[2]=='list_seo.php' || 

						   $url_new[0]=='list_seo.php' || $url[2]=='list_seo.php' || 

						   $url[3]=='list_seo.php'){?> active<?php }?>" >

            <a href="javascript:;">

                <i class="icon-bar-chart"></i>

                <span class="title">SEO</span>

                <span class="arrow "></span>

            </a>

            <ul class="sub-menu">

				<li class="<?php if($url[3]=='list_seo.php' || $url[2]=='list_seo.php'){?>active<?php }?>"><a href="list_seo.php">List SEO</a></li>

            </ul>

        </li>

        

        

        

        

        

        <!-- BEGIN FRONT DEMO -->

        <!-- END FRONT DEMO -->

    </ul>

    <!-- END SIDEBAR MENU -->

</div>