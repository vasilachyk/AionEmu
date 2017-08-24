<!DOCTYPE html>
<html>
	<head>
		<title>Password Reset</title>
	</head>

	<body>
		<table width="100%">
			<tbody>
				<tr>
					<td>Hi, {{ $name }}</td>
				</tr>

				<tr>
					<td>You have requested a password reset. Please click the link below in order to reset your password.</td>
				</tr>

				<tr>
					<td><a href="{{ action('Auth\AuthController@getResetPassword', $token) }}">{{ action('Auth\AuthController@getResetPassword', $token) }}</a></td>
				</tr>

				<tr>
					<td></td>
				</tr>

				<tr>
					<td>This password request will expire in {{ Settings::general()->pass_reset_expire }} {{ str_plural('minute', Settings::general()->pass_reset_expire) }}.</td>
				</tr>

				<tr>
					<td></td>
				</tr>

				<tr>
					<td>If you haven't requested a password reset, Please ignore this email.</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
