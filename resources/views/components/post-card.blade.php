<div class="alert alert-{{ $color }}" role="alert">

    <form method="post" action="{{ route('post.delete') }}">
        @csrf
        <input type="hidden" id="{{ $id }}"" name="post" value="{{ $id }}" />
        <button type="submit" class="close" onclick="return confirm('Are you sure?');">
            <span aria-hidden="true">&times;</span>
        </button>
    </form>

    <h4 class="alert-heading">{{ $title }}</h4>

    <p>{{ $body }}</p>

</div>
