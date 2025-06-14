@if(!$post['is_trashed'])
{{-- DEACTIVATE --}}
<div class="modal fade" id="{{ $modalId }}">
    <div class="modal-dialog">
        <div class="modal-content border-red">
            <div class="modal-header border-red">
                <h3 class="h3 text-danger"><i class="fa-solid fa-eye-slash"></i> Hide Business</h3>
            </div>
            <div class="modal-body text-dark">
                <div class="fw-bold mb-3">   
                    Are you sure you want to hide this Business?
                </div>
                <div>
                    <p class="text-dark">{{$post['title']}}</p>
                </div>
                <div class="mb-2">
                    @if(Str::startsWith($post['main_image'], 'http') || Str::startsWith($post['main_image'], 'data:'))
                        <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class=" img-sm">
                    @else
                        <img src="{{ asset('storage/' . $post['main_image']) }}" alt="{{ $post['title'] }}" class="img-sm">
                    @endif
                </div>
                <div>
                    <p class="text-dark card_description">{{$post['introduction']}}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('businesses.deactivate', $post['id'])}}" method="post">
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
<div class="modal fade" id="{{ $modalId }}">
    <div class="modal-dialog">
        <div class="modal-content border-green">
            <div class="modal-header border-green">
                <h3 class="h3 color-green"><i class="fa-solid fa-eye"></i> Unhide Business</h3>
            </div>
            <div class="modal-body color-green">
                <div class="fw-bold mb-3">
                    Are you sure you want to unhide this Business?
                </div>
                <div>
                    <p class="text-dark">{{$post['title']}}</p>
                </div>
                <div class="mb-2">
                    @if(Str::startsWith($post['main_image'], 'http') || Str::startsWith($post['main_image'], 'data:'))
                        <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class=" img-sm">
                    @else
                        <img src="{{ asset('storage/' . $post['main_image']) }}" alt="{{ $post['title'] }}" class="img-sm">
                    @endif
                </div>
                <div>
                    <p class="text-dark card_description">{{$post['introduction']}}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{route('businesses.activate', $post['id'])}}" method="post">
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