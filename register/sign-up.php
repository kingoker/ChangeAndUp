<?php 
	require "db.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<title>Вход на Курс</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<div class="container">

		<?php 

		$data = $_POST;

		if ( isset($data['do_login'])) {
			$errors = array();
			$user = R::findOne('users', 'login = ?', array($data['login']));
			if ($user) {
				if(password_verify($data['password'], $user->password)){
					$_SESSION['logged_user'] = $user;
					echo '<div class="success">Вы авторизовались можете перейти к <a href="../Courses/index.php">Курсам</a></div>';
				}else{
					$errors[] = 'Неверный пароль!';
				}
			}else{
				$errors[] = 'Неверный логин!';
			}

			if( ! empty($errors) ){
				echo '<div class="errors">'.array_shift($errors).'</div>';
			}
		}
		?>

		<h1>Форма Авторизации</h1>
		<form action="sign-up.php" method="POST">
			<input type="text" class="form-control" name="login" placeholder="Введите логин" value="<?php echo @$data['login']; ?>">
			<input type="password" class="form-control" name="password" placeholder="Введите пароль">
			<button class="btn" type="submit" name="do_login">Войти</button>
		</form>
	</div>
</body>
</html>