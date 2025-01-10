<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewBillingAccount extends Component
{
    public $show;
    #[Rule('unique:billing_accounts,ident')]
    public $ident;

    public $first;
    public $last;
    public $middle;

    #[On('show_modal')]
    public function show_modal()
    {      
      $this->show=!$this->show;      
      
    }
    public function updatedIdent()
    {
        $this->validate();
    }
    public function render()
    {
        return view('livewire.modals.new-billing-account');
    }
    public function save()
    {
        $this->validate();
        BillingAccount::create([
            'first'=>$this->first,
            'last'=>$this->last,
            'middle'=>$this->middle,
            'ident'=>$this->ident,
        ]);
        $this->dispatch('saved');
        $this->show_modal();
    }
    public function mk_ident()
    {
        $ident_array=BillingAccount::select('ident')->pluck('ident')->toArray();
        $tmp_ident=$this->generate_numeric_string(4);
        while(in_array($tmp_ident,$ident_array,true))
        {
            $tmp_ident=$this->generate_numeric_string(4);
        }
       $this->ident=$tmp_ident;
    }
    function generate_numeric_string($length) {
        // Проверка на положительную длину
        if ($length <= 0) {
            throw new \InvalidArgumentException("Length must be a positive integer.");
        }
    
        $numeric_string = '';
        for ($i = 0; $i < $length; $i++) {
            // Генерация случайной цифры от 0 до 9
            $numeric_string .= random_int(0, 9);
        }        
        return $numeric_string;
    }
}
