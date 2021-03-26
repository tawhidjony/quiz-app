<div>
    <ul>
        <form action="{{route('quiz.store')}}" method="POST">
            @csrf
        @forelse ($data_exam as $row )
            <li>
                {{$row->quiz_name}}<br>
                <ol>
                    <input type="radio" value="a" name="ans[]" >
                    <label for="">{{$row->a}}</label>
                </ol>
                <ol>
                    <input type="radio" value="b" name="ans[]" >
                    <label for="">{{$row->b}}</label>
                </ol>
                <ol>
                    <input type="radio" value="c" name="ans[]" >
                    <label for=""> {{$row->c}}</label>
                </ol>
                <ol>
                    <input type="radio" value="d" name="ans[]" >
                    <label for="">{{$row->d}}</label>
                    <input type="hidden" value="{{$row->ans}}" name="ans{{$row->id}}[]" >
                    <input type="hidden" value="{{$row->id}}" name="id-{{$row->id}}[]" >
                </ol>
            </li>
            @empty

            @endforelse
            <button type="submit">submit</button>
    </form>
        {{-- <button wire:click="store">submit</button> --}}
    </ul>
</div>
