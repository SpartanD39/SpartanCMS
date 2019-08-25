<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

				<?php 
					
				?>
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
						<div class="input-group">
						<input name="searchterm" type="text" class="form-control">
						<span class="input-group-btn">
							<button name="submit" value="submit" class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
						
						</div>
					</form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
								<?php
									$sidebarCats = get_categories();
									forEach($sidebarCats as $sidebarCat) {
										echo "<li>";
										echo "<a href=\"index.php?id={$sidebarCat["cat_id"]}&view=category\">{$sidebarCat["cat_name"]}</a>";
										echo "</li>";
									}
								?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>