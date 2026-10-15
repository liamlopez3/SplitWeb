<?php

function e(?string $text): string
{
	return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}
