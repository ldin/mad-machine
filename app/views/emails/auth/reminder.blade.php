<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Восстановление пароля</h2>

		<div>
                    Что бы сбросить пароль перейдите: {{ URL::to('password/reset', array($token)) }}.<br/>
                    Срок действия ссылки истекает через {{ Config::get('auth.reminder.expire', 60) }} минут.
		</div>
	</body>
</html>
