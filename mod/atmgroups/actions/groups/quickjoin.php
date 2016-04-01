<?php	
/**
 * Quickjoingroup
 *
 * @package ElggGroups
 */
global $CONFIG;

user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$group_guid = get_input('group_guid');

$user = get_user($user_guid);
$action = get_input('action_type');

// access bypass for getting invisible group
$ia = elgg_set_ignore_access(true);
$group = get_entity($group_guid);
elgg_set_ignore_access($ia);




if (!elgg_instanceof($group, 'group')) {
	register_error(elgg_echo('groups:featured_error'));
	forward(REFERER);
}

//get the action, is it to feature or unfeature
if ($action == "join") {
    if (groups_join_group($group, $user)) {
			system_message(elgg_echo("groups:joined"));
			forward($group->getURL());
            system_message(elgg_echo('groups:joined', array($group->name)));
		} else {
			register_error(elgg_echo("groups:cantjoin"));
            system_message(elgg_echo('groups:cantjoin', array($group->name)));
		}
	//$group->featured_group = "yes";
	
//} else {
	//$group->featured_group = "no";
	
//}

		
	//}
forward(REFERER);
