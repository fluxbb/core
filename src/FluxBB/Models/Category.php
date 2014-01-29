<?php

namespace FluxBB\Models;

use Cache;

class Category extends Base
{

    protected $table = 'categories';

    protected $fillable = array('cat_name', 'disp_position');


    public function forums()
    {
        return $this->hasMany('FluxBB\\Models\\Forum', 'cat_id');
            //->orderBy('disp_position', 'ASC');
    }


    public static function all($columns = array())
    {
        return Cache::remember('fluxbb.categories', 7 * 24 * 60, function() {
            $all = array();
            $categories = Category::orderBy('disp_position', 'ASC')
                ->orderBy('id', 'ASC')
                ->get();

            foreach ($categories as $category)
            {
                $all[$category->id] = $category;
            }
            return $all;
        });
    }

    public static function allForGroup($group_id)
    {
        $categories = static::all();

        $forums = Forum::allForGroup($group_id);
        
        /*usort($forums, function($forum1, $forum2) {
            if ($forum1->cat_id == $forum2->cat_id)
            {
                // Same category: forum's disp_position value decides
                return $forum1->disp_position - $forum2->disp_position;
            }
            else
            {
                // ...else the categories' disp_position values are compared
                return $categories[$forum1->cat_id]->disp_position - $categories[$forum2->cat_id]->disp_position;
            }
        });*/ // TODO: Handle sorting!
        
        // FIXME: Yuck!!!
        $forums_by_cat = array();
        foreach ($forums as $forum)
        {
            if (!isset($forums_by_cat[$forum->cat_id]))
            {
                $forums_by_cat[$forum->cat_id] = array(
                    'category'	=> $categories[$forum->cat_id],
                    'forums'	=> array(),
                );
            }

            $forums_by_cat[$forum->cat_id]['forums'][] = $forum;
        }

        return $forums_by_cat;
    }

}
