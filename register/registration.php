<?php 
	require "db.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Регистрация</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<div class="container">

	<?php 
		$data = $_POST;
		if(isset($data['do_signup'])){

			$errors = array();
			if (trim($data['login']) == '') {
				$errors[] = 'Введите логин!';
			}

			if (trim($data['email']) == '') {
				$errors[] = 'Введите Email!';
			}

			if ($data['password'] == '') {
				$errors[] = 'Введите пароль!';
			}

			if ($data['password_2'] == '') {
				$errors[] = 'Введите пароль ещё раз!';
			}

			if ($data['password_2'] != $data['password']) {
				$errors[] = 'Повторный пароль введён неверно!';
			}

			if (R::count('users', "login = ?", array($data['login'])) > 0 ) {
				$errors[] = 'Логин уже занят!';
			}

			if (R::count('users', "email = ?", array($data['email'])) > 0 ) {
				$errors[] = 'Email уже зарегестрирован!';
			}


			if(empty($errors) ){
				$user = R::dispense('users');
				$user->login = $data['login'];
				$user->email = $data['email'];
				$user->password = password_hash($data['password'], PASSWORD_DEFAULT);

				R::store($user);
				echo '<div class="success">Вы зарегистрировались можете перейти на <a href="/">главную страницу</a></div>';

			}else{
				echo '<div class="errors">'.array_shift($errors).'</div>';
			}

		}
	?>
		
		<h1>Форма регистрации</h1>
		<form action="registration.php" method="POST">
			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" value="<?php echo @$data['login']; ?>">
			<input type="email" class="form-control" name="email" id="email" placeholder="Введите Email" value="<?php echo @$data['email']; ?>">
			<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
			<input type="password" class="form-control" name="password_2" id="password_2" placeholder="Введите пароль ещё раз">
			<button class="btn" type="submit" name="do_signup">Зарегистрироваться</button>
		</form>
	</div>
</body>
</html>