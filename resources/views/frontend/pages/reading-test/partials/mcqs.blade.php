<div class="col-12 mt-3 ">
    <p class="fw-bold">{{ $iteration }}: {{ $question->name }}</p>
    <div>
        @foreach ($question->options as $key => $option)
            <div>
                <input type="radio" onclick="changeColorCode('question_{{ $question->id }}')" name="{{ $question->id }}"
                    value="{{ $option->id }}" id="option-{{ $option->id }}">
                @if ($question->image_url)
                    </br>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#question-image-{{ $question->id }}">
                        <span class="indicator-label"> <img src="{{ $question->image_url }}" width="100"
                                height="100" alt="{{ $question->image_url }}"></span>

                    </button>
                @endif

                <label for="option-{{ $option->id }}" class="box first">
                    <div class="course"> <span class="circle"></span> <span class="subject">

                            {{ $option->name }}
                        </span> </div>
                </label>
            </div>
        @endforeach
    </div>
</div>
