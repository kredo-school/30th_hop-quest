@if(!$quest->trashed())
{{-- DEACTIVATE --}}
<div class="modal fade" id="deactivate-quest{{ $quest->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-red">
            <div class="modal-header border-red">
                <h3 class="h3 text-danger"><i class="fa-solid fa-eye-slash"></i> Hide Model Quest</h3>
            </div>
            <div class="modal-body text-dark">
                <div class="fw-bold mb-3">   
                    Are you sure you want to hide this Model Quest?
                </div>
                <div>
                    <p class="text-dark">{{$quest->title}}</p>
                </div>
                <div class="mb-2">
                    <img src="{{$quest->main_photo}}" alt="image" class=" img-lg">
                </div>
                <div>
                    <p class="text-dark card_description">{{$quest->introduction}}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('modelquest.deactivate', $quest->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-red">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-red">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>

@else
{{-- ACTIVATE --}}
<div class="modal fade" id="activate-quest{{$quest->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-green">
            <div class="modal-header border-green">
                <h3 class="h3 color-green"><i class="fa-solid fa-eye"></i> Unhide Model Quest</h3>
            </div>
            <div class="modal-body color-green">
                <div class="fw-bold mb-3">
                    Are you sure you want to unhide this Model Quest?
                </div>
                <div>
                    <p class="text-dark">{{$quest->title}}</p>
                </div>
                <div class="mb-2">
                    <img src="{{$quest->main_photo}}" alt="image" class="img-lg">
                </div>
                <div>
                    <p class="text-dark card_description">{{$quest->introduction}}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{route('modelquest.activate', $quest->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-green">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-green">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endif