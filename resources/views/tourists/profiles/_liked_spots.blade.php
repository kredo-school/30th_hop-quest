<div class="posts-section p-4 bg-white rounded">
 <h4 class="fw-bold text-center mb-4">
  Liked Spots
 </h4>
 <div class="container">
  @php
            $spots = $user['likedSpots'] ?? [];
            $emptySlots = 3 - (count($spots) % 3);
            $emptySlots = $emptySlots === 3 ? 0 : $emptySlots;
        @endphp

        @if (count($spots) &gt; 0)
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
  @else
  <p class="text-muted text-center">
   No liked spots.
  </p>
  @endif
 </div>
</div>
