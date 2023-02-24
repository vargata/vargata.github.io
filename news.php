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
							<a href="#"><img src="img/news/<?php echo $row[1]; ?>" alt="Netmatters End-Of-Year Staff Awards 2022 "/></a>
							<a href="#" class="img_button"><?php echo $row[0]; ?></a>
						</div>
						<a href="#" class="news_block">
							<div>
								<h3><?php echo $row[2]; ?></h3>
								<p><?php echo $row[3]; ?></p>
								<span>Read more</span>
							</div>
						</a>
						<a href="#" class="news_footer">
							<img alt="" src="img/news/netmatters-ltd-VXAv.png" />
							<div>
								<h4><?php echo $row[5]; ?></h4>
								<p><?php echo $row[4]; ?></p>
							</div>
						</a>
					</div>

<?php
        $counter++;
    }
?>
					<a href="#" class="hidden_viewall">View All&nbsp;</a>
				</div>
				<!-- end of News -->
