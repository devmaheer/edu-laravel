<div class="container mb-3">
    <div class="row">
        <div class="col-12">
            <p class="fw-bold">
                <p class="fw-bold">
                    
                    @if ($question->fillInBlank->fill_1)
                    {{$iteration}}: {{ $question->fillInBlank->fill_1 }}  <input type="text" name="fill[{{ $question->fillInBlank->id }}][]" id="fill_1">
                    @endif
                
                    @if ($question->fillInBlank->fill_2)
                        {{ $question->fillInBlank->fill_2 }}  <input type="text" name="fill[{{ $question->fillInBlank->id }}][]" id="fill_2">
                    @endif
                
                    @if ($question->fillInBlank->fill_3)
                        {{ $question->fillInBlank->fill_3 }}  <input type="text" name="fill[{{ $question->fillInBlank->id }}][]" id="fill_3">
                    @endif
                
                    @if ($question->fillInBlank->fill_4)
                        {{ $question->fillInBlank->fill_4 }}  <input type="text" name="fill[{{ $question->fillInBlank->id }}][]" id="fill_4">
                    @endif
                </p>
            </p>
            <div>
            </div>
        </div>
    </div>
</div>
