<div>
    <x-layouts.sidebar activePage="iptv_streams" > </x-layouts.aside>
    <div class="content">
        <div class="container-fluid pd-x-0">
            <div class="row row-xs">
                <div class="col-sm-4">
                    <fieldset class="form-fieldset">
                        <legend style="font-size: 12px !important; text-transform:none">Նկարագիր՝</legend>
                        <div class="row d-flex">
                            <div class="col-sm-4">
                                <figure class="pos-relative mg-b-0 wd-100p">
                                @if ($logo)
                                    <img src="{{$logo->temporaryUrl()}}"   class="img-fit-cover" alt="Logo">
                                @else
                                    @if($curr_stream->tvg_ico)     
                                    <img src="/logos/{{$curr_stream->tvg_ico}}.png" class="img-fit-cover" alt="Logo">
                                                 
                                    @endif
                                @endif
                                  <figcaption class="pos-absolute b-0 l-0 wd-100p pd-20 d-flex justify-content-center">
                                    <div class="btn-group">
                                      <label  for="upload" class="btn btn-dark btn-icon" ><i data-feather="download" aria-hidden="true"></i> 
                                      <input type="file" id="upload" style="display:none" wire:model.defer="logo">  
                                      </label>                                     
                                      <a href="#" class="btn btn-dark btn-icon" wire:click="delete_logo" wire:confirm="Հերացնե՞լ լոգոն"><i data-feather="trash-2"></i></a>
                                    </div>
                                  </figcaption>  
                            </figure>
                            </div>
                            <div class="col-sm-8">
                                <label for="upload">
                                    <span class="fa fa-pen" aria-hidden="true"></span>
                                    <input type="file" id="upload" style="display:none">
                              </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >Անվանում</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Անվանում" aria-label="name" name="name" wire:model.live="name">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" >EPG</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="00000000" aria-label="tvg_id" name="tvg_id" wire:model.live="tvg_id">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-sm-8">
                    <fieldset class="form-fieldset">
                        <legend style="font-size: 12px !important; text-transform:none">Տվյալներ</legend>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >Live Url:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="http://*" aria-label="stream_url" name="stream_url" wire:model.live="stream_url">
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0 me-2" type="checkbox"  wire:model.live="have_catchup">
                                <label class="form-check-label" >Catch-Up</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0 me-2" type="checkbox"  wire:model.live="is_ott">
                                <label class="form-check-label me-4" >OTT</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Ցուցադրել՝ </span>
                              </div>
                            <input type="time" class="form-control" aria-label=""    wire:model.defer="show_start">
                            <input type="time" class="form-control" aria-label=""    wire:model.defer="show_stop">
                        </div>
                        <div class="input-group mb-0">
                            <div class="input-group-prepend">
                              <span class="input-group-text" >Catch-Up Url:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="http://*" aria-label="catchup_server" name="catchup_server" wire:model.live="catchup_server">
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-sm w-100 text-end mt-2">
                    <a href="#" class="btn btn-sm btn-success" wire:click="save">Պահպանել</a>
                </div>
            </div>
        </div>
    </div>
</div>
