<?php

function createUser(PDO $pdo, string $email, string $passwordHash, string $fullName, string $nickname): int
{

	$sql = 'INSERT INTO Users (email, password_hash, full_name, nickname)
		VALUES (:email, :hash, :full_name, :nickname)';
	try {
		$stmt = $pdo->prepare($sql);
		$stmt ->execute([
			':email'	=> $email,
			':hash'		=> $passwordHash,
			':full_name'	=> $fullName,
			':nickname'	=> $nickname,
		]);
		return OK;
	} catch (PDOException $e) {
		if ($e->getCode() === '23000') {
			return ERROR_USUARIO_DUPLICADO;
		}
		error_log('createUser: ' . $e->getMessage());
		return ERROR_ALTA_USUARIO;
	}
}

function findUserByEmail(PDO $pdo, string $email): ?array
{
	$stmt = $pdo->prepare('SELECT email, password_hash, full_name, nickname FROM Users WHERE email = :email');
	$stmt->execute([':email' => $email]);
	$user = $stmt->fetch();
	return $user === false ? null : $user;
}

function getAllUsers(PDO $pdo):array
{
	try{
		return $pdo->query('SELECT email, nickname FROM Users ORDER BY nickname')->fetchAll(PDO::FETCH_ASSOC);
	
	} catch (PDOException $e) {
		error_log('getAllUsers: ' . $e->getMessage());
		return [];
	}
}