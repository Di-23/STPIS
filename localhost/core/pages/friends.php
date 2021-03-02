<?
	$acc = ((isset(Request::$URL_PARTS[2]) && is_numeric(Request::$URL_PARTS[2]))?Request::$URL_PARTS[2]:session::isAuthorized());
	if(isset($acc))
	{
?>
		  <div class="col-md-12 modile-card separator-in-top">
			<div class="card lite_shadow ">
				<div class="friend-list">
				<?
				$data = friends::getFriendsIds($acc);
				echo '<input class="no-out data-search" type="text" placeholder="Поиск" name="query" aria-label="Search">';
				if($data){
					foreach ($data as $key => $value) { 
						echo '
					<div class="dflex block-item">
                                            <a class="hook" href="/id/'.$value.'">

                                                    <div class="fleft avatar feed-logo">
                                                            <img class="'.(account::isOnline($value)?'online':'').' rounded-circle lite_shadow" src="'.getimg('/core/storage/profile/'.$value.'/main.jpg',220,220).'"/>
                                                    </div>
                                                    <div class="music_card_lefted">
                                                            <span class="heading-text post_author nwrap">'.account::getAccInfo($value)['name'].' '.account::getAccInfo($value)['surname'].'</span><br>
                                                            <a class="link hook" href="/im/'.$value.'">Написать сообщение</a>
                                                    </div>
                                            </a>
					</div>
					
					';
					}
				}else
					echo 'Список пуст';
					?>
					
					
				</div>
			  </div>
		  </div>
		  <?
		  JS::$additional = "
			      $( '.friend-list' ).searchable({
			          searchField: '.data-search',
			          selector: '.dflex',
			          childSelector: '.nwrap',
					  limits: 50
			      })";
			  ?>
<?}
else
	echo "Not found";
?>