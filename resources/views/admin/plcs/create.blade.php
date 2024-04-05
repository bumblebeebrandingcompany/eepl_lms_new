
<div class="modal fade" id="addPlcModal" tabindex="-1" role="dialog" aria-labelledby="addPlcModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlcModalLabel">Add PLC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.plcs.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <select name="tag" class="form-control">
                            <option value="Facing">Facing</option>
                            <option value="Corner">Corner</option>
                            <option value="Coarse">Coarse</option>
                            <option value="Road">Road</option> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="increment/decrement">Increment/Decrement</label>
                        <select name="increment/decrement" class="form-control">
                            <option value="1">Increment</option>
                            <option value="0">Decrement</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input type="text" name="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="project_id" class="form-control" value="{{$project->id}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
