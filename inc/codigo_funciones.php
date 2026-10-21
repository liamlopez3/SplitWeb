<?php

function e(?string $text): string
{
	return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

function postString(string $key): string
{
	$value = $_POST[$key] ?? '';
	return is_string($value) ? $value : '';
}
