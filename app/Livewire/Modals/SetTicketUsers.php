<?php

namespace App\Livewire\Modals;

use App\Models\SupportTicket;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class SetTicketUsers extends Component
{
    public $show;
    public $ticket;
    public $users;
    public $users_list=[];
    public $selected_arr=[];
    public function mount()
    {
        $this->users=User::all();  
    }
    public function render()
    {
        return view('livewire.modals.set-ticket-users');
    }
    #[On('show_modal')]
    public function show_modal($tik)
    {
        $this->ticket=SupportTicket::find($tik);
        $this->selected_arr=$this->ticket->Users->pluck('id')->toArray();
      // =User::whereIn('id',$users)->get();  
          
        $this->show=true;
       
    }
    public function hide_modal()
    {
        $this->show=false;
        $this->selected_arr=[];
        $this->users_list=[];
    }
    public function save()
    {
        $this->ticket->Users()->sync($this->selected_arr);       
        $this->hide_modal();
        $this->dispatch('saved');
    }
}
