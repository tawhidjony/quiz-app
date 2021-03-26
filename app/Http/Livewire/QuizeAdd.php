<?php

namespace App\Http\Livewire;

use App\Models\Quize;
use Livewire\Component;
use Livewire\WithPagination;

class QuizeAdd extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $hiddenId, $quiz_name, $quiz_one, $quiz_two, $quiz_three, $quiz_four, $ans;
    public $updateMode = false;

    public function render()
    {
        $data_all = Quize::orderBy('id', 'desc')->paginate(10);
        return view('livewire.quize-add',['quizzes' => $data_all]);
    }

    private function resetInput()
    {
        $this->quiz_name = null;
        $this->quiz_one = null;
        $this->quiz_two = null;
        $this->quiz_three = null;
        $this->quiz_four = null;
        $this->ans = null;
    }

    public function submit(){
        $this->validate([
            'quiz_name' => 'required',
            'quiz_one' => 'required',
            'quiz_two' => 'required',
            'quiz_three' => 'required',
            'quiz_four' => 'required',
        ]);
        $quiz = New Quize();
        $quiz->quiz_name        = $this->quiz_name;
        $quiz->a     = $this->quiz_one;
        $quiz->b     = $this->quiz_two;
        $quiz->c   = $this->quiz_three;
        $quiz->d    = $this->quiz_four;
        $quiz->ans    = $this->ans;
        $quiz->save();
        session()->flash('message', 'Quiz has been created');
        $this->resetInput();
    }

    public function edit($id){
        $edit_quiz = Quize::findOrFail($id);
        $this->hiddenId     = $id;
        $this->quiz_name    = $edit_quiz->quiz_name;
        $this->quiz_one     = $edit_quiz->quiz_ans_one;
        $this->quiz_two     = $edit_quiz->quiz_ans_two;
        $this->quiz_three   = $edit_quiz->quiz_ans_three;
        $this->quiz_four    = $edit_quiz->quiz_ans_four;
        $this->updateMode = true;

    }

    public function update(){

        if($this->hiddenId){
            $update_quiz = Quize::findOrFail($this->hiddenId);

            $update_quiz->update([
                'quiz_name' => $this->quiz_name,
                'quiz_ans_one' => $this->quiz_one,
                'quiz_ans_two' => $this->quiz_two,
                'quiz_ans_three' => $this->quiz_three,
                'quiz_ans_four' => $this->quiz_four,
            ]);
            session()->flash('message', 'Quiz has been updated');
            $this->resetInput();
            $this->updateMode = false;
        }
    }
    public function destroy($id)
    {
        if ($id) {
            $record = Quize::where('id', $id);
            $record->delete();
        }
    }



}
