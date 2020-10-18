@if($teams)
    @foreach ($teams as $team)
        <option value="{{ $team->id}}">{{ ucfirst($team->teamName)}}</option>
    @endforeach
@endif