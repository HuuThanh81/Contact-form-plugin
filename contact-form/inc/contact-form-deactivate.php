<?php
/**
 * Trigger this file on Plugin uninstall
 *
 * @package  ContactForm
 */

class ContactFormDeactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
	}
}