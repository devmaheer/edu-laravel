<div class="col-12 mt-3 ">
    <p class="fw-bold">{{ $iteration }}: {{ $question->name }}</p>
    <div>
        @foreach ($question->options as $key => $option)
            <div>
                <input type="radio" onclick="changeColorCode('question_{{ $question->id }}')" name="{{ $question->id }}"  value="{{ $option->id }}"
                    id="option-{{ $option->id }}">

                <label for="option-{{ $option->id }}" class="box first">
                    <div class="course"> <span class="circle"></span> <span class="subject">
                            @if ($key == 0)
                                (A)
                            @elseif($key == 1)
                            (B)
                            @elseif($key == 2)
                            (C)
                            @elseif($key == 3)
                            (D)
                            @endif
                            {{ $option->name }}
                        </span> </div>
                </label>
            </div>
        @endforeach
    </div>
</div>
