<div class="flex-row">
    <a href="javascript:void(0)" data-url="{{ route('upload.edit', $id) }}" class="btn btn-dark btn-edit">Edit</a>

    <a href="javascript:void(0)" data-url="{{ route('upload.show', $id) }}" class="btn btn-info btn-show">Show</a>

    <div>
        <form action="{{ route('upload.delete', $id)}}" method="post" class="w-auto">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-delete" type="submit">Delete</button>
        </form>
    </div>
</div>

