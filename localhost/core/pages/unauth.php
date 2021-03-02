          <div class="col-md-8 separator-in-top">
            <h2 class="featurette-heading">Социальная сеть <span class="text-muted">ВТеме</span></h2>
            <p class="lead">Будь в теме! Зарегистрируйся прямо сейчас!</p>
          </div>
          <div class="col-md-4 separator-top modile-card">
		  <div class="card lite_shadow">
			  <div class="card-body card-auth">
					<form method="POST" action="" role="form" autocomplete="off">
					  <div class="form-group">
						<input autocomplete="false" type="text" class="no-out form-control form-input <?if (isset(Request::$AUTHERROR))echo 'is-invalid';?>" name="login" id="login" placeholder="Email">
					  </div>
					  <div class="form-group">
						<input autocomplete="false" type="password" class="no-out form-control form-input <?if (isset(Request::$AUTHERROR))echo 'is-invalid';?>" name="password" id="password" placeholder="пароль">
					  </div>
					  <?if (isset(Request::$AUTHERROR))echo "<p class=\"warn centered\">".Request::$AUTHERROR."</p>";?>
					  <button type="submit" class="btn btn-primary" name="enter" value="submit">Войти</button>
					</form>
			  </div>
			</div>
			<div class="card separator-top lite_shadow">
			  <div class="card-body card-auth">
					<form method="POST" action="/registration/" role="form" autocomplete="off">
					  <p class="lead centered"><b>Еще не в теме?</b></p>
					  <p class="centered">Скорее к нам!</p>
					  <div class="form-group">
						<input autocomplete="false" name="name" type="text" class="no-out form-control form-input" id="name" placeholder="Имя">
					  </div>
					  <div class="form-group">
						<input autocomplete="false" name="surname" type="text" class="no-out form-control form-input" id="surname" placeholder="Фамилия">
					  </div>
						<button type="submit" class="btn btn-primary full-width" name="registration">Регистрация</button>
					</form>
			
			  </div>
			</div>
          </div>