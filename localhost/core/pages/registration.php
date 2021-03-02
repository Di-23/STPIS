         <div class="col-md-12">
			<h2 class="featurette-heading centered">Регистрация</h2>
		  <div class="card lite_shadow separator-top">
			  <div class="card-body">
					<form>
					  <div class="form-group">
						<input type="text" class="no-out form-control form-input" id="name" name="name" placeholder="Name" value="<? echo getpost("name")?>">
					  </div>
					  <div class="form-group">
						<input type="text" class="no-out form-control form-input" id="surname" name="surname" placeholder="Surname" value="<? echo getpost("surname")?>">
					  </div>
					  <div class="form-group">
						<input type="text" class="no-out form-control form-input" id="email" name="email" placeholder="Email">
					  </div>
					  <div class="form-group">
						<input type="password" class="no-out form-control form-input" id="password" name="password" placeholder="пароль">
					  </div>
					  <button type="submit" class="btn btn-primary" name="register_account">Получить код</button>
					</form>
			  </div>
			</div>
          </div>
