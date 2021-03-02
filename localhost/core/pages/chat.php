<?
$acc = ((isset(Request::$URL_PARTS[2]) && is_numeric(Request::$URL_PARTS[2])) ? Request::$URL_PARTS[2] : 0);
if (Request::$METHOD == "POST") {
    $message = getpost("send");
    if (strlen($message) > 0)
        chat::sendMessageTo(session::isAuthorized(), $acc, $message);
}
?>
<div class="col-md-12 separator-in ">
    <div class="card h-100 lite_shadow">
        <div class="mobile-screen h-100 ">
            <div class="row">
                <div class="col-md-4 split_content chat_c_list for-desktop">
                    <input class="no-out data-search dialog-filter" type="text" placeholder="Поиск" name="query" aria-label="Search">
                    <div class="dialogs">
                        <?
                        $inuq = array();
                        $dialogs = (chat::getChatsWith($acc));
                        foreach ($dialogs as $key => $value) {
                            if(!isset($inuq[$value['sender_id']]) && $value['sender_id']!=session::$current_session_id)
                            {
                                $account = $value['sender_id'];
                                $to = $value['receiver_id'];
                                $from = $value['sender_id'];
                            }
                            else
                            if(!isset($inuq[$value['receiver_id']]) && $value['receiver_id']!=session::$current_session_id)
                            {
                                $account = $value['receiver_id'];                            
                                $to = $value['receiver_id'];
                                $from = $value['sender_id'];
                            }
                            
                            if(isset($account))
                            if(!isset($inuq[$account])) {
                                    $inuq[$account] = '';
                                ?>

                                <a class="hook" href="/im/<?= $account ?>">
                                    <div class="dlg <?= $acc == $account ? 'active' : '' ?> no-out" tabindex="1" >

                                        <div class="dlg-img">

                                            <img class="rounded-circle" src="<?= getimg('/core/storage/profile/' . $account . '/main.jpg', 220, 220); ?>"/>

                                        </div>
                                        <div class="dlg-span nwrap">
                                            <span><?= account::getAccInfo($account)['name'] . ' ' . account::getAccInfo($account)['surname']; ?></span><span class="fright"><?=HumanDatePrecise(chat::getLastMessageId($from,$to)['time']);?></span><br>
                                            <p><?=$from==session::$current_session_id?'Вы: ':''?><?=chat::getLastMessageId($from,$to)['message'];?></p>
                                        </div>

                                    </div>
                                </a>
                                <?
                            }
                        }
                        ?>


                    </div>
                </div>


                <div class="col-md-8 msg_right">

<?
$messages = chat::getMessagesWith($acc);
if ($acc > 0) {
    $accinfo = account::getAccInfo($acc);
    echo '
                                <a class="hook" href="/id/'.$acc.'">
				<div class="form-control">
					<img class="rounded-circle" src="' . getimg('/core/storage/profile/' . $acc . '/main.jpg', 90, 90) . '"/>
					<span class="nwrap">' . $accinfo['name'] . ' ' . $accinfo['surname'] . '</span>
					<span class="nwrap"> был(а) ' . HumanDatePrecise($accinfo['on_time']) . '</span>
				</div>
                                </a>
				<div class="split_content chat_list">
				';


    foreach ($messages as $key => $value) {
        ?>
                            <div class="chat_msg">
                                <div class="chat_<?= ($value['receiver_id'] == $acc ? 'out' : 'in'); ?>">
                                    <p><?= $value['message']; ?></p>
                                    <span><?= HumanDatePrecise($value['time']); ?></span>
                                </div>
                            </div>

        <?
    }
    echo '</div>
                          
                        <form id="send" method="post">
  				  <input id="msg_input"  autocomplete="off" class="inp_button no-out data-search dlg_input" type="text" placeholder="Написать сообщение" name="send" aria-label="отправить">
                                  <div class="inp_button for-desktop">
                                    
                                    <i class="fa fa-smile-o smile_trigger">
                                        <div class="smiles-bar lite_shadow split_content">
                                            <div class=smile>😀</div>
                                            <div class=smile>😃</div>
                                            <div class=smile>😄</div>
                                            <div class=smile>😁</div>
                                            <div class=smile>😆</div>
                                            <div class=smile>😅</div>
                                            <div class=smile>😂</div>
                                            <div class=smile>🙂</div>
                                            <div class=smile>🤗</div>
                                            <div class=smile>🤔</div>
                                            <div class=smile>😐</div>
                                            <div class=smile>😶</div>
                                            <div class=smile>🙄</div>
                                            <div class=smile>😏 </div>
                                            <div class=smile>😋</div>
                                            <div class=smile>😉</div>
                                            <div class=smile>😎</div>
                                            <div class=smile>😍</div>
                                            <div class=smile>😘 </div>
                                            <div class=smile>😣</div>
                                            <div class=smile>😥</div>
                                            <div class=smile>😮</div>
                                            <div class=smile>🤐</div>
                                            <div class=smile>😯</div>
                                            <div class=smile>😪</div>
                                            <div class=smile>😫</div>
                                            <div class=smile>😴</div>
                                            <div class=smile>😌</div>
                                            <div class=smile>😛</div>
                                            <div class=smile>😜</div>
                                            <div class=smile>😝</div>
                                            <div class=smile>😒 </div>
                                            <div class=smile>😓</div>
                                            <div class=smile>😔</div>
                                            <div class=smile>😕</div>    
                                            <div class=smile>🙃</div>
                                            <div class=smile>😲</div>
                                            <div class=smile>☹</div>
                                            <div class=smile>🙁</div>
                                            <div class=smile>😖</div>
                                            <div class=smile>😞</div>
                                            <div class=smile>😟</div>
                                            <div class=smile>😤</div>    
                                            <div class=smile>😢</div>
                                            <div class=smile>😭 </div>
                                            <div class=smile>😦</div>
                                            <div class=smile>😧</div>
                                            <div class=smile>😨</div>
                                            <div class=smile>😩</div>
                                            <div class=smile>😬</div>
                                            <div class=smile>😰</div>    
                                            <div class=smile>😱</div>
                                            <div class=smile>😡</div>
                                            <div class=smile>😷</div>
                                            <div class=smile>🤒</div>
                                            <div class=smile>🤕</div>
                                            <div class=smile>🤓</div> 
                                            <div class=smile>😈</div> 
                                            <div class=smile>👿</div> 
                                            <div class=smile>👹</div> 
                                            <div class=smile>💀</div> 
                                            <div class=smile>👻</div> 
                                            <div class=smile>👽</div> 
                                            <div class=smile>💩</div>                                             
</div>  </i>
                                    <i class="fa fa-paper-plane"></i>
                                  </div>
  			  </form>';
} else
    echo '<span class="full-width centered hcenter">Выберите диалог</span></div>';
?>




                </div>

            </div>

        </div><!--.row -->
    </div><!--.card-body-->
</div><!--.card-->
</div>

<?
JS::$additional = '
function scrolldown(){
	var element = document.getElementsByClassName("chat_list")[0];
	if(element)
	element.scrollTop = element.scrollHeight;
}
scrolldown();
$("#msg_input").focus();
';

JS::$additional .= "
		  
  	      $( '.dialogs' ).searchable({
  	          searchField: '.dialog-filter',
  	          selector: '.dlg',
  	          childSelector: '.dlg-span',
  			  limits: 20
  	      });
		  
		  function update()
		  {
			$('.dlg_input').val('');
	  		$.get('/im/" . $acc . "/ajax', function( my_var ) {
	  			/*$( '.chat_list' ).html($(my_var).find('.chat_list').html());*/
                                $( '#page-content' ).html(my_var);
				scrolldown();
	  		});
		  }
                /*
                if(timerId!=='undefined')clearInterval(timerId);
                var timerId = setInterval(function() {
	  		$.get('/im/" . $acc . "/ajax', function( my_var ) {
                                $( '.chat_list' ).html($(my_var).find('.chat_list').html());
                                scrolldown();
	  		});                  
                }, 1000);
		*/
                  $('.smile' ).click(function(e) {
                    $('.dlg_input').val($('.dlg_input').val() + $(this).html());
                  });
                  
		  $('.dlg_input').keypress(function (e) {
		    if (e.which == 13) {
                          $('#send').ajaxSubmit({success:update});
			  return false;
		    }
		  });
		  ";
?>