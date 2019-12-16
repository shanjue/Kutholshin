@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Create News</div>

            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <!-- 
    required = (boolean) = true is required attribute
    class = (string []) =class must array that for input
    name (string) = name is the attribute of input name and id
    label (string) = label is label text and input placeholder
    multiple (boolean) = only for type file
    data = (string) = to input value to edit
    *add required = boolean = add two place at input and at cssjs

    without id, name is the id
    trix not allow class []
    trix required script not allow two form but work for the first form
    calendar not allow class []
 -->
                    @input([
                    'type' => 'file',
                    'label' => 'Select Image',
                    'name' => 'image',
                    'design' => 'line',
                    'multiple' => true,
                    'class' => ['oneclass','twoclass']
                    ])


                    @input([
                    'type' => 'file',
                    'label' => 'Select Image',
                    'name' => 'imagehorizontal',
                    'design' => 'horizontal',
                    ])

                    @input([
                    'type' => 'text',
                    'label' => 'Title',
                    'name' => 'title',
                    'design' => 'line',
                    ])

                    @input([
                    'type' => 'text',
                    'label' => 'Title For Edit',
                    'name' => 'titleforedit',
                    'data' => 'Sample Title For Edit',
                    'design' => 'horizontal',
                    ])

                    @cssjs(['type' => 'trix' , 'required' => true])
                    @input([
                    'type' => 'trix',
                    'label' => 'Content',
                    'name' => 'content',
                    'design' => 'horizontal',
                    'required' => true
                    ])

                    @input([
                    'type' => 'trix',
                    'label' => 'Content For Edit',
                    'name' => 'contentedit',
                    'data' => 'Content For Edit',
                    'design' => 'line',
                    'required' => true
                    ])

                    @cssjs(['type'=>'calendar'])
                    @input([
                    'type' => 'calendar',
                    'label' => 'Date Of Birth',
                    'name' => 'dob',
                    'edit' => false,
                    'design' => 'horizontal',
                    'required' => true
                    ])

                    @input([
                    'type' => 'calendar',
                    'label' => 'Date Of Birth',
                    'name' => 'dob',
                    'data' => '2019/08/22',
                    'design' => 'horizontal',
                    'required' => true
                    ])


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Create News
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection