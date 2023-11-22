<div class="col-12 mt-3 ">
    <p class="fw-bold">{{$iteration}}: {{ $question->name }}</p>
    <div>
        @foreach($question->options as $option)
        <div>
        <input type="radio" name="{{$question->id}}" value="{{$option->id}}" id="option-{{$option->id}}">

        <label for="option-{{$option->id}}" class="box first">
            <div class="course"> <span class="circle"></span> <span
                    class="subject"> {{$option->name}}
     </span> </div>
        </label>
        </div>
        @endforeach
    </div>
</div>