@if(!$promotion->trashed())
{{-- DEACTIVATE --}}
<div class="modal fade" id="deactivate-promotion{{ $promotion->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-red">
            <div class="modal-header border-red">
                <h3 class="h3 text-danger"><i class="fa-solid fa-eye-slash"></i> Hide Promotion</h3>
            </div>
            <div class="modal-body text-dark">
                <div class="fw-bold mb-3">   
                    Are you sure you want to hide this Promotion?
                </div>
                <div>
                    <p class="text-dark">{{$promotion->title}}</p>
                </div>
                <div class="mb-2">
                    <img src="{{$promotion->photo}}" alt="image" class=" img-lg">
                </div>
                <div>
                    <p class="text-dark card_description">{{$promotion->introduction}}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('promotion.deactivate', $promotion->id)}}" method="post">
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
<div class="modal fade" id="activate-promotion{{$promotion->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-green">
            <div class="modal-header border-green">
                <h3 class="h3 color-green"><i class="fa-solid fa-eye"></i> Unhide Promotion</h3>
            </div>
            <div class="modal-body color-green">
                <div class="fw-bold mb-3">
                    Are you sure you want to unhide this Promotion?
                </div>
                <div>
                    <p class="text-dark">{{$promotion->title}}</p>
                </div>
                <div class="mb-2">
                    <img src="{{$promotion->photo}}" alt="image" class="img-lg">
                </div>
                <div>
                    <p class="text-dark card_description">{{$promotion->introduction}}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{route('promotion.activate', $promotion->id)}}" method="post">
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