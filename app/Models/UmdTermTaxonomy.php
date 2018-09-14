<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UmdTermTaxonomy
 */
class UmdTermTaxonomy extends Model
{
    protected $table = 'umd_term_taxonomy';

    public $timestamps = false;

	protected $primaryKey = 'term_taxonomy_id';

    protected $fillable = [
        'term_taxonomy_id',
        'term_id',
        'taxonomy',
        'description',
        'parent',
        'count'
    ];

    protected $guarded = [];

    public function UmdTermRelationship(){
		return $this->hasMany('App\Models\UmdTermRelationship', 'term_taxonomy_id', 'term_taxonomy_id');
	}

	public function UmdTerm(){
		return $this->hasOne('App\Models\UmdTerm', 'term_id', 'term_id');
	}

	public function UmdPosts(){
		return $this->belongsToMany('App\Models\UmdPost', 'umd_term_relationships', 'term_taxonomy_id', 'object_id');
	}

	public function UmdTermParent(){
		return $this->hasOne('App\Models\UmdTerm', 'term_id', 'parent');
	}

}
