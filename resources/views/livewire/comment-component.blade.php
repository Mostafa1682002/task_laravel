<div>
    <style>
        form {
            max-width: 600px;
            margin: 30px auto;
        }

        .error {
            color: red;
            text-align: center;
        }

        .table_content table {
            width: 100%
        }

        .table_content table tr td,
        .table_content table tr th {
            text-align: center
        }
    </style>
    <form>
        <div>
            <label for="name">Name : </label>
            <input type="text" wire:model="name" id="name">
        </div>
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
        <br>
        <div>
            <label for="comment">Comment : </label>
            <textarea wire:model="comment" id="comment" cols="30" rows="10"></textarea>
        </div>
        @error('comment')
            <span class="error">{{ $message }}</span>
        @enderror
        <br>
        @if ($addComment)
            <button type="submit" wire:click.prevent="store">Create</button>
        @elseif($editComment)
            <button type="submit" wire:click.prevent="update">Update</button>
            <button type="submit" wire:click.prevent="cancelEdite">Cancel</button>
        @endif
    </form>
    <div class="table_content">
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>
                            <button wire:click.prevent="edit({{ $comment->id }})">Edite</button>
                            <button wire:click.prevent="destroy({{ $comment->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $comments->links() }}
        </div>
    </div>
</div>
