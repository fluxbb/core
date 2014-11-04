<?php

namespace FluxBB\Models;

interface GroupRepositoryInterface
{
    public function getHierarchy();
    public function find($id);
    public function delete(Group $group);
}
