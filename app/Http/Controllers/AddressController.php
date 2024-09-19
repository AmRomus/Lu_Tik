<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function achilds($parent){
        $ret = Address::find($parent);
        
       $ret_html='<a href="#"  onClick="unit_click('.$ret->id.')" >'.$ret->unit.'</a><i class="fa fa-minus"></i> <ul>';   
       foreach($ret->children()->orderBy('unit')->get() as $child) {
        $ret_html.='<li class="nav-item " id="cat_'.$child->id.'" ><a href="#" ';
        if(count($child->children)) {
        $ret_html.='onClick="unit_click_load('.$child->id.')">'.$child->unit.'</a>';
        $ret_html.='<i class="fa fa-plus"></i>';        
        } else {
            $ret_html.='onClick="unit_click('.$child->id.')">'.$child->unit.'</a>';
        }
        $ret_html.='</li>';
       }    
       $ret_html.='</ul>';
        return $ret_html;
    }
}
