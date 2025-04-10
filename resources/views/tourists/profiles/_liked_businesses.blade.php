<div class="posts-section p-4 bg-white rounded">
 <h4 class="fw-bold text-center mb-4">
  Liked Business
 </h4>
 <div class="container">
  @php
            $businesses = $user['likedBusinesses'] ?? [];
            $emptySlots = 3 - (count($businesses) % 3);
            $emptySlots = $emptySlots === 3 ? 0 : $emptySlots;
        @endphp

        @if (count($businesses) &gt; 0)
  <div class="row justify-content-center">
   @foreach ($businesses as $biz)
   <div class="col-md-4 mb-4 d-flex justify-content-center">
    <div class="card shadow-sm card-fixed">
     <img alt="Business Image" class="card-img-top" src="{{ $biz['image'] }}"/>
     <div class="card-body text-center">
      <h5 class="card-title">
       {{ $biz['title'] }}
      </h5>
      <p class="card-text small">
       {{ $biz['description'] }}
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
   No liked business.
  </p>
  @endif
 </div>
</div>
