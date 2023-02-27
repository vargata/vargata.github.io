				<!-- News -->
				<div class="news_container">		
					<div class="news_header">
						<h1>Latest News</h1>
						<a href="#" class="visible_viewall">View All&nbsp;</a>
					</div>

<?php
    $counter = 1;
    $db = new db();    
    $db->connect_db();
    $db->add_query("getNews", "CALL getNews()");
    $results = $db->get_Data("getNews");
    foreach($results as $row){?>
        
            		<div class="news_content<?php echo $counter; ?>">
						<div class="img_header">
							<a href="#"><img src="img/news/<?php echo $row["news_img"]; ?>" alt="Netmatters End-Of-Year Staff Awards 2022 "/></a>
							<a href="#" class="img_button"><?php echo $row["category_name"]; ?></a>
						</div>
						<a href="#" class="news_block">
							<div>
								<h3><?php echo $row["news_title"]; for($i = strlen($row["news_title"]); $i < 50; $i++) echo "&nbsp;"; ?></h3>
								<p><?php echo $row["news_content"]; ?></p>
								<span>Read more</span>
							</div>
						</a>
						<a href="#" class="news_footer">
							<img alt="" src="img/news/netmatters-ltd-VXAv.png" />
							<div>
								<h4><?php echo $row["poster_name"]; ?></h4>
								<p><?php echo $row["news_date"]; ?></p>
							</div>
						</a>
					</div>

<?php
        $counter++;
    }
    $db->disconnect_db();
?>
					<a href="#" class="hidden_viewall">View All&nbsp;</a>
				</div>
				<!-- end of News -->
