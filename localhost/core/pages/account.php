<?
try{
$acc = Account::getAccInfo((isset(Request::$URL_PARTS[2]) && is_numeric(Request::$URL_PARTS[2]))?Request::$URL_PARTS[2]:session::isAuthorized());
}catch(MException $ex){}
if(isset($acc))
{
?>
          <div class="col-md-4 mobile-card separator-in-top">
			  <div class="card centered lite_shadow">
				<div class="card-body">
					<div>
						<div class="lite_shadow avatar avatar-mobile fleft <?=account::isOnline($acc['id'])?'online':'';?>">
							<img src="<?=getimg('/core/storage/profile/'.$acc['id'].'/main.jpg',512,512,true);?>"/>
						</div>
						<div class="for-mobile lefted">
							<span class=""><b><?=$acc['name'].' '.$acc['surname']?></b></span>
						</div>
						
						<div class="form-group">
							<button href="/im/<?=$acc['id'];?>" type="submit" class="lite_shadow hook btn btn-info full-width">Написать</button>
						</div>
						<div class="">
							<button type="submit" class="lite_shadow hook btn btn-primary full-width">Добавить в друзья</button>
						</div>
					</div>
				</div>
			  </div>
          </div>
		  
		  <div class="col-md-8 mobile-card separator-in-top">
			<div class="card lite_shadow">
				<div class="card-body">
					<span class="fright"><?=account::isOnline($acc['id'])?'Online':'заходил(а) '.HumanDatePrecise($acc['on_time']);?></span>
					<p class="heading-text for-desktop"><?=$acc['name'].' '.$acc['surname']?></p>
					<p>статус: <?=$acc['status'];?></p>
					<hr class="featurette-divider">
					<div class="row">
						<div class="col-6">
							<p>День рождения:</p>
							<p>Город:</p>
							<p>Место учебы:</p>
						</div>
						<div class="col-6">
							<p class="link">скрыт</p>
							<p class="link">Минск</p>
							<p class="link">БГУИр (бывш. МРТИ)</p>
						</div>
					</div>
					<hr class="featurette-divider">
					<div class="row centered">
						<div class="col-3">
							<h2 class="profile-counter"><?=friends::friendsCount($acc['id']);?></h2>
							<p class="nwrap">Друзей</p>
						</div>
						<div class="col-3">
							<h2 class="profile-counter">1</h2>
							<p class="nwrap">Фотографии</p>						
						</div>
						
						<div class="col-3">
							<h2 class="profile-counter">0</h2>
							<p class="nwrap">Аудиозаписей</p>						
						</div>
						<div class="col-3">
							<h2 class="profile-counter"><?=friends::unsubmittedCount($acc['id']);?></h2>
							<p class="nwrap">Подписчиков</p>						
						</div>
					</div>
				</div>
			  </div>
		  </div>
		  
		<?
		$posts = post::getPostsById($acc['id']);
setlocale(LC_ALL, 'russian');
		if(count($posts)>0)
			foreach ($posts as $key => $value) { 
				$accinfo = account::getAccInfo($value['autor']);
		?>
		<div class="col-12">
			 <?=view::getPost($value,$accinfo);?>
			 </div>
			  <?
		 	 	}
			  ?>
		<div class="col-md-4 mobile-card separator-top"><!-- friends -->
			  <div class="card centered lite_shadow">
				<div class="card-body">
					<p>Друзья <span><?=friends::friendsCount($acc['id']);?></span></p>
					<div class="row">
			<?
				$data = friends::getFriendsIds($acc['id']);
				if($data)
					foreach ($data as $key => $value) {
						$accinfo = account::getAccInfo($value);
						echo '<div class="col-xs-4 col-sm-4 col-lg-4 col-md-6 col-3">
							<a href="/id/'.$value.'" class="hook avatar">
								<img class="lite_shadow rounded-circle" src="'.getimg('/core/storage/profile/'.$value.'/main.jpg',220,220).'"/>
								<p class="link">'.$accinfo['name'].'</p>
							</a>
						</div>';
				}
			?>
					</div>
				</div>
			  </div>
          </div>
<? 
}
else
	require_once 'notfound.php';
?>