<?php
/**
 * Trigger this file on Plugin uninstall
 *
 * @package  ContactForm
 */

class ContactFormActivate
{
	public static function activate() {
		flush_rewrite_rules();
	}
}