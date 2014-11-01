<?php

namespace FluxBB\Web\Controllers\Admin;

use FluxBB\Server\Exception\ValidationFailed;
use FluxBB\Web\Controller;

class GroupsController extends Controller
{
    public function index()
    {
        // TODO: Retrieve
        $groups = null;

        return $this->view('admin.groups.index', compact('groups'));
    }

    public function edit()
    {
        // TODO: Retrieve
        $group = null;

        return $this->view('admin.groups.edit', compact('group'));
    }

    public function update()
    {
        try {
            // Update group

            return $this->redirectTo('admin_groups_edit')
                        ->withMessage('Group was updated successfully.'); // TODO: params
        } catch (ValidationFailed $e) {
            return $this->errorRedirectTo('admin_groups_edit', $e);
        }
    }

    public function delete()
    {
        // TODO: Retrieve
        $group = null;

        return $this->view('admin.groups.delete', compact('group'));
    }

    public function remove()
    {
        // Delete group

        return $this->redirectTo('admin_groups_index');
    }
}
