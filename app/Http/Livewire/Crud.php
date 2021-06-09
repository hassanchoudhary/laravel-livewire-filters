<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Student;


class Crud extends Component
{
    public $students, $name, $email, $mobile, $gender, $student_id,$prices;
    public $isModalOpen = 0;
    public $filters=[
        "male"=>"",
        "female"=>""
    ];
    public function mount(){
        $this->loadData();
    }
    public function loadData(){
        $this->students= Student::all();
    }
    public function render()
    {
        return view('livewire.crud');
    }
   public function RangePrices(){
       $this->students = Student :: where('prices','=',$this->prices)->get();
   }
    public function genderFilter()
    {
        $this->students = Student :: where('gender','LIKE',$this->gender)->get();
    }
    public function genderFilterCheckBox()
    {
        if($this->filters["male"]=="true" && $this->filters["female"]=="true")
            $this->students = Student :: all();
        else if($this->filters["male"]=="true")
            $this->students = Student :: where('gender','LIKE','male')->get();
        else if($this->filters["female"]=="true")
            $this->students = Student :: where('gender','LIKE','female')->get();
        else
            $this->students = Student :: all();
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->gender= '';
        $this->prices= '';
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'prices' => 'required',
        ]);
    
        Student::updateOrCreate(['id' => $this->student_id], [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'gender' => $this->gender,
            'prices' => $this->prices,
        ]);

        session()->flash('message', $this->student_id ? 'Student updated.' : 'Student created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
        $this->loadData();
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->mobile = $student->mobile;
        $this->gender = $student->gender;
        $this->prices = $student->prices;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Studen deleted.');
    }
}