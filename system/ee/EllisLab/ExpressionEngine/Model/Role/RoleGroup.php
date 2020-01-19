<?php
/**
 * ExpressionEngine (https://expressionengine.com)
 *
 * @link      https://expressionengine.com/
 * @copyright Copyright (c) 2003-2018, EllisLab, Inc. (https://ellislab.com)
 * @license   https://expressionengine.com/license
 */

namespace EllisLab\ExpressionEngine\Model\Role;

use EllisLab\ExpressionEngine\Service\Model\Model;

/**
 * RoleGroup Model
 */
class RoleGroup extends Model {

	protected static $_primary_key = 'group_id';
	protected static $_table_name = 'role_groups';

	protected static $_typed_columns = [
		'group_id' => 'int',
	];

	protected static $_relationships = [
		'Roles' => array(
			'type' => 'hasAndBelongsToMany',
			'model' => 'Role',
			'pivot' => array(
				'table' => 'roles_role_groups'
			),
			'weak' => TRUE
		),
		'Members' => array(
			'type' => 'hasAndBelongsToMany',
			'model' => 'Member',
			'pivot' => array(
				'table' => 'members_role_groups'
			),
			'weak' => TRUE
		),
	];

	protected static $_validation_rules = [
		'name'     => 'required',
	];

	// protected static $_events = [];

	// Properties
	protected $group_id;
	protected $name;

}

// EOF