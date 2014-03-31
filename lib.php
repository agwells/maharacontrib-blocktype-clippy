<?php
/**
 * Creative Commons License Block type for Mahara
 *
 * @package    mahara
 * @subpackage blocktype-creativecommons
 * @author     Francois Marier <francois@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 *
 */

defined('INTERNAL') || die();

class PluginBlocktypeClippy extends PluginBlocktype {
	public static function get_title() {
		return get_string('title', 'blocktype.clippy');
	}

	public static function get_description() {
		return get_string('description', 'blocktype.clippy');
	}

	public static function get_categories() {
		return array('general');
	}

	public static function hide_title_on_empty_content() {
		return true;
	}

	public static function render_instance(BlockInstance $instance, $editing=false) {
		if (!$editing) {
			return '';
		}
		else {
			$configdata = $instance->get('configdata');
			if (isset($configdata['agent'])) {
				$agent = $configdata['agent'];
			}
			else {
				$agent = 'Clippy';
			}
			$agentname = get_string("agentname{$agent}", 'blocktype.clippy');
			return get_string('youhaveselectedthisagent', 'blocktype.clippy', $agentname);
		}
	}

	public static function artefactchooser_element($default = null) {
		return false;
	}

	public static function single_only() {
		return true;
	}

	public static function get_instance_javascript(BlockInstance $bi) {
		$bid = $bi->get('id');
		$configdata = $bi->get('configdata');
		if (array_key_exists('agent', $configdata)) {
    		$agent = $configdata['agent'];
    		// Make sure it's a legal agent
    		if (!array_key_exists($agent, self::available_agents())) {
    			$agent = 'Clippy';
    		}
		}
		else {
		    $agent = 'Clippy';
		}

		$mouseovermsgs = array(
		        "input.deletebutton[name=\"action_removeblockinstance_id_{$bid}\"]" => get_string('msgdeleteme', 'blocktype.clippy'),
		        "input.deletebutton[name^=\"action_removeblockinstance_id_\"][name!=\"action_removeblockinstance_id_{$bid}\"]" => get_string('msgdeleteblock', 'blocktype.clippy'),
		        "input.configurebutton[name^=\"action_configureblockinstance_id_\"]" => get_string('msgconfigblock', 'blocktype.clippy'),
		        "div#view-wizard-controls input" => get_string('msgdoneediting', 'blocktype.clippy'),
		        "#content-editor-foldable" => get_string('msgaddblock', 'blocktype.clippy'),
		        "li.sharepage" => get_string('msgsharepage', 'blocktype.clippy'),
		        "li.displaypage" => get_string('msgdisplaypage', 'blocktype.clippy'),
		        "li.displaypage" => get_string('msgdisplaypage', 'blocktype.clippy'),
		        "a.editview" => get_string('msgeditpage', 'blocktype.clippy'),
		        "div.userviewrbuttons > a" => get_string('msgeditpage', 'blocktype.clippy'),
		        "a#toggle_watchlist_link" => get_string('msgaddtowatchlist', 'blocktype.clippy'),
		        "a#print_link" => get_string('msgprint', 'blocktype.clippy'),
		        "a#objection_link" => get_string('msgobjectionable', 'blocktype.clippy'),
		        "a#add_feedback_link" => get_string('msgplacefeedback', 'blocktype.clippy'),
		        "h1#site-logo > a" => get_string('msgsitelogo', 'blocktype.clippy'),
		        "a.dashboard" => get_string('msgdashboard', 'blocktype.clippy'),
		        "a.content" => get_string('msgcontent', 'blocktype.clippy'),
		        "a.myportfolio" => get_string('msgportfolio', 'blocktype.clippy'),
		        "a.groups" => get_string('msggroups', 'blocktype.clippy'),
		        "a.admin-site" => get_string('msgadmin', 'blocktype.clippy'),
		        "li.identity > a" => get_string('msggotoprofile', 'blocktype.clippy'),
		        "li.settings > a" => get_string('msggotosettings', 'blocktype.clippy'),
		        "li.btn-logout > a" => get_string('msglogout', 'blocktype.clippy'),
		        "li.loginlink > a" => get_string('msglogin', 'blocktype.clippy'),
		        "div#footer-nav" => get_string('msgfooternav', 'blocktype.clippy'),
		        "div.blockinstance-header > h2.title > a" => get_string('msgartefactdetail', 'blocktype.clippy'),
		        "textarea[id^=\"wallpost_\"]" => get_string('msgwallpostwriting', 'blocktype.clippy'),
		        "input.checkbox[id^=\"wallpost_\"]" => get_string('msgwallpostprivate', 'blocktype.clippy'),
		        "div#powered-by > a" => get_string('msgmaharaorglink', 'blocktype.clippy'),
		);

		$eventjs = '';
		foreach ($mouseovermsgs as $selector => $speak) {
		    $speak = str_replace('"', '\"', $speak);
		    $eventjs .= <<<JS
			    jQuery('{$selector}').mouseover(
			    		function(event){
                            clippyblock.stop();
                            clippyblock.animate();
			    			clippyblock.speak(
			    				"{$speak}"
							);
						}
				);
JS;
		}

		return array(
				array(
						'file'   => 'js/clippy/build/clippy.js',
				),
				array(
						'file' => 'js/clippyblock.js',
						'initjs' => <<<JS
							clippyblock.switchagent('$agent');
				            $eventjs
JS
				)
		);
	}

	public static function has_instance_config() {
		return true;
	}

	public static function instance_config_form(BlockInstance $instance) {
		$configdata = $instance->get('configdata');
		return array(
				'agent' => array(
					'title' => 'Agent',
					'type' => 'select',
					'options' => self::available_agents(),
					'defaultvalue' => !empty($configdata['agent']) ? $configdata['agent'] : 'Clippy',
					'required' => true,
			)
		);
	}

	/**
	 * Returns a list of the available agents, and the lang strings for their names.
	 * The keys are the agents, the values are the lang names. The array will be in order
	 * by alphabetical order of the lang names
	 *
	 * @return multitype:string
	 */
	public static function available_agents() {
		$agents = array(
			'Bonzi',
			'Clippy',
			'F1',
			'Genie',
			'Genius',
			'Links',
			'Merlin',
			'Peedy',
			'Rocky',
			'Rover',
		);
		$return = array();
		foreach($agents as $agent) {
			$return[$agent] = get_string("agentname{$agent}", 'blocktype.clippy');
		}
		asort($return);
		return $return;
	}
}
