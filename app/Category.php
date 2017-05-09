<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = "categories";

	public $rules = [
			 'newCategory' => 'required|max:255'
	];

	public function child_categories()
	{
	    return $this->hasMany('App\Category', 'above_category');
	}



	public function allChildCategories($leaves)
	{
	    $childCategories = $this->child_categories;
	    if (empty($childCategories)){
	        return $leaves;
	    }

	    foreach ($childCategories as $child)
	    {
	        $child->load('child_categories');      
	      	$childCategories = $childCategories->merge($child->allChildCategories($leaves));
	    }
	    return $childCategories;
	}

}
