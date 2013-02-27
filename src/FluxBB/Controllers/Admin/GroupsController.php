<?php
/**
 * FluxBB - fast, light, user-friendly PHP forum software
 * Copyright (C) 2008-2012 FluxBB.org
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public license for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @category	FluxBB
 * @package		Core
 * @copyright	Copyright (c) 2008-2012 FluxBB (http://fluxbb.org)
 * @license		http://www.gnu.org/licenses/gpl.html	GNU General Public License
 */

namespace FluxBB\Controllers\Admin;

use Redirect;
use Validator;
use View;
use FluxBB\Models\Group;
use FluxBB\Models\GroupRepositoryInterface;

class GroupsController extends BaseController
{

	/**
	 * The groups repository
	 * 
	 * @var GroupRepositoryInterface
	 */
	protected $groups;


	public function __construct(GroupRepositoryInterface $groups)
	{
		$this->groups = $groups;
	}

	public function index()
	{
		$groups = $this->groups->getHierarchy();

		return View::make('fluxbb::admin.groups.index')
		           ->with('groups', $groups);
	}

	public function edit(Group $group)
	{
		return View::make('fluxbb::admin.groups.edit')
		           ->with('group', $group);
	}

	public function update(Group $group)
	{
		$rules = array(
			'name'	=> 'required',
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails())
		{
			return Redirect::route('admin_groups_edit', array('group' => $group))
			               ->withInput()
			               ->withErrors($validation);
		}
		else
		{
			$group->fill(Input::all());
			$group->save();

			return Redirect::route('admin_groups_edit', array('group' => $group))
			               ->with('success', 'Group was updated successfully.');
		}
	}

	public function delete(Group $group)
	{
		return View::make('fluxbb::admin.groups.delete')
		           ->with('group', $group);
	}

	public function remove(Group $group)
	{
		$this->groups->delete($group);

		return Redirect::route('admin_groups_index');
	}

}
