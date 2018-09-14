<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UmdTerm
 */
class UmdTerm extends Model
{
    protected $table = 'umd_terms';

    protected $primaryKey = 'term_id';

	public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'term_group'
    ];
    protected $guarded = [];

	public function UmdTermTaxonomys(){
		return $this->hasMany('App\Models\UmdTermTaxonomy', 'term_id', 'term_id');
	}

}
