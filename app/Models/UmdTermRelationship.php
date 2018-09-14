<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UmdTermRelationship
 */
class UmdTermRelationship extends Model
{
    protected $table = 'umd_term_relationships';

	protected $primaryKey = 'object_id';

    public $timestamps = false;

    protected $fillable = [
        'object_id',
        'term_taxonomy_id',
        'term_order'
    ];

    protected $guarded = [];

	public function UmdPost(){
		return $this->hasOne('App\Models\UmdPost', 'ID', 'object_id');
	}

	public function UmdTermTaxonomy(){
		return $this->belongsTo('App\Models\UmdTermTaxonomy', 'term_taxonomy_id', 'term_taxonomy_id');
	}

}
