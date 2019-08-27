<?php ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../index.php"><i class="fa fa-fw fa-home"></i> View Site</a>
                    </li>
                    
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-folder-open"></i> Posts <i class="fa fa-fw 
fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
							<li>
                                <a href="admin-post.php"><i class="fa fa-book"></i> View All Posts</a>
                            </li>
							
							<li>
                                <a href="admin-post.php?action=new"><i class="fa fa-keyboard-o"></i> New Post</a>
                            </li>
                            
						</ul>
                    </li>
					
					<li>
						<a href="admin-categories.php"><i class="fa fa-fw fa-edit"></i> Add/Edit Categories</a>
					</li>
					
					<li>
						<a href="admin-comments.php"><i class="fa fa-fw fa-comments"></i> Manage Comments</a>
					</li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-user"></i> Users <i class="fa fa-fw 
fa-caret-down"></i></a>
                        <ul id="users_dropdown" class="collapse">
							<li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> New User</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-users"></i> View All Users</a>
                            </li>
                        </ul>
                    </li>
                    
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#settings_dropdown"><i class="fa fa-cogs"></i> Settings <i class="fa fa-fw 
fa-caret-down"></i></a>
                        <ul id="settings_dropdown" class="collapse">
							<li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Placeholder</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-users"></i> Placeholder</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
