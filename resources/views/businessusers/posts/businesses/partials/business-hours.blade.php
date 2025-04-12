<div class="mb-2">
    <h3 class="text-xl font-bold mb-3">Business Hours & Event Time Periods</h3>

    <!-- Business Event period -->
    <div class="mb-1">
        <label class="form-label d-inline">Business Event period</label> 
        <div class="row mt-0">
            <div class="col">
                <label for="term_start" class="form-label d-inline">Start date</label>
                <input type="date" name="term_start" id="term_start" class="form-control @error('term_start') is-invalid @enderror" value="{{ old('term_start', $business->term_start ?? '') }}">
                @error('term_start')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="term_end" class="form-label d-inline">End date</label>
                <input type="date" name="term_end" id="term_end" class="form-control @error('term_end') is-invalid @enderror" value="{{ old('term_end', $business->term_end ?? '') }}">
                @error('term_end')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Special notes -->
    <div class="mb-3">
        <label for="sp_notes" class="form-label d-inline">Special notes</label>
        <textarea name="sp_notes" id="sp_notes" class="form-control" rows="3">{{ old('sp_notes', $business->sp_notes ?? '') }}</textarea>
    </div>
</div>