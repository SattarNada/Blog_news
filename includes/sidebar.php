<div class="left side-menu" style='background:purple;'>
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu" >
                        <ul>
                        	

                            <li class="has_sub">
                                <a href="dashboard.php" class="waves-effect" style='background:purple;'><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                         
                            </li>



               


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-tag"></i> <span> Categories </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                
                                	<li><a href="addcategory.php"><i class="mdi mdi-tooltip-outline-plus"></i><span>Add Categories</span></a></li>
                                    <li><a href="managecategory.php"><i class="mdi mdi-settings"></i><span>update Categories</span></a></li>
                                </ul>
                            </li>

                 
  <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-newspaper"></i> <span> articles  </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="add-post.php"><i class="mdi mdi-tooltip-outline-plus"></i><span>Add articles</span></a></li>
                                    <li><a href="manageposts.php"><i class="mdi mdi-settings"></i><span>update articles</span></a></li>
                                     <li><a href="deleteposts.php"><i class="mdi mdi-delete"></i><span>delete articles</span></a></li>
                                </ul>
                            </li>  
                     
 
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i  class="mdi mdi-content-save-all"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <!-- <li><a href="addpages.php">Ajouter des pages</a></li> -->
                                    <?php 
                                    $query = mysqli_query($con, "select * from tblpages");
                                    while ($row = mysqli_fetch_array($query)) 
                                    { ?>
                                        <li><a href="editpages.php?id=<?php echo $row['id'] ?>"><?php echo $row['PageName']; ?></a></li> <?php 
                                     } ?>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-gmail"></i><span> messages </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="displaymsg.php"><i class="mdi mdi-monitor"> </i><span>displayin messages</span></a></li>
                                    <li><a href="deletemsg.php"><i class="mdi mdi-delete"></i><span>delete messages </span> </a></li>
                                </ul>
                            </li>
   <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-comment-multiple-outline"></i> <span> Comments  </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                  <li><a href="unapprove-comment.php"><i class="mdi mdi-comment-processing-outline"></i><span>verifying comments </span> </a></li>
                                    <li><a href="manage-comments.php"><i class="mdi mdi-comment-check"></i><span>accepting Comments</span> </a></li>
                                </ul>
                            </li>   

                        </ul>
                    </div>
                    

                </div>
                <!-- Sidebar -left -->

            </div>