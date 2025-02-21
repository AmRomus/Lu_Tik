<?php

namespace App\Livewire\Managment;

use App\Models\BillingAccount;
use App\Models\UploadedFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class AccountPersonal extends Component
{
    use WithFileUploads;
    public $account;
    public $first;
    public $last;
    public $middle;
    public $ident;
    public $phone;
    public $email,$passport,$passport_region;
    public $p_file,$u_file;
    public function mount($billing_account){
        $this->account=BillingAccount::findOrFail($billing_account);
        $this->first=$this->account->first;
        $this->last=$this->account->last;
        $this->middle=$this->account->middle;
        $this->ident=$this->account->ident;
        $this->phone=$this->account->phone;
        $this->email=$this->account->email;
        $this->passport=$this->account->passport;
        $this->passport_region=$this->account->passport_region;
    }

    public function render()
    {
        return view('livewire.managment.account-personal');
    }
    public function save_passport()
    {
        $this->validate([
            'p_file' => 'image|max:10240',
          ]);
        $name = md5($this->p_file . microtime()).'.'.$this->p_file->extension();
        $this->p_file->storeAs('p_files', $name);
        $f=new UploadedFile();
        $f->file_name=$name;
        $f->file_path="p_files";
        $this->account->Files()->save($f);
        session()->flash('message', 'The photo is successfully uploaded!');
    }
    public function delete_pimage($img_id)
    {
        $f=UploadedFile::findOrFail($img_id);
         Storage::disk('local')->delete($f->file_path.'/'.$f->file_name);       
         $f->delete();
    }
    public function delete_file($file_id)
    {
        $f=UploadedFile::findOrFail($file_id);
        Storage::disk('local')->delete($f->file_path.'/'.$this->account->id.'/'.$f->file_name);       
        $f->delete();
    }
    public function save_u_file()
    {
        if($this->u_file){
            $name=$this->u_file->getClientOriginalName();
            $this->u_file->storeAs('user_files/'.$this->account->id, $name);
            $f=new UploadedFile();
            $f->file_name=$name;
            $f->file_path="user_files";
            $this->account->Files()->save($f);
        }
    }
}
