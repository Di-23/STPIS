
<div class="col-md-12 separator-in-top">
	<div class="card lite_shadow split_content mobile-screen">
				<?
				echo '<input class="no-out data-search" type="text" placeholder="Поиск" name="query" aria-label="Search">';
				foreach( audio::listFiles() as $index => $file )
				if(endsWith($file,'.mp3'))
				{
				$mp3 = new audio($file);
				?>
				
				
						<div class="dflex block-item" record="<?=$index?>">
								<img id="album" class="lite_shadow fleft blind_label avatar rounded-circle feed-logo" src="<?=getimg($mp3->getData()[3],220,220,true,'/core/theme/assets/media/system/music.jpg');?>">
								<audio class='player_audio' preload="none" src='/core/storage/media/<?=$file?>'></audio>
								<div class="blind_label feed-logo rounded-circle audio_row_cover_back"></div>
								<div class="blind_label feed-logo rounded-circle audio_row"></div>							
								
							<div class="music_card_lefted nwrap">
							<!--
									<div class="dropdown fright dropleft">
									  <div class=" dropdown-toggle ui_actions_menu_icons" data-toggle="dropdown">
									  </div>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Пожаловаться</a>
										<a class="dropdown-item" href="#">Отправить другу</a>
										<a class="dropdown-item" href="#">Скопировать к себе</a>
									  </div>
									</div>	
							-->
								<span class="heading-text post_author"><?=$mp3->getData()[0];?></span>
								<p><?=$mp3->getData()[1];?><b class="fright"><?=$mp3->getData()[2];?></b></p>
							</div>
						</div>						
				
				<?}?>
	</div>
</div>

	  <?
  JS::$additional = "
	      $( '.card' ).searchable({
	          searchField: '.data-search',
	          selector: '.dflex',
	          childSelector: '.nwrap',
			  limits: 20
	      })";
	  ?>