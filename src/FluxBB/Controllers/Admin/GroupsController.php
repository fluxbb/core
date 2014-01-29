<?php

namespace FluxBB\Controllers\Admin;

use Redirect;
use Validator;
use View;
use FluxBB\Models\Group;
use FluxBB\Models\GroupRepositoryInterface;

class GroupsController extends BaseController
{

    /**
     * The groups repository instance
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
