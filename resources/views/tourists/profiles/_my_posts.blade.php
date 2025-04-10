@if (!empty($user['myQuests']) || !empty($user['mySpots']))
    {{-- My Quests --}}
    @if (!empty($user['myQuests']))
<div class="posts-section p-4 bg-white rounded mb-5">
 <h4 class="fw-bold text-center mb-4">
  Quests (view tourism log)
 </h4>
 <div class="container">
  @php
                    $quests = $user['myQuests'];
                    $columns = 3;
                    $emptySlots = $columns - (count($quests) % $columns);
                    $emptySlots = $emptySlots === $columns ? 0 : $emptySlots;
                @endphp
  <div class="row justify-content-center">
   @foreach ($quests as $quest)
   <div class="col-md-4 mb-4 d-flex justify-content-center">
    <div class="card shadow-sm card-fixed">
     <img alt="Quest Image" class="card-img-top" src="{{ $quest['image'] }}"/>
     <div class="card-body text-center">
      <h5 class="card-title">
       {{ $quest['title'] }}
      </h5>
      <p class="card-text small">
       {{ $quest['description'] }}
      </p>
      <p class="text-muted mb-1">
       Status:
       <strong>
        {{ $quest['status'] ?? 'N/A' }}
       </strong>
      </p>
      <small class="text-muted d-block">
       {{ $quest['date'] ?? 'N/A' }}
      </small>
      <div class="mt-2">
       <i class="fa-regular fa-heart">
       </i>
       {{ $quest['likes'] ?? 0 }}
       <i class="fa-regular fa-comment ms-3">
       </i>
       {{ $quest['comments'] ?? 0 }}
      </div>
     </div>
    </div>
   </div>
   @endforeach

                    @for ($i = 0; $i &lt; $emptySlots; $i++)
   <div class="col-md-4 mb-4 d-flex justify-content-center">
    <div class="card-fixed">
    </div>
   </div>
   @endfor
  </div>
 </div>
</div>
@endif

    {{-- My Spots --}}
    @if (!empty($user['mySpots']))
<div class="posts-section p-4 bg-white rounded">
 <h4 class="fw-bold text-center mb-4">
  Spots (view tourism log)
 </h4>
 <div class="container">
  @php
                    $spots = $user['mySpots'];
                    $columns = 3;
                    $emptySlots = $columns - (count($spots) % $columns);
                    $emptySlots = $emptySlots === $columns ? 0 : $emptySlots;
                @endphp
  <div class="row justify-content-center">
   @foreach ($spots as $spot)
   <div class="col-md-4 mb-4 d-flex justify-content-center">
    <div class="card shadow-sm card-fixed">
     <img alt="Spot Image" class="card-img-top" src="{{ $spot['image'] }}"/>
     <div class="card-body text-center">
      <h5 class="card-title">
       {{ $spot['title'] }}
      </h5>
      <p class="card-text small">
       {{ $spot['description'] }}
      </p>
      <small class="text-muted d-block">
       {{ $spot['date'] ?? 'N/A' }}
      </small>
      <div class="mt-2">
       <i class="fa-regular fa-heart">
       </i>
       {{ $spot['likes'] ?? 0 }}
       <i class="fa-regular fa-comment ms-3">
       </i>
       {{ $spot['comments'] ?? 0 }}
      </div>
     </div>
    </div>
   </div>
   @endforeach

                    @for ($i = 0; $i &lt; $emptySlots; $i++)
   <div class="col-md-4 mb-4 d-flex justify-content-center">
    <div class="card-fixed">
    </div>
   </div>
   @endfor
  </div>
 </div>
</div>
@endif
@else
<p class="text-center text-muted">
 No posts available.
</p>
@endif
