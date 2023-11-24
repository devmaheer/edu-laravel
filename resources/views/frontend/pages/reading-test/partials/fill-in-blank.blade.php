<div class="container">
    <div class="row">
        <div class="col-12">
            <p class="fw-bold">


                @if ($question->fillInBlank->fill_1)
                    {!! $question->fillInBlank->fill_1 !!} {{ $iteration }} <input type="text" style="width:100px"
                        onkeyup="changeColorCode('question_{{ $question->id }}')"
                        name="fill[{{ $question->fillInBlank->id }}][]" id="fill_{{ $question->fillInBlank->id }}">
                @endif

                @if ($question->fillInBlank->fill_2)
                    {!! $question->fillInBlank->fill_2 !!} {{ $iteration }} <input type="text" style="width:100px"
                        onkeyup="changeColorCode('question_{{ $question->id }}')"
                        name="fill[{{ $question->fillInBlank->id }}][]" id="fill_{{ $question->fillInBlank->id }}">
                @endif

                @if ($question->fillInBlank->fill_3)
                    {!! $question->fillInBlank->fill_3 !!} {{ $iteration }} <input type="text" style="width:100px"
                        onkeyup="changeColorCode('question_{{ $question->id }}')"
                        name="fill[{{ $question->fillInBlank->id }}][]" id="fill_{{ $question->fillInBlank->id }}">
                @endif

                @if ($question->fillInBlank->fill_4)
                    {!! $question->fillInBlank->fill_4 !!} {{ $iteration }} <input type="text" style="width:100px"
                        onkeyup="changeColorCode('question_{{ $question->id }}')"
                        name="fill[{{ $question->fillInBlank->id }}][]" id="fill_{{ $question->fillInBlank->id }}">
                @endif
                @if ($question->image_url)
                    </br>
                    <button  type="button" data-bs-toggle="modal"
                        data-bs-target="#question-image-{{ $question->id }}" >
                        <span class="indicator-label"> <img src="{{ $question->image_url }}" width="100"
                                height="100" alt="{{ $question->image_url }}"></span>

                    </button>
                @endif

            </p>
            <div>
            </div>
        </div>
    </div>
</div>
