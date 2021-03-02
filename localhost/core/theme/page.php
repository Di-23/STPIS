<?
class Page{
	public static function show_menu($bool){
		echo $bool?'
		  <div class="col-md-3 for-desktop separator-in-top modile-card">
		    <div class="card lite_shadow left-menu list-group" id="list-tab" role="tablist">
			  <a class="hook list-group-item list-group-item-action" href="/id" ><i class="fa fa-user"></i> Профиль</a>
		      <a class="hook list-group-item list-group-item-action" href="/feed" ><i class="fa fa-newspaper-o"></i> Новости</a>
		      <a class="hook list-group-item list-group-item-action" href="/im"><i class="fa fa-comment"></i> Сообщения</a>
		      <a class="hook list-group-item list-group-item-action" href="/friends"><i class="fa fa-users"></i> Друзья<span class="badge badge-icons fright">'.friends::friendsCount(session::isAuthorized()).'</span></a>
		      <a class="hook list-group-item list-group-item-action" href="/music"><i class="fa fa-music"></i> Музыка</a>
			  <a class="list-group-item list-group-item-action" href="/logout"><i class="fa fa-sign-out"></i> Выйти</a>
		    </div>
			

			
			
			<footer>
				<hr class="featurette-divider">
		        <p>&copy; 2018 ВТеме, Inc. &middot; <br><a class="link" href="/team">О Команде</a></p>
		    </footer>
		  </div>
		  <div class="col-md-9">
		  ':'<div class="col-md-12">';
	}
	
}	
?>