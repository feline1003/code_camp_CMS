<?php
/**
 * SBTT Admin Menu Controller class
 *
 * @author Joe Sexton <joe@josephmsexton.com>
 * @package WordPress
 * @subpackage scroll-back-to-top
 */
if ( !class_exists( 'SBTT_AdminMenuController' ) ){
class SBTT_AdminMenuController extends JmsAdminSettingsPage {

	/**
	 * register Wordpress actions and filters
	 */
	protected function _init() {

		$options = new SBTT_Options();
		$this->addOptionsPage(
			__( 'Scroll Back to Top Settings', $this->textDomain() ),
			__( 'Scroll Back to Top', $this->textDomain() ),
			$options
		);
	}

	/**
	 * enqueue admin scripts
	 */
	public function enqueueAdminScripts() {

		$this->enqueueScript( 'sbtt-admin', 'admin' );
	}

	/**
	 * enqueue admin styles
	 */
	public function enqueueAdminStyles() {
		$this->enqueueCdnStyle( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
	}

	/**
	 * on plugin activation init default options
	 */
	public function onActivation() {

		$this->options->initDefaultOptions();
	}
}
}