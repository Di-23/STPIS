<div class="col-md-8 modile-card">	
		<?
		$posts = post::getFriendsPosts(session::isAuthorized());
		if($posts)
			foreach ($posts as $key => $value) { 
				$accinfo = account::getAccInfo($value['autor']);
                                echo view::getPost($value,$accinfo);
		 	 	}
			  ?>
		</div>