<?php

namespace App\Livewire\Companies;

use App\Models\ServiceCompanies;
use Livewire\Component;

class ManageCompanies extends Component
{
    public $companyes=[];
    public function render()
    {
        $this->companyes=ServiceCompanies::all();
        return view('livewire.companies.manage-companies');
    }
    public function del(ServiceCompanies $company)
    {
        $company->delete();
    }
    public function edit($id)
    {
        $this->redirectRoute('company.edit',$id);
    }
}
